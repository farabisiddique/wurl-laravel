<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;

class RedirectController extends Controller
{
    public function handle(string $customText)
    {
        $shortLink = ShortLink::with(['links', 'domain'])
            ->where('link_custom_text', $customText)
            ->firstOrFail();

        if (now()->toDateString() > $shortLink->expiration_date->format('Y-m-d')) {
            return view('redirect.expired', compact('shortLink'));
        }

        if ($shortLink->single_multi === 1) {
            $longLink = $shortLink->links->first();

            if (! $longLink) {
                abort(404);
            }

            return view('redirect.countdown', compact('shortLink', 'longLink'));
        }

        $links = $shortLink->links;

        return view('redirect.landing', compact('shortLink', 'links'));
    }
}
