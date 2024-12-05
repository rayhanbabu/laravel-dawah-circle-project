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
        try {
            // Fetch admin info
            $response = Http::timeout(300)->get(baseURL() . '/home_update');
            $admin_info = $response->successful() ? $response['admin'] : null;
    
            // Fetch event info
            $response2 = Http::timeout(300)->get(baseURL() . '/booking_category');
            $event_info = $response2->successful() ? $response2['data'] : [];
    
            return view('frontend.event_registration', [
                'admin_info' => $admin_info,
                'event_info' => $event_info,
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in home_event_registration:', ['message' => $e->getMessage()]);
    
            // Optionally, you can return an error page or a fallback view
            return view('frontend.event_registration', [
                'admin_info' => null,
                'event_info' => [],
                'error' => 'An error occurred while loading the event registration page. Please try again later.',
            ]);
        }
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
            'category_id'=>'required',
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
        'category_id' =>$request->category_id,
        'registration_type' => $request->registration_type,
   
    ];
    
    // Send data to the external API
    $response = Http::connectTimeout(10)->timeout(300)->post('https://amaderthikana.com/api/dudcircle/nonmember_invoice_create', $formData);

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
        return back()->with('fail', 'An error occurred while Inserting  information. Please try again later.');
    }

    }



    public function payment_process(Request $request)
    {
        $response = Http::connectTimeout(10)->timeout(300)->get('https://amaderthikana.com/api/dudcircle/nonmember_invoice_view/'.$request->tran_id);

        $data = $response->json();

        if($data['data']){
             return view('frontend.payment_process',['data'=>$data['data']]); 
         }else{
             return "Invalid URl";
         } 
    }



    public function home_event_verification(Request $request)
    {
        try {
            // Fetch admin info
            $response = Http::timeout(300)->get(baseURL() . '/home_update');
            $admin_info = $response->successful() ? $response['admin'] : null;
    
            return view('frontend.event_search', ['admin_info' => $admin_info]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in home_event_verification:', ['message' => $e->getMessage()]);
    
            // Optionally, return an error view or provide default data
            return view('frontend.event_search', [
                'admin_info' => null,
                'error' => 'An error occurred while fetching admin information. Please try again later.',
            ]);
        }
    }


    public function verification_search(Request $request)
    {
        
        $registration=$request->registration;
        $status=$request->status;

        $response = Http::connectTimeout(10)->timeout(300)->get('https://amaderthikana.com/api/dudcircle/non_member_search/'.$registration.'/'.$status);
        $data = $response->json();

        if($data['status']=='success'){
              return response()->json([
                 'status' => 'success',
                 'data' => $data['data'],
              ]);
        }else{
             return response()->json([
                'status' =>'fail',
                'message' => 'Data Not Found',
             ]);
         }

       
        
    }


    
    


    
}
