<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Jobs\SendVerificationEmail;
class UserAuth extends Controller 
{
    public function loginPage(){
        if(Auth::check()){
            return redirect('dashboard');
        }
        return view('login');
    }
    public function signupPage(){
        if(Auth::check()){
            return redirect('dashboard');
        }
        return view('signup');

    }
       public function signup(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        
        //Email Verify Code Start

        $code = rand(111111,999999);
        $request->session()->put('verification_code', $code);
        $request->session()->put('user_email', $user->email);
        $request->session()->put('user_id', $user->id);
        $data = [
            'code'=>$code,
            'subject'=>'Verify Your Email',
        ];
        
        // Mail::to($user->email)->send(new VerifyEmail($data));
        dispatch(new SendVerificationEmail($user, $code,$data));


        
       
        return view('verify-email-page',get_defined_vars());
        //Email Verify Code End 
  
    }
    public function login(Request $request){
       
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
        $details = $request->only('email', 'password');
        
        if (Auth::attempt($details)) {
            return redirect()->intended('/dashboard');
        }
        else{
            echo "Denied";
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

// After Clicking Verify Email On Verify Email Views
    public function verifyEmail(Request $request){
        
           $request->validate([
            'verifyCode'=> 'required',
           ]);
    

        
        $verificationCode = $request->verifyCode;
        $storedCode = $request->session()->get('verification_code');
        $userId = $request->session()->get('user_id');
    
        if ($verificationCode == $storedCode) {
       
            $user = User::find($userId);
            $user->email_verified_at = now();
            $user->save();
             $request->session()->forget('verification_code');
            $request->session()->forget('user_email');
            $request->session()->forget('user_id');
    
            return redirect('login')->with('success', 'Email verification successful!');
        } else {
            return redirect('signup')->with('error', 'Invalid verification code.');
        }
    }
    public function verifyPageCheck(Request $request){
        if($request->session()->get('verification_code')){
            return view('verify-email-page');
        }
        else{
            return redirect('login');
        }
    }
    
}
