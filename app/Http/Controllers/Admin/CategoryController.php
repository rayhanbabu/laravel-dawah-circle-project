<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function category(Request $request){
        if ($request->ajax()) {
             $data = Category::latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
               
               ->addColumn('status', function($row){
                 $statusBtn = $row->category_status == '1' ? 
                     '<button class="btn btn-success btn-sm">Active</button>' : 
                     '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                 return $statusBtn;
               })
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/category/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/category/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
             })
               ->rawColumns(['status','edit','delete'])
               ->make(true);
            }
          return view('admin.category');  
      }


      public function category_manage(Request $request, $id=''){
         if($id>0){
                $arr=Category::where(['id'=>$id])->get();
                $result['id']=$arr['0']->id;
                $result['category_name']=$arr['0']->category_name;
                $result['category_status']=$arr['0']->category_status;   
           }else{
               $result['id']='';
               $result['category_name']='';
               $result['category_status']='';
            }

            return view('admin.category_manage',$result);  
        }

      public function category_insert(Request $request)
      {
    
          if(!$request->input('id')){
              $request->validate([
                 'category_name' => 'required|unique:categories,category_name',
                 'category_status' => 'required',
               ]);
          }else{
              $request->validate([
                 'category_name' => 'required|unique:categories,category_name,'.$request->post('id'),
                 'category_status' => 'required',
              ]
            );
          }

        $user=Auth::user();
      if($request->post('id')>0){
          $model=Category::find($request->post('id'));
          $model->updated_by=$user->id;
      }else{
           $model= new Category; 
           $model->created_by=$user->id;
       }
         $model->category_name=$request->input('category_name');
         $model->category_status=$request->input('category_status');
         $model->save();

         return redirect('/admin/category')->with('success', 'Changes saved successfully.');

      }


      public function category_delete(Request $request,$id){         
         $model=Category::find($id);
         $model->delete();
         return back()->with('success', 'Data deleted successfully.');

       }

}
