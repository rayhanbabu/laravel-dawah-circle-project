<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class RegistrationController extends Controller
{
    
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
    ];
    
    // Send data to the external API
    $response = Http::post('https://amaderthikana.com/api/dudcircle/nonmember_invoice_create', $formData);

    // Handle the response from the API
    if ($response->successful()) {
        // API call successful
        $result=$response->json();

         if($result['status']==600){
            return back()->with('fail', $result['message']);
         }else if($result['status']==200){
              return redirect('/event/payment_process/'.$result['tran_id']);
         }else{
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
