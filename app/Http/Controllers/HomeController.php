<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\ShortLink;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $domains = Domain::where('is_active', true)->get();
        $ip = $request->ip();
        $user_agent = $request->userAgent();
        

        return view('home.index', compact('domains'));
    }

    public function privacyPolicy()
    {
        return view('home.privacy-policy');
    }

    public function shorten(Request $request)
    {

        $longLinkInput = $request->input('longLinkInput');
        $domainID = $request->input('domainSelect');
        $customTextInput = $request->input('customTextInput');

        $allowedLink = $this->checkAllowedLink($longLinkInput);
        $allowedText = $this->checkAllowedText($customTextInput);

        if (! $allowedLink) {
            return response()->json(['success' => false, 'message' => 'Invalid long link. Please enter a valid URL.']);
        }
        if (! $allowedText) {
            return response()->json(['success' => false, 'message' => 'Custom text is not allowed. Please choose a different one.']);
        } else {
            $availablity = $this->checkAvailability($customTextInput, $domainID);
            if ($availablity) {
                return response()->json(['success' => false, 'message' => 'Custom text is already taken. Please choose a different one.']);
            }
        }

        $expirationDate = Carbon::now()->addYears(1); // Set expiration date to 1 year from now

        ShortLink::create([
            
            'domain_id' => $domainID,
            'link_custom_text' => $customTextInput,
            'single_multi' => 0,
            'expiration_date' => $expirationDate,
        ]);

        // return response()->json($wholerequest);
        return response()->json(['success' => true, 'message' => 'Custom text is available.']);

    }

    public function checkAllowedLink($longlink)
    {
        $allowedRegex = '#^(https?://)?([\w\-]+\.)+[\w\-]+(/[\w\-._~:/?\#[\]@!$&\'()*+,;=]*)?$#';
        $unallowedLinks = ['wurl.io', 'www.wurl.io', 'http://wurl.io', 'https://wurl.io', 'http://www.wurl.io', 'https://www.wurl.io'];
        if (preg_match($allowedRegex, $longlink)) {
            foreach ($unallowedLinks as $unallowed) {
                if (stripos($longlink, $unallowed) !== false) {
                    return false; // Unallowed link found
                }
            }

            return true; // All checks passed
        } else {
            return false; // Does not match allowed pattern
        }
    }

    public function checkAvailability($customText, $domainID)
    {

        $available = ShortLink::where('link_custom_text', $customText)->where('domain_id', $domainID)->exists();

        return $available;

    }

    public function checkAllowedText($customText)
    {
        $unallowed_strings = ['blog', 'blogs', 'shorten'];
        $allowedRegex = '/^(?=.*[a-zA-Z])[a-zA-Z0-9]+$/';
        if (preg_match($allowedRegex, $customText)) {
            foreach ($unallowed_strings as $unallowed) {
                if (stripos($customText, $unallowed) !== false) {
                    return false; // Unallowed string found
                }
            }

            return true; // All checks passed
        } else {
            return false; // Does not match allowed pattern
        }

    }
}
