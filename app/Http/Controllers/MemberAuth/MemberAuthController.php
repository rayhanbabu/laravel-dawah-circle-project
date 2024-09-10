<?php

namespace App\Http\Controllers\MemberAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\MemberJWTToken;
use App\Models\Member;
use Illuminate\Validation\Rules;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class MemberAuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            return view('memberauth.login');
        } catch (Exception $e) {
            return  view('errors.error', ['error' => $e]);
        }
    }


    public function register(Request $request)
      {
         try {
             return view('memberauth.register');
          } catch (Exception $e) {
             return  view('errors.error', ['error' => $e]);
          }
      }


      public function register_insert(Request $request)
      {
          $request->validate([
              'name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Member::class],
              'password' => ['required', 'confirmed', Rules\Password::defaults()],
          ]);
  
          $user = Member::create([
              'name' => $request->name,
              'status' => 1,
              'email_verify_status' => 0,
              'phone' => $request->phone,
              'email' => $request->email, 
              'password' => Hash::make($request->password),
          ]);
  
          return redirect('member/login')->with('success','Registration Successfully');
      }



  
        public function login_insert(Request $request)
        {
            // Validate the input
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string'],
            ]);
        
            // Rate-limiting (Throttle)
            $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();
        
            if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
                throw ValidationException::withMessages([
                    'email' => ['Too many login attempts. Please try again in ' . RateLimiter::availableIn($throttleKey) . ' seconds.'],
                ]);
            }
        
            // Retrieve member by email
            $member = Member::where('email', $request->email)->first();
            
            if (!$member || !Hash::check($request->password, $member->password)) {
                // Increment the throttle attempts if login fails
                RateLimiter::hit($throttleKey);
        
                throw ValidationException::withMessages([
                    'email' => ['These credentials do not match our records.'],
                ]);
            }
        
            // Reset the rate limiter on successful login
            RateLimiter::clear($throttleKey);
        
            $token_member = MemberJWTToken::CreateToken($member->name, $member->email, $member->id);
            Cookie::queue('token_member',$token_member, 60*24*30); //96 hour

             $member_info = [
                "name" => $member->name, "email" => $member->email, 
             ];
             $member_info_array = serialize($member_info);
             Cookie::queue('member_info', $member_info_array, 60 * 24*30);

    
            // You can also update any status or redirect here
            return redirect("/")->with('success', 'Logged in successfully!');
        }
     

    public function logout()
    {
        Cookie::queue('token_member', '', -1);
        Cookie::queue('member_info', '', -1);
        return redirect('member/login');
    }


    public function dashboard(Request $request)
     {
       try {

           return view('member.dashboard');

      } catch (Exception $e) {
          return  view('errors.error', ['error' => $e]);
      }
}




}
