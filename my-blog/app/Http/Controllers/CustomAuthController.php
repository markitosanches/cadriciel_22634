<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index ');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20'
        ]);

        // False return redirect()->back()->withErrors('name' => 'validation.required', 'password' => ['minimum 6 carac', 'filed is requred'])->withInput();

        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('login'))->withSuccess('Utilisateur enregistré');
    }

    public function authentication(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');

        //return $credentials;

        if(!Auth::validate($credentials)):
            return redirect(route('login'))
                        ->withErrors(trans('auth.password'))
                        ->withInput();
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return redirect()->intended(route('blog.index'));
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function userList(){
        $users = User::Select('id', 'name')
                    ->orderBy('name')
                    ->paginate(5);

        return view('auth.user-list', ['users' => $users]);
    }
}
