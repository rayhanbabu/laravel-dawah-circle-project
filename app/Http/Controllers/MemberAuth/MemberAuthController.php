<?php

namespace App\Http\Controllers\MemberAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\MemberJWTToken;
use App\Models\Hall;
use App\Models\Member;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\URL;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Models\Notice;
use App\Models\Memberforgetpassword;
use App\Models\Forgetpassword;
use  DateTime;


class MemberAuthController extends Controller
{
  

       public function login(Request $request){
            $slider = Notice::where('notice_status',1)->where('event_id',4)->orderBy('serial','asc')->get(); 
            $service = Notice::where('notice_status',1)->where('event_id',2)->orderBy('serial','asc')->get(); 
            $notice = Notice::where('notice_status',1)->where('event_id',1)->orderBy('serial','asc')->get(); 
            $testimonial = Notice::where('notice_status',1)->where('event_id',3)->orderBy('serial','asc')->get(); 
       
             return view('frontend.login',['slider'=>$slider,'service'=>$service,
                        'notice'=>$notice,'testimonial'=>$testimonial]);  
        }






    public function register(Request $request)
      {
         try {            
                return view('frontend.register');
        
            } catch (Exception $e) {
                return  view('errors.error', ['error' => $e]);
           }
      }


      public function register_insert(Request $request)
      {
          $request->validate([
              'name' => ['required', 'string', 'max:255'],
              'hall_id' => ['required', 'string', 'max:255'],
              'registration' => ['required', 'string', 'min:10', 'max:15', 'unique:'.Member::class],
              'phone' => ['required', 'string', 'min:10', 'max:15', 'unique:'.Member::class],
              'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Member::class],
              'password' => ['required', 'confirmed', Rules\Password::defaults()],
          ]);
  
          $user = Member::create([
              'name' => $request->name,
              'status' => 1,
              'email_verify_status' => 0,
              'phone' => $request->phone,
              'hall_id' => $request->hall_id,
              'registration' => $request->registration,
              'address' => $request->address,
              'member_category' => "Online",
              'email' => $request->email, 
              'emailmd5' => md5($request->email), 
              'gender' => $request->gender, 
              'password' => Hash::make($request->password),
              'ip_address' => $request->ip(),
          ]);
          $subject = 'Account Verify with Dhaka University Dawah Circle';
          $body = 'Please Click URL and verify your email to complete your account setup.';
          $link=URL::to('email_verify/'.md5($request->input('email')));
         
          SendEmail($request->email, $subject, $body, $link, "Dhaka University Dawah Circle");

  
          return redirect('member/login')->with('success','Registration Successfully. Please verify your email address using the link sent to '.$request->email);
      }


      public function email_verify($emailmd5){
           $data=Member::where('emailmd5',$emailmd5)->first();
           if($data){
           if($data->email_verify_status==1){
                return redirect('member/login')->with('success','E-mail already verified'); 
           }else{
               $rand=1;
               DB::update("update members set email_verify_status ='$rand' where emailmd5 = '$emailmd5'");
            return  redirect('member/login')->with('success','E-mail verified');
          }

        }else{
                return redirect('member/login')->with('fail','E-mial does not match');
             }
    
    
    
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

            if ($member && $member->status == 0) {
                // If the user exists and their status is inactive, throw an exception
                throw ValidationException::withMessages([
                    'email' => ['Your account is inactive.'],
                ]);
            }


            if ($member && $member->email_verify_status == 0) {
                // If the user exists and their status is inactive, throw an exception
                throw ValidationException::withMessages([
                    'email' => ['Your email has not been verified.'],
                ]);
            }


            
            if (!$member || !Hash::check($request->password, $member->password)) {
                // Increment the throttle attempts if login fails
                RateLimiter::hit($throttleKey);
        
                throw ValidationException::withMessages([
                    'email' => ['These credentials do not match our records.'],
                ]);
            }
        
            // Reset the rate limiter on successful login
            RateLimiter::clear($throttleKey);
        
            $token_member = MemberJWTToken::CreateToken($member->name, $member->email, $member->id, $member->gender);
            Cookie::queue('token_member',$token_member, 60*24*30); //96 hour

             $member_info = [
                "name" => $member->name, "email" => $member->email, 
             ];
             $member_info_array = serialize($member_info);
             Cookie::queue('member_info', $member_info_array, 60 * 24*30);

    
            // You can also update any status or redirect here
            return redirect("/member/dashboard")->with('success', 'Logged in successfully!');
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

           return view('frontend.dashboard');

      } catch (Exception $e) {
          return  view('errors.error', ['error' => $e]);
      }
    }





     public function forget_password(Request $request)
      {
        $emailSend = $request->query('email_send','');
        return view('frontend.forget-password',['emailSend'=>$emailSend]);
      }


      public function forget_password_send(Request $request){

        $email=$request->input('email'); 
        $uniqueCode = Str::random(40);    
        

        $request->validate([
            'email' => ['required'],
           ],
        );

        $user=Member::where('email',$email)->first();
     
        if($user){
         
           $model = new Memberforgetpassword;
           $model->email = $email;
           $model->token = $uniqueCode;
           $model->save();

           $subject = 'Password Reset (Dhaka University Dawah Circle)';
           $body = 'Hello '.$user->name. '. Please go to the below link and choose a new password';
           $link=URL::to('member/reset_password/'.$model->token);
           SendEmail($request->email, $subject, $body, $link,"Dhaka University Dawah Circle");
           return redirect('member/forget_password?email_send=Yes')->with('success','A verification link has been send to your email. Please login and verify.'); 
         }else{
              return back()->with('fail', 'Invalid E-mail.');
         }
   
      }

      public function reset_password(Request $request)
       {
         $reset_token=$request->token;
         $date_with_time = date("Y-m-d H:i:s");
         $forget=Memberforgetpassword::where('token',$reset_token)->first();
       
         if($forget){
           //60*8=48hour
           $time=getMinutesBetween2Dates(new DateTime($forget->created_at), new DateTime($date_with_time), $absolute = true);
           if($time<480){
                return view('frontend.reset-password',['reset_token'=>$reset_token]);
           }else{
                 return "The reset password link has expired.";
             }
           }else{
             return "The reset password link Invalid.";
           } 
       }


       public function reset_password_update(Request $request)
       {
            $new_password=$request->input('new_password');
            $confirm_password=$request->input('confirm_password');
            $reset_token=$request->input('reset_token');
          
            $forget=Memberforgetpassword::where('token',$reset_token)->first();

            $request->validate([
               'new_password' => ['required', Rules\Password::defaults()],
            ]);
  
           if($forget){
               if($new_password==$confirm_password){
                    $password=Hash::make($new_password);
                    DB::update("update members set password ='$password' where email = '$forget->email'");
                    return redirect('/member/login')->with('success','Passsword change  successfully');
                }else{
                   return back()->with('fail','New Password and Confirm Password does not match');
                }
            }else{
              return back()->with('fail', 'Invalid  Reset Password link.');
            }
         
       }




}
