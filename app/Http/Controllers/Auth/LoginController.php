<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Hash;
use Socialite;
use Auth;
use Str;
use App\SocialProvider;

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
    //protected $redirectTo = '/home';
    
    protected $username;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
        $this->username = $this->findUsername();

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:255',
            'password' => 'required|min:6',
        ]);
    }
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('login');

         
          if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $fieldType =  'email'; 
            //return ['email' => $request->get('email'), 'password'=>$request->get('password')];
          }
          elseif(is_numeric($login)){
            $fieldType =  'mobile';  //filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            //return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
          }
          else{
            $fieldType =  'username'; 
          }
          //return ['username' => $request->get('email'), 'password'=>$request->get('password')];


 
        //$fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    public function mobile()
    {
        return $this->mobile;
    }

      /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /* 
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();
        // dd($user);
        // exit;
        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && Hash::check($request->password, $user->password) && $user->status != 1) {
            $errors = [$this->username() => 'Your account is not active.'];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
    */

    // public function mobile()
    // {
    //   return 'mobile';
    // }

    
    // public function username()
    // {
    //   return 'username';
    // }


    // protected function credentials(Request $request)
    // {
    //     if(is_numeric($request->get('email'))){
    //         return ['mobile'=>$request->get('email'),'password'=>$request->get('password')];
    //     }
    //     elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
    //         return ['email' => $request->get('email'), 'password'=>$request->get('password')];
    //     }
    //         return ['username' => $request->get('email'), 'password'=>$request->get('password')];
    // }

    // public function socialSignup($provider){
    //     return Socialite::driver($provider)->redirect();

    // }
    // public function auth($provider){
    //     $user = Socialite::driver($provider)->user();
    // }

    // public function github($provider){
    //     //return Socialite::driver('github')->redirect();

    // }
    // public function githubRedirect(){
    //     //$user = Socialite::driver('github')->user();
    // }

    public function redireToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider){
        try {
            $socialUser = Socialite::driver($provider)->user();
            //dd($socialUser);

            $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();

            if(!$socialProvider){
            // Create new user to provider 
                $user = User::firstOrCreate(
                    ['email'=>$socialUser->getEmail()],
                    ['name'=>$socialUser->getName()],
                    ['status'=>'2']
                );

                $user->socialProviders()->create(
                    ['provider_id'=>$socialUser->getId(), 'provider'=>$provider]
                );

            }
            else{
                $user = $socialProvider->user;
            }

            auth()->login($user);
            return redirect('/home');
            //dd($user);

        }catch(\Exception $e){
           return redirect('/');
        }
        
        
    }
}
