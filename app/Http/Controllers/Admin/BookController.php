<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Issue;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Output\Printer;
use App\Models\Mauthor;
use App\Models\Mcategory;

class BookController extends Controller
{
    public function book(Request $request){

        if ($request->ajax()){
             $data = Book::leftjoin('users','users.id','=','books.user_id') 
              ->leftjoin('publishers','publishers.id','=','books.publisher_id')
              ->leftjoin('halls','halls.id','=','users.hall_id') 
              ->select('users.hall_id','users.name','publishers.publisher_name'
               ,'halls.hall_name','books.*')->latest()->get();

               $results = $data->map(function($book){
                return [
                   'id' => $book->id,
                   'book_id' => $book->book_id,
                   'user_id' => $book->user_id,
                   'publisher_name' => $book->publisher_name,
                   'hall_name' => $book->hall_name,
                   'name' => $book->name,
                   'book_status' => $book->book_status,
                   'title' => $book->title,
                   'image' => $book->image,
                   'lang' => $book->lang,
                   'page' => $book->page,
                   'author_detail' => author_detail($book->book_id), // Call the function here
                   'category_detail' => category_detail($book->book_id), // Call the function here
                ];
          });

          // return $results;
          // die();
         
             $auth_id=Auth::user()->id;
             $userType=Auth::user()->userType;


             return Datatables::of($results)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                  $imageUrl = asset('/uploads/admin/'.$row['image']); // Assuming 'image' is the field name in the database
                  return '<img src="'.$imageUrl.'" alt="Image" style="width: 50px; height: 50px;"/>';
                })
                ->addColumn('author_detail', function($row) {
                  $details = '';
                   foreach ($row['author_detail'] as $author) {
                         // Concatenate product name and quantity
                          $details .= '*'.$author['author_name'] . ',';
                     }
                      return $details;  // Returning as an HTML string
               })
               ->addColumn('category_detail', function($row) {
                $details = '';
                 foreach ($row['category_detail'] as $category) {
                       // Concatenate product name and quantity
                        $details .= '*'.$category['category_name'] . ',';
                   }
                    return $details;  // Returning as an HTML string
             })
                ->addColumn('status', function($row) {
                  if ($row['book_status'] == '1') {
                       $statusBtn = '<button class="btn btn-success btn-sm">Available</button>';
                   } elseif ($row['book_status'] == '2') {
                      $statusBtn = '<button class="btn btn-danger btn-sm">Booked</button>';
                   } elseif ($row['book_status'] == '3') {
                      $statusBtn = '<button class="btn btn-warning btn-sm">Request</button>';
                   } else {
                      $statusBtn = '<button class="btn btn-secondary btn-sm">Inactive</button>';
                   }
                  return $statusBtn;
              }) 
              ->addColumn('edit', function($row) use ($auth_id,$userType) {
                if ($row['user_id'] == $auth_id OR $userType=="Admin") { // Assuming $user_id is passed in the closure
                      $btn = '<a href="/admin/book/manage/'.$row['id'].'" class="edit btn btn-primary btn-sm">Edit</a>';
                      return $btn;
                  } else {
                      return null; // No button shown if user ID doesn't match
                  }
               })
               ->addColumn('copy', function($row){
                  $btn = '<a href="/admin/book_copy/manage/'.$row['id'].'" class="edit btn btn-info btn-sm">Copy</a>';
                  return $btn;
               })
               ->addColumn('delete', function($row) use ($auth_id,$userType) {
                if ($row['user_id'] == $auth_id OR $userType=="Admin") { // Assuming $user_id is passed in the closure
                    $btn = '<a href="/admin/book/delete/'.$row['id'].'" 
                            onclick="return confirm(\'Are you sure you want to delete this item?\')" 
                            class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                } else {
                    return null; // No button if user ID doesn't match
                }
            })
               ->rawColumns(['author_detail','image','copy','status','edit','delete'])
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
               $arr=Book::where(['id'=>$id])->get();
               $result['id']=$arr['0']->id;
               $result['user_id']=$arr['0']->user_id;
               $result['publisher_id']=$arr['0']->publisher_id;
               $result['title']=$arr['0']->title;
               $result['book_status']=$arr['0']->book_status;   
               $result['desc']=$arr['0']->desc;  
               $result['serial']=$arr['0']->serial; 
               $result['page']=$arr['0']->page;
               $result['book_copy']=$arr['0']->book_copy;
               $result['lang']=$arr['0']->lang;
               $result['mul_author']=DB::table('mauthors')->where('book_id',$arr['0']->book_id)->get();
               $result['mul_category']=DB::table('mcategories')->where('book_id',$arr['0']->book_id)->get();
          } else {
            $result['id']='';
            $result['user_id']='';
            $result['publisher_id']='';
            $result['title']='';
            $result['book_status']='';   
            $result['desc']='';  
            $result['serial']=''; 
            $result['page']='';
            $result['book_copy']='';
            $result['lang']='';
            $result['mul_author']=[];
            $result['mul_category']=[];
          }

            return view('admin.book_manage',$result);  
        }

      public function book_insert(Request $request)
      {

        DB::beginTransaction();
        try {

          if(!$request->input('id')){
              $request->validate([
                 'title' => 'required',
                 'book_status' => 'required',
                 'author_id' => 'required',
                 'category_id' => 'required',
                 'image' => 'image|mimes:jpeg,png,jpg|max:800',
               ]);
          }else{
              $request->validate([
                 'title' => 'required',
                 'book_status' => 'required',
                 'author_id' => 'required',
                 'category_id' => 'required',
                 'image'=> 'image|mimes:jpeg,png,jpg|max:800',
              ]);
          }

           $auth=Auth::user();
       if($request->post('id')>0){
           $model=Book::find($request->post('id'));
           $model->updated_by=$auth->id;
            
           if ($request->hasfile('image')){
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
            $last_book_detail=Book::orderBy('id','desc')->first();
              if($last_book_detail){
                  $last_book_id=$last_book_detail->id+1;
                  $book_code=10000+$last_book_id;
                  $book_id=$book_code."-"."1";
              }else{
                  $last_book_id=1;
                  $book_code=10000+$last_book_id;
                  $book_id=$book_code."-"."1";
               }

             
             $model= new Book; 
             $model->created_by=$auth->id;
             $model->book_code=$book_code;
             $model->book_id=$book_id;

            if ($request->hasfile('image')) {
                $imgfile = 'booking-';
                $image = $request->file('image');
                $new_name = $imgfile . rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admin'), $new_name);
                $model->image = $new_name;   
            }
          }

          $user=User::find($request->input('user_id'));
  
          $model->title=$request->input('title'); 
          $model->user_id=$request->input('user_id');
          $model->book_status=$request->input('book_status');
          $model->publisher_id=$request->input('publisher_id');
          $model->page=$request->input('page');
          $model->desc=$request->input('desc');
          $model->serial=$request->input('serial');
          $model->lang=$request->input('lang');
          $model->save();



          $author_id=$request->post('author_id');
          $category_id=$request->post('category_id');

        if($request->post('id')>0){
             Mauthor::where('book_id',$model->book_id)->delete();
             Mcategory::where('book_id',$model->book_id)->delete();
             foreach($author_id as $key => $val) {
              if(isset($author_id[$key]) && $author_id[$key]) {
                  $author_model= new Mauthor; 
                  $author_model->author_id=$author_id[$key];
                  $author_model->book_id=$model->book_id;
                  $author_model->save();
               }
           }      
           
          foreach($category_id as $key => $val) {
            if(isset($category_id[$key]) && $category_id[$key]) {
                  $category_model= new Mcategory; 
                  $category_model->category_id=$category_id[$key];
                  $category_model->book_id=$model->book_id;
                  $category_model->save();
               }
          }   
           
         }else{
              foreach($author_id as $key => $val) {
                 if(isset($author_id[$key]) && $author_id[$key]) {
                     $author_model= new Mauthor; 
                     $author_model->author_id=$author_id[$key];
                     $author_model->book_id=$model->book_id;
                     $author_model->save();
                  }
              }      
              
             foreach($category_id as $key => $val) {
               if(isset($category_id[$key]) && $category_id[$key]) {
                     $category_model= new Mcategory; 
                     $category_model->category_id=$category_id[$key];
                     $category_model->book_id=$model->book_id;
                     $category_model->save();
                  }
             }   
         }
          
          DB::commit();    
          return redirect('/admin/book')->with('success', 'Changes saved successfully.');

        } catch (\Exception $e) {
          DB::rollback();
            return "Database Migration Problem. Please Try Again";
         }

      }


      public function book_copy_manage(Request $request, $id){
          $book=Book::find($id);
          $user=DB::table('users')->where('userType','Staff')->where('status',1)->orderBy('name','asc')->get();
          return view('admin.book_copy_manage',['book'=>$book,'user'=>$user]);
      }


      public function book_copy_insert(Request $request)
       {

        DB::beginTransaction();
        try {

           $id=$request->input('id');
           $auth=Auth::user();

           $book=Book::find($id);
           $last_book=Book::where('book_code',$book->book_code)->orderBy('id','desc')->first();
           $parts = explode('-', $last_book->book_id);

           $book_code = $parts[0];  // '10001'
           $secondPart = $parts[1]+1; // '01'
           $book_id=$book_code."-".$secondPart;

           $model= new Book; 
           $model->created_by=$auth->id;
           $model->book_code=$book_code;
           $model->book_id=$book_id;

        
        $model->title=$book->title;
        $model->user_id=$auth->id;
        $model->book_status=$request->input('book_status');
        $model->publisher_id=$book->publisher_id;
        $model->page=$book->page;
        $model->desc=$book->desc;
        $model->serial=$book->serial;
        $model->lang=$book->lang;
        $model->save();


        $mul_author=DB::table('mauthors')->where('book_id',$last_book->book_id)->get();
        $mul_category=DB::table('mcategories')->where('book_id',$last_book->book_id)->get();

        foreach($mul_author as $item) {
              $author_model= new Mauthor; 
              $author_model->author_id=$item->author_id;
              $author_model->book_id=$model->book_id;
              $author_model->save();
        }      
       
      foreach($mul_category as $row) {
              $category_model= new Mcategory; 
              $category_model->category_id=$row->category_id;
              $category_model->book_id=$model->book_id;
              $category_model->save();
       }   
         
           DB::commit();    
           return redirect('/admin/book')->with('success', 'Changes saved successfully.');

         } catch (\Exception $e) {
            DB::rollback();
           return "Database Migration Problem. Please Try Again";
        }

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


          public function admin_report(Request $request){
                 
              return view('admin.report');
          }

          public function book_search(Request $request){
            $phone = $request->get('phone');

            // Query to search by phone number
            $data = Issue::leftjoin('members','members.id','=','issues.member_id') 
            ->leftjoin('users','users.id','=','issues.user_id')
            ->leftjoin('books','books.book_id','=','issues.book_id')
            ->leftjoin('halls','halls.id','=','users.hall_id')
            ->where('members.phone', 'like', '%' . $phone . '%')
            ->select('members.name as member_name','members.phone as phone','halls.hall_name'
            ,'users.name as user_name','users.name as user_name','books.title','issues.*')->get();
        
            // Return the data as JSON to the frontend
            return response()->json($data);
          }

    }
