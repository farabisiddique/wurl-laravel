<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;

class HomeController extends Controller
{
    public function index()
    {   
        $domains = Domain::where('is_active', true)->get();
        return view('home.index', compact('domains'));
    }

    public function privacyPolicy()
    {
        return view('home.privacy-policy');
    }
}
