<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Output\Printer;

class BookController extends Controller
{
    public function book(Request $request){

        if ($request->ajax()){
            $data = Book::leftjoin('users','users.id','=','books.user_id') 
              ->leftjoin('authors','authors.id','=','books.author_id')
              ->leftjoin('publishers','publishers.id','=','books.publisher_id')
              ->leftjoin('categories','categories.id','=','books.category_id')
              ->select('users.name','authors.author_name','publishers.publisher_name'
               ,'categories.category_name','books.*')->latest()->get();
             return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                  $imageUrl = asset('/uploads/admin/'.$row->image); // Assuming 'image' is the field name in the database
                  return '<img src="'.$imageUrl.'" alt="Image" style="width: 50px; height: 50px;"/>';
                })
                ->addColumn('status', function($row) {
                  if ($row->book_status == '1') {
                      $statusBtn = '<button class="btn btn-success btn-sm">Available</button>';
                  } elseif ($row->book_status == '2') {
                      $statusBtn = '<button class="btn btn-danger btn-sm">Booked</button>';
                  } elseif ($row->book_status == '3') {
                      $statusBtn = '<button class="btn btn-warning btn-sm">Request</button>';
                  } else {
                      $statusBtn = '<button class="btn btn-secondary btn-sm">Inactive</button>';
                  }
                  return $statusBtn;
              })
               ->addColumn('slider', function($row){
                $btn = '<a href="/admin/slider/'.$row->id.'" class="edit btn btn-primary btn-sm">Slider</a>';
                return $btn;
              })
                ->addColumn('edit', function($row){
                   $btn = '<a href="/admin/book/manage/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                   return $btn;
               })
               ->addColumn('delete', function($row){
                 $btn = '<a href="/admin/book/delete/'.$row->id.'" onclick="return confirm(\'Are you sure you want to delete this item?\')" class="delete btn btn-danger btn-sm">Delete</a>';
                 return $btn;
             })
               ->rawColumns(['image','slider','status','edit','delete'])
               ->make(true);
            }
          return view('admin.book');  
      }


      public function book_manage(Request $request, $id=''){   
           $result['user']=DB::table('users')->where('userType','Staff')->where('status',1)->orderBy('name','asc')->get();
           $result['author']=DB::table('authors')->where('author_status',1)->orderBy('author_name','asc')->get();
           $result['publisher']=DB::table('publishers')->where('publisher_status',1)->orderBy('publisher_name','asc')->get();
           $result['category']=DB::table('categories')->where('category_status',1)->orderBy('category_name','asc')->get();
           if($id>0){
               $arr=book::where(['id'=>$id])->get();
               $result['id']=$arr['0']->id;
               $result['user_id']=$arr['0']->user_id;
               $result['author_id']=$arr['0']->author_id;
               $result['category_id']=$arr['0']->category_id;
               $result['publisher_id']=$arr['0']->publisher_id;
               $result['title']=$arr['0']->title;
               $result['book_status']=$arr['0']->book_status;   
               $result['desc']=$arr['0']->desc;  
               $result['serial']=$arr['0']->serial; 
               $result['page']=$arr['0']->page;
               $result['book_copy']=$arr['0']->book_copy;
          } else {
            $result['id']='';
            $result['user_id']='';
            $result['author_id']='';
            $result['category_id']='';
            $result['publisher_id']='';
            $result['title']='';
            $result['book_status']='';   
            $result['desc']='';  
            $result['serial']=''; 
            $result['page']='';
            $result['book_copy']='';
          }

            return view('admin.book_manage',$result);  
        }

      public function book_insert(Request $request)
      {
          if(!$request->input('id')){
              $request->validate([
                 'title' => 'required|unique:books,title',
                 'book_status' => 'required',
                 'author_id' => 'required',
                 'category_id' => 'required',
                 'image' => 'image|mimes:jpeg,png,jpg|max:400',
               ]);
          }else{
              $request->validate([
                 'title' => 'required|unique:books,title,'.$request->post('id'),
                 'book_status' => 'required',
                 'author_id' => 'required',
                 'category_id' => 'required',
                 'image'=> 'image|mimes:jpeg,png,jpg|max:400',
              ]);
          }

          $user=Auth::user();
       if($request->post('id')>0){
           $model=Book::find($request->post('id'));
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
            $model= new Book; 
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
          $model->author_id=$request->input('author_id');
          $model->user_id=$request->input('user_id');
          $model->category_id=$request->input('category_id');
          $model->book_status=$request->input('book_status');
          $model->publisher_id=$request->input('publisher_id');
          $model->page=$request->input('page');
          $model->book_copy=$request->input('book_copy');
          $model->desc=$request->input('desc');
          $model->serial=$request->input('serial');
          $model->save();

          return redirect('/admin/book')->with('success', 'Changes saved successfully.');

      }


         public function book_delete(Request $request,$id){  
          $model = book::find($id);
          $filePath = public_path('uploads/admin') . '/' . $model->image;
          if (File::exists($filePath)) {
              File::delete($filePath);
          }
          $model->delete();
              return back()->with('success', 'Data deleted successfully.');
          }

    }
