<?php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;
    use App\Models\Department;
    use App\Models\Event;
    use Illuminate\Support\Facades\Cookie;
    use App\Models\Hall;
       function prx($arr){
           echo "<pre>";
           print_r($arr);
           die();
       }

       function SendEmail($email,$subject,$body,$otp,$name){
        $details = [
          'subject' => $subject,
          'otp_code' =>$otp,
          'body' => $body,
          'name' => $name,
        ];
       Mail::to($email)->send(new \App\Mail\LoginMail($details));
    }


       function member_info(){
        $member_info=Cookie::get('member_info');
        $result=unserialize($member_info);
        return $result;
    }

      function getMinutesBetween2Dates(DateTime $date1, DateTime $date2, $absolute = true) {
         $interval = $date2->diff($date1);
         $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
         return (!$absolute and $interval->invert) ? -$minutes : $minutes;
      }

      function getYearsBetween2Dates(DateTime $date1, DateTime $date2, $absolute = true) {
         $interval = $date2->diff($date1);
         $years = $interval->y;
         return (!$absolute && $interval->invert) ? -$years : $years;
     }

      

      function hall(){
         $data = Hall::where('hall_status',1)->orderBy('hall_name','asc')->get();
         return $data;
     }

     function department(){
          $data = Department::where('department_status',1)->orderBy('department_name','asc')->get();
          return $data;
      }

      function event_detail(){
        $data = Event::where('event_status',1)->orderBy('event_name','asc')->get();
        return $data;
    }
  
    



   ?>
