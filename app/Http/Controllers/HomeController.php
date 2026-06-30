<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Link;
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
        $links = array_values(array_filter($request->input('links', []), fn ($link) => ! empty(trim($link))));
        $domainID = $request->input('domainSelect');
        $customTextInput = $request->input('customTextInput');

        if (empty($links)) {
            return response()->json(['success' => false, 'message' => 'Please enter at least one link.']);
        }

        if (! $customTextInput) {
            $customTextInput = $this->createRandomCustomText($request);
        }

        foreach ($links as $link) {
            if (! $this->checkAllowedLink($link)) {
                return response()->json(['success' => false, 'message' => 'Invalid link: '.htmlspecialchars($link, ENT_QUOTES).'. Please enter a valid URL.']);
            }
        }

        if (! $this->checkAllowedText($customTextInput)) {
            return response()->json(['success' => false, 'message' => 'Custom text is not allowed. Please choose a different one.']);
        }

        if (! $this->checkAvailability($customTextInput)) {
            return response()->json(['success' => false, 'message' => 'Custom text is already taken. Please choose a different one.']);
        }

        $expirationDate = now()->addYear();
        $singleMulti = count($links) === 1 ? 1 : 2;

        $shortLink = ShortLink::create([
            'domain_id' => $domainID,
            'link_custom_text' => $customTextInput,
            'single_multi' => $singleMulti,
            'expiration_date' => $expirationDate->toDateString(),
        ]);

        foreach ($links as $longLink) {
            Link::create([
                'long_link' => $longLink,
                'short_link_id' => $shortLink->id,
            ]);
        }

        $domain = Domain::find($domainID);
        $finalShortLink = 'https://'.$domain->domain_name.'/'.$customTextInput;
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data='.urlencode($finalShortLink).'&size=200x200';

        return response()->json([
            'success' => true,
            'shortened_url' => $finalShortLink,
            'expirationDate' => $expirationDate->format('d F, Y'),
            'qrCodeUrl' => $qrCodeUrl,
            'link_type' => $singleMulti === 1 ? 'single' : 'multi',
            'message' => 'Short link and QR code generated successfully.',
        ]);
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

    public function checkAvailability(string $customText): bool
    {
        return ShortLink::where('link_custom_text', $customText)->doesntExist();
    }

    public function createRandomCustomText(Request $request): string
    {
        do {
            $randomText = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        } while (! $this->checkAllowedText($randomText) || ! $this->checkAvailability($randomText));

        return $randomText;
    }
}
