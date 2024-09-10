<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Hall;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class HallController extends Controller
{
    public function hall(Request $request){
        if ($request->ajax()) {
             $data = Hall::latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
               
               ->addColumn('status', function($row){
                 $statusBtn = $row->hall_status == '1' ? 
                     '<button class="btn btn-success btn-sm">Active</button>' : 
                     '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                 return $statusBtn;
               })
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/hall/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/hall/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
             })
               ->rawColumns(['status','edit','delete'])
               ->make(true);
            }
          return view('admin.hall');  
      }


      public function hall_manage(Request $request, $id=''){
         if($id>0){
                $arr=Hall::where(['id'=>$id])->get();
                $result['id']=$arr['0']->id;
                $result['hall_name']=$arr['0']->hall_name;
                $result['hall_status']=$arr['0']->hall_status;   
           }else{
               $result['id']='';
               $result['hall_name']='';
               $result['hall_status']='';
            }

            return view('admin.hall_manage',$result);  
        }

      public function hall_insert(Request $request)
      {
    
          if(!$request->input('id')){
              $request->validate([
                 'hall_name' => 'required|unique:halls,hall_name',
                 'hall_status' => 'required',
               ]);
          }else{
              $request->validate([
                 'hall_name' => 'required|unique:halls,hall_name,'.$request->post('id'),
                 'hall_status' => 'required',
              ]
            );
          }

        $user=Auth::user();
      if($request->post('id')>0){
          $model=Hall::find($request->post('id'));
          $model->updated_by=$user->id;
      }else{
           $model= new Hall; 
           $model->created_by=$user->id;
       }
         $model->hall_name=$request->input('hall_name');
         $model->hall_status=$request->input('hall_status');
         $model->save();

         return redirect('/admin/hall')->with('success', 'Changes saved successfully.');

      }


      public function hall_delete(Request $request,$id){         
         $model=Hall::find($id);
         $model->delete();
         return back()->with('success', 'Data deleted successfully.');

       }

}
