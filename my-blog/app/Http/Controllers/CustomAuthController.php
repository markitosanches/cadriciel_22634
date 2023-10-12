<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        
        //courriel
        $to_name = $request->name;
        $to_email = $request->email;
        $body="<a href='#'>Cliquez ici</a>";

        Mail::send('email.mail', [
                'name'=> $to_name, 
                'body'=>$body   
            ], function($message) use ($to_name, $to_email){
                $message->to($to_email, $to_name)->subject('Courriel de test Laravel');
            });

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
        $user->temp_password = null;
        $user->save();

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

    public function forgotPassword(){
        return view('auth.forgot-password');
    }

    public function tempPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $user = User::where('email', $request->email)->first();

        $tempPassword = str::random(45);

        $user->temp_password = $tempPassword;
        $user->save();

      

                //courriel
        $to_name = $user->name;
        $to_email = $request->email;
        $body = "<a href='".route('new.password', [$user->id, $tempPassword])."'>Cliquer ici opour changer le mot de passe</a>";

        Mail::send('email.mail', [
                'name'=> $to_name, 
                'body'=>$body   
            ], function($message) use ($to_name, $to_email){
                $message->to($to_email, $to_name)->subject('Reset password');
            });

        return redirect(route('login'))->withSuccess('Please check your email');

    }

    public function newPassword(User $user, $tempPassword){
        if($user->temp_password === $tempPassword ){
            return view('auth.new-password');
        } 
        return redirect(route('forgot-password'))->withErrors('Access denied');
    }

    public function storeNewPassword(Request $request, User $user, $tempPassword){
        if($user->temp_password === $tempPassword){
            $request->validate([
                'password' => 'min:6|max:20|confirmed'
            ]);

            $user->password = Hash::make($request->password);
            $user->temp_password = null;
            $user->save();
            return redirect(route('login'))->withSuccess('Success');

        } 
        return redirect(route('forgot-password'))->withErrors('Access denied');
    }
}
