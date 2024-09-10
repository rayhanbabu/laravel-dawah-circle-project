<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function event(Request $request){
        if ($request->ajax()) {
             $data = Event::latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
               
               ->addColumn('status', function($row){
                 $statusBtn = $row->event_status == '1' ? 
                     '<button class="btn btn-success btn-sm">Active</button>' : 
                     '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                 return $statusBtn;
               })
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/event/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/event/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
             })
               ->rawColumns(['status','edit','delete'])
               ->make(true);
            }
          return view('admin.event');  
      }


      public function event_manage(Request $request, $id=''){
         if($id>0){
                $arr=Event::where(['id'=>$id])->get();
                $result['id']=$arr['0']->id;
                $result['event_name']=$arr['0']->event_name;
                $result['event_status']=$arr['0']->event_status;   
           }else{
               $result['id']='';
               $result['event_name']='';
               $result['event_status']='';
            }

            return view('admin.event_manage',$result);  
        }

      public function event_insert(Request $request)
      {
    
          if(!$request->input('id')){
              $request->validate([
                 'event_name' => 'required|unique:events,event_name',
                 'event_status' => 'required',
               ]);
          }else{
              $request->validate([
                 'event_name' => 'required|unique:events,event_name,'.$request->post('id'),
                 'event_status' => 'required',
              ]
            );
          }

        $user=Auth::user();
      if($request->post('id')>0){
          $model=Event::find($request->post('id'));
          $model->updated_by=$user->id;
      }else{
           $model= new Event; 
           $model->created_by=$user->id;
       }
         $model->event_name=$request->input('event_name');
         $model->event_status=$request->input('event_status');
         $model->save();

         return redirect('/admin/event')->with('success', 'Changes saved successfully.');

      }


      public function event_delete(Request $request,$id){         
         $model=Event::find($id);
         $model->delete();
         return back()->with('success', 'Data deleted successfully.');

       }

}
