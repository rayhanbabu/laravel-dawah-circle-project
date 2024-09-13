<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\Issue;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;


class HomeController extends Controller
{

       public function home(Request $request){
              $slider = Notice::where('notice_status',1)->where('event_id',4)->orderBy('serial','asc')->get(); 
              $service = Notice::where('notice_status',1)->where('event_id',2)->orderBy('serial','asc')->get(); 
              $notice = Notice::where('notice_status',1)->where('event_id',1)->orderBy('serial','asc')->get(); 
              $testimonial = Notice::where('notice_status',1)->where('event_id',3)->orderBy('serial','asc')->get(); 
              return view('frontend.home',['slider'=>$slider,'service'=>$service,'notice'=>$notice,'testimonial'=>$testimonial]);  
        }

        public function notice_detail(Request $request){
             $id=$request->id;
             $notice=Notice::find($id);
             return view('frontend.notice_detail',['notice'=>$notice]);
        }


       public function book(Request $request){
             $search = $request->input('search');
             $book=DB::table('books')->where('title', 'like', '%' . $search . '%')->select('book_code',DB::raw('count(id) as id_total')
             ,DB::raw('max(title) as title') ,DB::raw('max(image) as image'))->orderBy('book_code','asc')
             ->groupBy('book_code')->paginate(2);
             return view('frontend.book',compact('book', 'search'));  
        }


        public function book_order(Request $request){

            $gender = $request->header('gender');
            if ($request->ajax()) {
                $data=Book::leftjoin('authors','authors.id','=','books.author_id') 
                 ->leftjoin('categories','categories.id','=','books.category_id') 
                 ->leftjoin('publishers','publishers.id','=','books.publisher_id')
                 ->where('books.gender',$gender)->where('books.book_status','!=',0) 
                 ->select('authors.author_name','categories.category_name'
                 ,'publishers.publisher_name','books.*')->latest()->get();
                 return Datatables::of($data)
                    ->addIndexColumn()
                  
                    ->addColumn('status', function($row) {
                        // Check the book status and return the corresponding button
                        if ($row->book_status == 1) {
                            $statusBtn = '<button class="btn btn-success btn-sm">Available</button>';
                        } elseif ($row->book_status == 2) {
                            $statusBtn = '<button class="btn btn-danger btn-sm">Booked</button>';
                        } elseif ($row->book_status == 3) {
                            $statusBtn = '<button class="btn btn-warning btn-sm">Requested</button>';
                        } else {
                            $statusBtn = '<button class="btn btn-secondary btn-sm">Unknown</button>';
                        }
                    
                        return $statusBtn;
                    })
                    ->addColumn('delete', function($row) {
                        // Check if the book_status is 1
                        if ($row->book_status == 1) {
                            $btn = '<a href="javascript:void(0);" data-book_status="' . $row->book_status . '" data-book_id="' . $row->book_id . '" class="delete btn btn-primary btn-sm">Request Now</a>';
                            return $btn;
                        }
                    
                        // Return null if book_status is not 1
                        return null;
                    })
                 
                  ->rawColumns(['status','delete'])
                  ->make(true);
               }
             return view('frontend.book_order');  
        }


        public function book_request(Request $request){
              
             $book_id=$request->book_id;
             $book_status=$request->book_status;
             $member_id = $request->header('member_id');
             $gender = $request->header('gender');

             $date= date("Y-m-d");
             $time=date("Y-m-d H:i:s");

             $book=Book::where('book_id',$book_id)->first();

             if($book->book_status==1 && $book->gender==$gender){
              
                $model= new Issue; 
                $model->user_id=$book->user_id;
                $model->gender=$book->gender;
                $model->member_id=$member_id;
                $model->book_id=$book_id;
                $model->issue_status=3;
                $model->request_time=$time;
                $model->request_date=$date;
                $model->save();
   
   
               DB::update("update books set book_status ='3' where book_id = '$book_id'");

               return response()->json([
                   'status' => 'success',
                   'message' => 'Requested Successfully',
                 ],200);
             }else{
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Book Not Available',
                ],200);
             }

        }



        public function issue(Request $request){

             $auth=Auth::user();
             if ($request->ajax()) {
                if($auth->userType=='Admin'){
                 $data = Issue::leftjoin('members','members.id','=','issues.member_id') 
                  ->leftjoin('users','users.id','=','issues.user_id')
                  ->leftjoin('books','books.book_id','=','issues.book_id')
                  ->leftjoin('authors','authors.id','=','books.author_id') 
                  ->select('authors.author_name','members.name as member_name','members.phone'
                  ,'users.name as user_name','books.title','issues.*')->latest()->get();
                }else{
                    $data = Issue::leftjoin('members','members.id','=','issues.member_id') 
                    ->leftjoin('users','users.id','=','issues.user_id')
                    ->leftjoin('books','books.book_id','=','issues.book_id')
                    ->leftjoin('authors','authors.id','=','books.author_id') 
                    ->where('issues.user_id',$auth->id)
                    ->select('authors.author_name','members.name as member_name','members.phone'
                    ,'users.name as user_name','books.title','issues.*')->latest()->get();
                }

                 return Datatables::of($data)
                   ->addIndexColumn()
                   ->addColumn('status', function($row) {
                     // Check the book status and return the corresponding button
                     if ($row->issue_status == 1) {
                         $statusBtn = '<button class="btn btn-success btn-sm">Return</button>';
                     } elseif ($row->issue_status == 2) {
                         $statusBtn = '<button class="btn btn-danger btn-sm">Booked</button>';
                     } elseif ($row->issue_status == 3) {
                         $statusBtn = '<button class="btn btn-warning btn-sm">Requested</button>';
                     } else {
                         $statusBtn = '<button class="btn btn-secondary btn-sm">Unknown</button>';
                     }
                
                    return $statusBtn;
                })
                ->addColumn('edit', function($row){
                  $btn = '<a href="javascript:void(0);" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</a>';
                  return $btn;
              })
               
                ->rawColumns(['status','edit'])
                ->make(true);
             }
      
                return view('admin.issue');  
            }


      

            public function issue_edit(Request $request)
            {
              $id = $request->id;
              $data = Issue::find($id);
                return response()->json([
                    'status' => 200,
                    'value' => $data,
                ]);
             }


             public function issue_update(Request $request)
             {
                 $validator = \Validator::make($request->all(), [
                     'issue_status' => 'required',
                     'edit_id' => 'required',
                 ]);
                 $user=Auth::user();
                 $status=$request->input('issue_status');
                 $date= date("Y-m-d");
                 $time=date("Y-m-d H:i:s");

                 if ($validator->fails()) {
                     return response()->json([
                         'status' => 400,
                         'message' => $validator->messages(),
                     ]);
                 } else {
                     $model = Issue::find($request->input('edit_id'));
                     if ($model) {
                       if($status==1){
                            $model->return_time = $time;
                            $model->return_date = $date;
                        }else if($status==2){
                            $model->issue_time = $time;
                            $model->issue_date = $date;
                        }
                       $model->issue_status = $status;
                       $model->updated_by = $user->id;
                       $model->update();

                            return response()->json([
                               'status' => 200,
                               'message' => 'Data Updated Successfully'
                             ]);
                     } else {
                         return response()->json([
                             'status' => 404,
                             'message' => 'Student not found',
                         ]);
                     }
                 }
             }
         
       


    
}
