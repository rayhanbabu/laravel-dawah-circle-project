<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Department;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function department(Request $request){
        if ($request->ajax()) {
             $data = Department::latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
               
               ->addColumn('status', function($row){
                 $statusBtn = $row->department_status == '1' ? 
                     '<button class="btn btn-success btn-sm">Active</button>' : 
                     '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                 return $statusBtn;
               })
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/department/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/department/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
             })
               ->rawColumns(['status','edit','delete'])
               ->make(true);
            }
          return view('admin.department');  
      }


      public function department_manage(Request $request, $id=''){
         if($id>0){
                $arr=Department::where(['id'=>$id])->get();
                $result['id']=$arr['0']->id;
                $result['department_name']=$arr['0']->department_name;
                $result['department_status']=$arr['0']->department_status;   
           }else{
               $result['id']='';
               $result['department_name']='';
               $result['department_status']='';
            }

            return view('admin.department_manage',$result);  
        }

      public function department_insert(Request $request)
      {
    
          if(!$request->input('id')){
              $request->validate([
                 'department_name' => 'required|unique:departments,department_name',
                 'department_status' => 'required',
               ]);
          }else{
              $request->validate([
                 'department_name' => 'required|unique:departments,department_name,'.$request->post('id'),
                 'department_status' => 'required',
              ]
            );
          }

        $user=Auth::user();
      if($request->post('id')>0){
          $model=Department::find($request->post('id'));
          $model->updated_by=$user->id;
      }else{
           $model= new Department; 
           $model->created_by=$user->id;
       }
         $model->department_name=$request->input('department_name');
         $model->department_status=$request->input('department_status');
         $model->save();

         return redirect('/admin/department')->with('success', 'Changes saved successfully.');

      }


      public function department_delete(Request $request,$id){         
         $model=Department::find($id);
         $model->delete();
         return back()->with('success', 'Data deleted successfully.');

       }

}
