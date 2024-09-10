<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function slider(Request $request,$product_id){

        if ($request->ajax()) {
             $data=Slider::leftjoin('products','products.id','=','sliders.product_id')
             ->where('product_id',$product_id)
             ->select('products.product_name','sliders.*')->latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                  $imageUrl = asset('uploads/admin/'.$row->image); // Assuming 'image' is the field name in the database
                  return '<img src="'.$imageUrl.'" alt="Image" style="width: 50px; height: 50px;"/>';
                })
               ->addColumn('status', function($row){
                 $statusBtn = $row->slider_status == '1' ? 
                     '<button class="btn btn-success btn-sm">Active</button>' : 
                     '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                 return $statusBtn;
               })
            
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/slider/manage/'.$row->product_id.'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/slider/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
               })
               ->rawColumns(['image','status','edit','delete'])
               ->make(true);
            }

          return view('admin.slider',['product_id'=>$product_id]);  
      }


      public function slider_manage(Request $request, $product_id,$id=''){   
          
           $result['product_id']=$product_id;
           if($id>0){
               $arr=Slider::where(['id'=>$id])->get();
               $result['id']=$arr['0']->id;
               $result['serial']=$arr['0']->serial;  
               $result['title']=$arr['0']->title; 
               $result['slider_status']=$arr['0']->slider_status;         
          } else {
              $result['id']='';
              $result['serial']='';  
              $result['title']='';  
              $result['slider_status']='';     
          }

            return view('admin.slider_manage',$result);  
        }

      public function slider_insert(Request $request)
      {
          if(!$request->input('id')){
              $request->validate([
                 'title' => 'required',
                 'serial' => 'required',
                 'product_id' => 'required',
                 'image' => 'image|mimes:jpeg,png,jpg|max:400',
               ]);
          }else{
              $request->validate([
                'title' => 'required',
                'serial' => 'required',
                'product_id' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:400',
              ]);
          }

          $user=Auth::user();
       if($request->post('id')>0){
           $model=Slider::find($request->post('id'));
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


      }else{
            $model= new Slider; 
            $model->created_by=$user->id;

            if ($request->hasfile('image')) {
                $imgfile = 'booking-';
                $image = $request->file('image');
                $new_name = $imgfile . rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admin'), $new_name);
                $model->image = $new_name;   
            }
        }

          $model->title=$request->input('title');
          $model->product_id=$request->input('product_id');
          $model->serial=$request->input('serial');
          $model->slider_status=$request->input('slider_status');
          $model->save();

          return redirect('/admin/slider/'.$request->input('product_id'))->with('success', 'Changes saved successfully.');

      }


         public function slider_delete(Request $request,$id){  
             
              $model = Slider::find($id);
              $filePath = public_path('uploads/admin') . '/' . $model->image;
              if (File::exists($filePath)) {
                  File::delete($filePath);
              }
              $model->delete();
    
              return back()->with('success', 'Data deleted successfully.');
          }

    }
