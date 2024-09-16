<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class RegistrationController extends Controller
{

    public function home_event_registration(Request $request)
    {

        return view('frontend.event_registration');
    }
    
    public function event_registration(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'registration'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'department'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'passing_year'=>'required',
            'resident'=>'required',
            'registration_type'=>'required',
         ]
       );


       $formData = [
        'name' => $request->name,
        'registration' => $request->registration,
        'email' => $request->email,
        'phone' => $request->phone,
        'department' => $request->department,
        'address' => $request->address,
        'gender' => $request->gender,
        'passing_year' => $request->passing_year,
        'category_id' =>215,
        'resident' => $request->resident, 
        'registration_type' => $request->registration_type,
    ];
    
    // Send data to the external API
    $response = Http::post('https://amaderthikana.com/api/dudcircle/nonmember_invoice_create', $formData);

    // Handle the response from the API
    if ($response->successful()) {
        // API call successful
        $result=$response->json();

         if($result['status']==600){
            return back()->with('fail', $result['message']);
         }else if($result['status']==200 && $request->registration_type=="Paid"){
              return redirect('/event/payment_process/'.$result['tran_id']);
         }else if($result['status']==200 && $request->registration_type=="Free"){
            $subject = 'Dhaka University Dawah Circle';
            $body = $request->name.", REgistration:".$request->registration.', Phone:'.$request->phone;
            $link="Registration for Dhaka University Dawah Circle's DU Seerat Mahfil 2024 was successful";
           
            SendEmail($request->email, $subject, $body, $link, "Dhaka University Dawah Circle");
            return back()->with('success', 'Your Registration has been successfully');

         }  else{
            return back()->with('fail', 'Failed to submit data to the API. Please try again.');
         };
        
    } else {
        // Handle API error response
        return back()->with('fail', 'Failed to submit data to the API. Please try again.');
    }

    }



    public function payment_process(Request $request)
    {
        $response = Http::get('https://amaderthikana.com/api/dudcircle/nonmember_invoice_view/'.$request->tran_id);

        $data = $response->json();

        if($data['data']){
             return view('frontend.payment_process',['data'=>$data['data']]); 
         }else{
             return "Invalid URl";
         }
       
    }


    
}
