<?php

namespace App\Http\Controllers;

class HelpController extends Controller
{
    public function gettingStarted()
    {
        return view('getting-started');
    }
}
