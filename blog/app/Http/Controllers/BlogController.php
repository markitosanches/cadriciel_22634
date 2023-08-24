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
        //return $request;
        //$page = 'page Laravel';
        //return view('contact-post', ['data' => $request, 'page' =>$page]);
        return view('contact', ['data' => $request]);
    }
}
