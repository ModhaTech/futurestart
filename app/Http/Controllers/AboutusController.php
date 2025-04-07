<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metatags;
use Auth;
use Inertia\Inertia;

class AboutusController extends Controller
{
    public function index() 
    {
            $authCheck = Auth::check();
            $metaTags =  Metatags::where('page_title','=','about-us')->first();
        	return view('frontend.about-us.index', compact('authCheck' ,'metaTags'));
    }

    public function indexInertia()
    {
        $authCheck = Auth::check();
        $metaTags =  Metatags::where('page_title','=','about-us')->first();

        return Inertia::render('AboutUs', compact('authCheck' ,'metaTags'));
    }
}
