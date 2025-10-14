<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    //
    function website()
    {
        return view('admin.website.website');
    }
    function websiteForm()
    {
        return view('admin.website.website-form');
    }
}
