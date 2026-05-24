<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\ShortLink;
use App\Models\IPAddress;

class HomeController extends Controller
{
    public function index(Request $request)
    {   
        $domains = Domain::where('is_active', true)->get();
        $ip = $request->ip();
        $user_agent = $request->userAgent();
        $ipAddressAdded = IPAddress::firstOrCreate([
            'ip_address' => $ip,
            'user_agent' => $user_agent,
        ]);
        $ipid = $ipAddressAdded->id;
        return view('home.index', compact('domains','ipid'));
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
        $availablity = $this->checkAvailability($customTextInput);
        

        // return response()->json($wholerequest);
        return response()->json(['success' => $availablity]);
    
    }

    public function checkAvailability($customText){

        $available = ShortLink::where('link_custom_text', $customText)->exists();
        return $available;

    }

    public function checkAllowedText($customText){
        $unallowed_strings = array('blog','blogs','shorten');
       
    }
}
