<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Member;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function member(Request $request){

      if ($request->ajax()) {
        $data = Member::leftjoin('halls','halls.id','=','members.hall_id') 
        ->select('halls.hall_name','members.*')
        ->latest()->get();
        return Datatables::of($data)
           ->addIndexColumn()
          ->addColumn('status', function($row){
            $statusBtn = $row->status == '1' ? 
                '<button class="btn btn-success btn-sm">Active</button>' : 
                '<button class="btn btn-secondary btn-sm" >Inactive</button>';
            return $statusBtn;
          })
          ->addColumn('edit', function($row){
            $btn = '<a href="javascript:void(0);" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</a>';
            return $btn;
        })
          ->addColumn('delete', function($row){
            $btn = '<a href="javascript:void(0);" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
            return $btn;
        })
          ->rawColumns(['status','edit','delete'])
          ->make(true);
       }

          return view('admin.member');  
      }



      public function store(Request $request)
      {
          $user=Auth::user();
          $validator = \Validator::make(
              $request->all(),
              [
                  'name'=> 'required',
                  'hall_id' => 'required',
                  'email'=>'required|unique:members,email',
                  'phone'=>'required|unique:members,phone',
                  'registration'=>'required|unique:members,registration',
                  'password'=>'required|regex:/^[a-zA-Z\d]*$/'
               ]);
  
          if ($validator->fails()) {
              return response()->json([
                  'status' =>400,
                  'message' =>$validator->messages(),
              ]);
          } else {
              $model = new Member;
              $model->name = $request->input('name');
              $model->email = $request->input('email');
              $model->emailmd5 = md5($request->input('email'));
              $model->phone = $request->input('phone');
              $model->member_category ='Offline';
              $model->registration = $request->input('registration');
              $model->address = $request->input('address');
              $model->gender = $request->input('gender');
              $model->hall_id = $request->input('hall_id');
              $model->email_verify_status =1;
              $model->password = Hash::make($request->password);
              $model->created_by=$user->id;
              $model->save();
  
              return response()->json([
                  'status' => 200,
                  'message' => 'Data Added Successfully',
              ]);
          }
      }


      public function edit(Request $request)
        {
          $id = $request->id;
          $data = Member::find($id);
            return response()->json([
                'status' => 200,
                'value' => $data,
            ]);
         }
  
  


      public function update(Request $request)
      {
  
          $user=Auth::user();
          $validator = \Validator::make($request->all(), [
              'name' => 'required',
              'hall_id' => 'required',
              'image' => 'image|mimes:jpeg,png,jpg|max:400',
              'phone' => 'required|unique:members,phone,' . $request->input('edit_id'),
              'registration' => 'required|unique:members,registration,' . $request->input('edit_id'),
              'email' => 'required|unique:members,email,' . $request->input('edit_id'),
          ]);
  
         
          if ($validator->fails()) {
              return response()->json([
                  'status' => 400,
                  'message' => $validator->messages(),
              ]);
          } else {
              $model = Member::find($request->input('edit_id'));
              if ($model) {
                $model->name = $request->input('name');
                $model->email = $request->input('email');
                $model->phone = $request->input('phone');
                $model->registration = $request->input('registration');
                $model->address = $request->input('address');
                $model->gender = $request->input('gender');
                $model->hall_id = $request->input('hall_id');
                $model->status = $request->input('status');
                $model->email_verify_status = $request->input('email_verify_status');
                $model->updated_by=$user->id;
  
                  if ($request->hasfile('image')) {
                      $imgfile = 'booking-';
                          $path = public_path('uploads/admin') . '/' . $model->image;
                          if (File::exists($path)) {
                               File::delete($path);
                          }
                          $image = $request->file('image');
                          $new_name = $imgfile . rand() . '.' . $image->getClientOriginalExtension();
                          $image->move(public_path('uploads/admin'), $new_name);
                          $model->image = $new_name;
                  }
                 $model->update();
                     return response()->json([
                        'status' => 200,
                        'message' => 'Data Updated Successfully'
                      ]);
              } else {
                  return response()->json([
                      'status' => 404,
                      'message' => 'Student not found',
                  ]);
              }
          }
      }
  

      public function delete(Request $request)
      {
  
          $model = Member::find($request->input('id'));
          $filePath = public_path('uploads/admin') . '/' . $model->image;
          if (File::exists($filePath)) {
              File::delete($filePath);
          }
          $model->delete();
          return response()->json([
              'status' => 200,
              'message' => 'Data Deleted Successfully',
          ]);
  
          // }
      }
  
     

}
