<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Author;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function author(Request $request){
        if ($request->ajax()) {
             $data = Author::latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
               
               ->addColumn('status', function($row){
                 $statusBtn = $row->author_status == '1' ? 
                     '<button class="btn btn-success btn-sm">Active</button>' : 
                     '<button class="btn btn-secondary btn-sm" >Inactive</button>';
                 return $statusBtn;
               })
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/author/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/author/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
             })
               ->rawColumns(['status','edit','delete'])
               ->make(true);
            }
          return view('admin.author');  
      }


      public function author_manage(Request $request, $id=''){
         if($id>0){
                $arr=Author::where(['id'=>$id])->get();
                $result['id']=$arr['0']->id;
                $result['author_name']=$arr['0']->author_name;
                $result['author_status']=$arr['0']->author_status;   
           }else{
               $result['id']='';
               $result['author_name']='';
               $result['author_status']='';
            }

            return view('admin.author_manage',$result);  
        }

      public function author_insert(Request $request)
      {
    
          if(!$request->input('id')){
              $request->validate([
                 'author_name' => 'required|unique:authors,author_name',
                 'author_status' => 'required',
               ]);
          }else{
              $request->validate([
                 'author_name' => 'required|unique:authors,author_name,'.$request->post('id'),
                 'author_status' => 'required',
              ]
            );
          }

        $user=Auth::user();
      if($request->post('id')>0){
          $model=Author::find($request->post('id'));
          $model->updated_by=$user->id;
      }else{
           $model= new Author; 
           $model->created_by=$user->id;
       }
         $model->author_name=$request->input('author_name');
         $model->author_status=$request->input('author_status');
         $model->save();

         return redirect('/admin/author')->with('success', 'Changes saved successfully.');

      }


      public function author_delete(Request $request,$id){         
         $model=Author::find($id);
         $model->delete();
         return back()->with('success', 'Data deleted successfully.');

       }

}
