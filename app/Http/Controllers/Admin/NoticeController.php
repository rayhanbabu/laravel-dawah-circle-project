<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Event;
use App\Models\Notice;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NoticeController extends Controller
{

    public function notice(Request $request,$event_id){
        if ($request->ajax()) {
             $data=Notice::leftjoin('events','events.id','=','notices.event_id')
             ->where('event_id',$event_id)
             ->select('events.event_name','notices.*')->latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                  $imageUrl = asset('uploads/admin/'.$row->image); // Assuming 'image' is the field name in the database
                  return '<img src="'.$imageUrl.'" alt="Image" style="width: auto; height: 50px;"/>';
                })
               ->addColumn('status', function($row){
                 $statusBtn = $row->notice_status == '1' ? 
                     '<button class="btn btn-success btn-sm">Active</button>' : 
                     '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                 return $statusBtn;
               })
            
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/notice/manage/'.$row->event_id.'/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/notice/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
               })
               ->rawColumns(['image','status','edit','delete'])
               ->make(true);
            }

          return view('admin.notice',['event_id'=>$event_id]);  
      }


      public function notice_manage(Request $request, $event_id,$id=''){   
          
           $result['event_id']=$event_id;
           if($id>0){
               $arr=Notice::where(['id'=>$id])->get();
               $result['id']=$arr['0']->id;
               $result['serial']=$arr['0']->serial;  
               $result['title']=$arr['0']->title; 
               $result['notice_status']=$arr['0']->notice_status;     
               $result['date']=$arr['0']->date;
               $result['desc']=$arr['0']->desc;
               $result['link']=$arr['0']->link;     
               $result['text']=$arr['0']->text;       
          } else {
              $result['id']='';
              $result['serial']='';  
              $result['title']='';  
              $result['notice_status']=''; 
              $result['date']='';
              $result['desc']='';
              $result['link']='';     
              $result['text']='';          
          }

            return view('admin.notice_manage',$result);  
        }

      public function notice_insert(Request $request)
      {
          if(!$request->input('id')){
              $request->validate([
                 'title' => 'required',
                 'serial' => 'required',
                 'desc' => 'required',
                 'event_id' => 'required',
                 'image' => 'image|mimes:jpeg,png,jpg|max:600',
               ]);
          }else{
              $request->validate([
                 'title' => 'required',
                 'serial' => 'required',
                 'desc' => 'required',
                 'event_id' => 'required',
                 'image' => 'image|mimes:jpeg,png,jpg|max:600',
              ]);
          }

          $user=Auth::user();
       if($request->post('id')>0){
           $model=Notice::find($request->post('id'));
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
            $model= new Notice; 
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
          $model->event_id=$request->input('event_id');
          $model->serial=$request->input('serial');
          $model->desc=$request->input('desc');
          $model->date=$request->input('date');
          $model->link=$request->input('link');
          $model->text=$request->input('text');
          $model->notice_status=$request->input('notice_status');
          $model->save();

          return redirect('/admin/notice/'.$request->input('event_id'))->with('success', 'Changes saved successfully.');

      }


         public function notice_delete(Request $request,$id){  
              $model = Notice::find($id);
              $filePath = public_path('uploads/admin') . '/' . $model->image;
               if (File::exists($filePath)) {
                   File::delete($filePath);
               }
              $model->delete();
    
              return back()->with('success', 'Data deleted successfully.');
          }

    }
