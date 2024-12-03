<?php
    use App\Models\Author;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;
    use App\Models\Department;
    use App\Models\Event;
    use Illuminate\Support\Facades\Cookie;
    use App\Models\Hall;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Mauthor;
    use App\Models\Mcategory;
    use Illuminate\Support\Facades\Http;

       function prx($arr){
           echo "<pre>";
           print_r($arr);
           die();
       }


       function baseUrl(){
         $baseURL="https://amaderthikana.com/api/dudcircle";
         return $baseURL;
        }

       function SendEmail($email,$subject,$body,$otp,$name){
        $details = [
          'subject' => $subject,
          'body' => $body,
          'otp_code' =>$otp,
          'name' => $name,
        ];
       Mail::to($email)->send(new \App\Mail\LoginMail($details));
    }


      function admin_access(){               
         if(Auth::check() && (Auth::user()->userType == 'Admin')){
             return true;
         }else{
             return false;
          }       
      }

      function staff_access(){               
        if (Auth::check() && (Auth::user()->userType == 'Admin' || Auth::user()->userType == 'Staff')) {
             return true;
         }else{
             return false;
          }       
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


     function event_id_detail($event_id){
        $event=Event::find($event_id);
        return $event;
     }

     function author_id_detail($id) {
        $event = Author::find($id);
        
        // Check if the author exists and if author_name is not null or empty
        if ($event && !empty($event->author_name)) {
            return $event->author_name;
        } else {
            return "N/A"; // Default value when author_name is null or empty
        }
    }


      function author_detail($book_id){
          $data=Mauthor::leftjoin('authors','authors.id','=','mauthors.author_id')
            ->where('book_id',$book_id)->select('authors.author_name','mauthors.*')->get();
            return $data;
      }

      function category_detail($book_id){
        $data=Mcategory::leftjoin('categories','categories.id','=','mcategories.category_id')
        ->where('book_id',$book_id)->select('categories.category_name','mcategories.*')->get();
        return $data;
     }

       

     function admin_info(){
        $response = Http::get(baseURL().'/home_update');
             return $response['admin'];
     }

     function event_info(){
        $response = Http::get(baseURL().'/booking_category');
             return $response['data'];
     }
  
  
    



   ?>
