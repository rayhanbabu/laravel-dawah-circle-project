<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\Notice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{

       public function home(Request $request){
            $slider = Notice::where('notice_status',1)->where('event_id',4)->orderBy('serial','asc')->get(); 
            $service = Notice::where('notice_status',1)->where('event_id',2)->orderBy('serial','asc')->get(); 
            $notice = Notice::where('notice_status',1)->where('event_id',1)->orderBy('serial','asc')->get(); 
            $testimonial = Notice::where('notice_status',1)->where('event_id',3)->orderBy('serial','asc')->get(); 
           
             return view('frontend.book',['slider'=>$slider,'service'=>$service,
                          'notice'=>$notice,'testimonial'=>$testimonial]);  
        }


        public function member_book(Request $request){
            $slider = Notice::where('notice_status',1)->where('event_id',4)->orderBy('serial','asc')->get(); 
            $service = Notice::where('notice_status',1)->where('event_id',2)->orderBy('serial','asc')->get(); 
            $notice = Notice::where('notice_status',1)->where('event_id',1)->orderBy('serial','asc')->get(); 
            $testimonial = Notice::where('notice_status',1)->where('event_id',3)->orderBy('serial','asc')->get(); 
           
             return view('frontend.book',['slider'=>$slider,'service'=>$service,
                          'notice'=>$notice,'testimonial'=>$testimonial]);  
        }




    
}
