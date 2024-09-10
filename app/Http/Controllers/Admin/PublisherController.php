<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Publisher;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function publisher(Request $request){
        if ($request->ajax()) {
             $data = Publisher::latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
               
               ->addColumn('status', function($row){
                 $statusBtn = $row->publisher_status == '1' ? 
                     '<button class="btn btn-success btn-sm">Active</button>' : 
                     '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                 return $statusBtn;
               })
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/publisher/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/publisher/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
             })
               ->rawColumns(['status','edit','delete'])
               ->make(true);
            }
          return view('admin.publisher');  
      }


      public function publisher_manage(Request $request, $id=''){
         if($id>0){
                $arr=Publisher::where(['id'=>$id])->get();
                $result['id']=$arr['0']->id;
                $result['publisher_name']=$arr['0']->publisher_name;
                $result['publisher_status']=$arr['0']->publisher_status;   
           }else{
               $result['id']='';
               $result['publisher_name']='';
               $result['publisher_status']='';
            }

            return view('admin.publisher_manage',$result);  
        }

      public function publisher_insert(Request $request)
      {
    
          if(!$request->input('id')){
              $request->validate([
                 'publisher_name' => 'required|unique:publishers,publisher_name',
                 'publisher_status' => 'required',
               ]);
          }else{
              $request->validate([
                 'publisher_name' => 'required|unique:publishers,publisher_name,'.$request->post('id'),
                 'publisher_status' => 'required',
              ]
            );
          }

        $user=Auth::user();
      if($request->post('id')>0){
          $model=Publisher::find($request->post('id'));
          $model->updated_by=$user->id;
      }else{
           $model= new Publisher; 
           $model->created_by=$user->id;
       }
         $model->publisher_name=$request->input('publisher_name');
         $model->publisher_status=$request->input('publisher_status');
         $model->save();

         return redirect('/admin/publisher')->with('success', 'Changes saved successfully.');

      }


      public function publisher_delete(Request $request,$id){         
         $model=Publisher::find($id);
         $model->delete();
         return back()->with('success', 'Data deleted successfully.');

       }

}
