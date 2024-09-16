<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\MemberAuth\MemberAuthController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\HallController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Event\RegistrationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

      //  Route::get('/', function () {
      //  return view('welcome');
      //  });

       Route::get('/', [HomeController::class, 'home']);
       Route::get('/event/registration', [RegistrationController::class, 'home_event_registration']);
       Route::post('/event/event_registration', [RegistrationController::class, 'event_registration']);
       Route::get('/event/payment_process/{tran_id}', [RegistrationController::class, 'payment_process']);
       
        //Route::get('/users',[UserController::class,'user_show'])->name('users.index');
        Route::middleware('auth')->group(function () {
           Route::get('/admin/dashboard', [AdminController::class,'index']);
           Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
           Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
           Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
           Route::get('admin/logout', [AuthenticatedSessionController::class, 'destroy']);
        });


   

      //admin route
      Route::middleware('AdminMiddleware')->group(function (){
            //role Access
            Route::get('/admin/role_access', [AdminController::class,'role_access']);
            Route::get('/admin/role_access/manage', [AdminController::class,'role_access_manage']);
            Route::get('/admin/role_access/manage/{id}', [AdminController::class,'role_access_manage']);
            Route::post('/admin/role_access/insert', [AdminController::class,'role_access_insert']);
            Route::get('/admin/role_access/delete/{id}', [AdminController::class,'role_access_delete']);
          
              

            //hall 
             Route::get('/admin/hall', [HallController::class,'hall']);
             Route::get('/admin/hall/manage', [HallController::class,'hall_manage']);
             Route::get('/admin/hall/manage/{id}', [HallController::class,'hall_manage']);
             Route::post('/admin/hall/insert', [HallController::class,'hall_insert']);
             Route::get('/admin/hall/delete/{id}', [HallController::class,'hall_delete']);

             
             //department 
            Route::get('/admin/department', [DepartmentController::class,'department']);
            Route::get('/admin/department/manage', [DepartmentController::class,'department_manage']);
            Route::get('/admin/department/manage/{id}', [DepartmentController::class,'department_manage']);
            Route::post('/admin/department/insert', [DepartmentController::class,'department_insert']);
            Route::get('/admin/department/delete/{id}', [DepartmentController::class,'department_delete']);

           //event  
           Route::get('/admin/event', [EventController::class,'event']);
           Route::get('/admin/event/manage', [EventController::class,'event_manage']);
           Route::get('/admin/event/manage/{id}', [EventController::class,'event_manage']);
           Route::post('/admin/event/insert', [EventController::class,'event_insert']);
           Route::get('/admin/event/delete/{id}', [EventController::class,'event_delete']);
           
          //notice 
          Route::get('/admin/notice/{event_id}', [NoticeController::class,'notice']);
          Route::get('/admin/notice/manage/{event_id}', [NoticeController::class,'notice_manage']);
          Route::get('/admin/notice/manage/{event_id}/{id}', [NoticeController::class,'notice_manage']);
          Route::post('/admin/notice/insert', [NoticeController::class,'notice_insert']);
          Route::get('/admin/notice/delete/{id}', [NoticeController::class,'notice_delete']);

          // Member  
          Route::get('/admin/member',[MemberController::class,'member']);
          Route::post('/admin/member/insert',[MemberController::class,'store']);
          Route::get('/admin/member_view/{id}',[MemberController::class,'edit']);
          Route::post('/admin/member/update',[MemberController::class,'update']);
          Route::delete('/admin/member/delete',[MemberController::class,'delete']);


        

          });


          Route::middleware('StaffMiddleware')->group(function (){

             //category 
            Route::get('/admin/category', [CategoryController::class,'category']);
            Route::get('/admin/category/manage', [CategoryController::class,'category_manage']);
            Route::get('/admin/category/manage/{id}', [CategoryController::class,'category_manage']);
            Route::post('/admin/category/insert', [CategoryController::class,'category_insert']);
            Route::get('/admin/category/delete/{id}', [CategoryController::class,'category_delete']);


              //author 
              Route::get('/admin/author', [AuthorController::class,'author']);
              Route::get('/admin/author/manage', [AuthorController::class,'author_manage']);
              Route::get('/admin/author/manage/{id}', [AuthorController::class,'author_manage']);
              Route::post('/admin/author/insert', [AuthorController::class,'author_insert']);
              Route::get('/admin/author/delete/{id}', [AuthorController::class,'author_delete']);
 
           
               //publisher 
             Route::get('/admin/publisher', [PublisherController::class,'publisher']);
             Route::get('/admin/publisher/manage', [PublisherController::class,'publisher_manage']);
             Route::get('/admin/publisher/manage/{id}', [PublisherController::class,'publisher_manage']);
             Route::post('/admin/publisher/insert', [PublisherController::class,'publisher_insert']);
             Route::get('/admin/publisher/delete/{id}', [PublisherController::class,'publisher_delete']);


              //book 
           Route::get('/admin/book', [BookController::class,'book']);
           Route::get('/admin/book/manage', [BookController::class,'book_manage']);
           Route::get('/admin/book/manage/{id}', [BookController::class,'book_manage']);
           Route::post('/admin/book/insert', [BookController::class,'book_insert']);
           Route::get('/admin/book/delete/{id}', [BookController::class,'book_delete']);
           Route::get('/admin/report', [BookController::class,'admin_report']);
           Route::get('/admin/book/search', [BookController::class,'book_search']);

           Route::get('/admin/book_copy/manage/{id}', [BookController::class,'book_copy_manage']);
           Route::post('/admin/book_copy/insert', [BookController::class,'book_copy_insert']);


             //issue view
          Route::get('admin/issue',[HomeController::class,'issue']);
          Route::get('/admin/issue_view/{id}',[HomeController::class,'issue_edit']);
          Route::post('/admin/issue/update',[HomeController::class,'issue_update']);
 

          });


        //Member login
        Route::get('/member/login',[MemberAuthController::class,'login'])->middleware('MemberTokenExist');
        Route::get('/member/register',[MemberAuthController::class,'register'])->middleware('MemberTokenExist');
        Route::get('/email_verify/{emailmd5}',[MemberAuthController::class,'email_verify'])->middleware('MemberTokenExist');
        Route::post('/member/register_insert',[MemberAuthController::class,'register_insert']);
        Route::post('/member/login_insert',[MemberAuthController::class,'login_insert']);


        Route::get('/book',[HomeController::class,'book']);
        Route::get('/notice_detail/{id}', [HomeController::class, 'notice_detail']);
       
      
        Route::middleware('MemberToken')->group(function(){
              Route::get('/member/logout',[MemberAuthController::class,'logout']);
              Route::get('/member/dashboard',[MemberAuthController::class,'dashboard']);
              Route::get('/book_detail/{book_code}',[HomeController::class,'book_detail']);
              Route::get('/member/book_order',[HomeController::class,'book_order']);
              Route::post('/member/book_request',[HomeController::class,'book_request']);
        });  

    
    

  require __DIR__.'/auth.php';
