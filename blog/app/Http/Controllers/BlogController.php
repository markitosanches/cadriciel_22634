<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('home');
    }

    public function article(){
        return view('article');
    }
    
    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }

    public function contactForm(Request $request){
        //return $request->name;
        return view('contact-post', ['data' => $request]);
    }
}
