<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Socialite;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     *  socialite によるtwitter login リダイレクト処理
     */
    public function redirectToTwitterProvider() {
       return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback(Request $request){

	try {
	    $token = $request->oauth_token;
            $secret = $request->oauth_verifier;
	    $user_info = Socialite::driver('twitter')->user();
	    //$user_info = Socialite::driver('twitter')->userFromTokenAndSecret($token, $secret);
	    //dd($user_info);
        } 
        catch (\Exception $e) {
            return redirect('/')->with('oauth_error', 'ログインに失敗しました');
            // エラーならログイン画面へ転送
        }
        
        $user = new User();

        if (User::where('twitter_id', $user_info->id)->exists()) {
            $user = User::where('twitter_id', $user_info->id)->first();
            Auth::login($user);
            $user->update(['name' => $user_info->name, 'email'=>$user_info->email,
                'img_url'=>$user_info->avatar]);
        } else {
            $user = User::firstOrCreate(
                ['email'=> $user_info->email],
                ['name' => $user_info->name, 'twitter_id'=>$user_info->id,
                'img_url'=>$user_info->avatar]);
            Auth::login($user);
        }

        

        return redirect()->to('/home'); 
     
    }
}
