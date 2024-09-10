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

       Route::get('/', function () {
       return view('welcome');
       });

       // Route::get('/', [HomeController::class, 'home']);
      Route::get('/cart', [HomeController::class, 'cart']);
      Route::get('/category/{category_id}', [HomeController::class, 'category_detail']);
      Route::get('/product_detail/{product_id}', [HomeController::class, 'product_detail']);
      Route::get('/checkout', [HomeController::class, 'checkout']);
      Route::get('/order_history', [HomeController::class, 'order_history']);


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
          
               
           
      
            //category 
            Route::get('/admin/category', [CategoryController::class,'category']);
            Route::get('/admin/category/manage', [CategoryController::class,'category_manage']);
            Route::get('/admin/category/manage/{id}', [CategoryController::class,'category_manage']);
            Route::post('/admin/category/insert', [CategoryController::class,'category_insert']);
            Route::get('/admin/category/delete/{id}', [CategoryController::class,'category_delete']);


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


           //event  
           Route::get('/admin/event', [EventController::class,'event']);
           Route::get('/admin/event/manage', [EventController::class,'event_manage']);
           Route::get('/admin/event/manage/{id}', [EventController::class,'event_manage']);
           Route::post('/admin/event/insert', [EventController::class,'event_insert']);
           Route::get('/admin/event/delete/{id}', [EventController::class,'event_delete']);
           
           
           //book 
           Route::get('/admin/book', [BookController::class,'book']);
           Route::get('/admin/book/manage', [BookController::class,'book_manage']);
           Route::get('/admin/book/manage/{id}', [BookController::class,'book_manage']);
           Route::post('/admin/book/insert', [BookController::class,'book_insert']);
           Route::get('/admin/book/delete/{id}', [BookController::class,'book_delete']);

            //Slider 
            Route::get('/admin/slider/{product_id}', [SliderController::class,'slider']);
            Route::get('/admin/slider/manage/{product_id}', [SliderController::class,'slider_manage']);
            Route::get('/admin/slider/manage/{product_id}/{id}', [SliderController::class,'slider_manage']);
            Route::post('/admin/slider/insert', [SliderController::class,'slider_insert']);
            Route::get('/admin/slider/delete/{id}', [SliderController::class,'slider_delete']);

            // Member  
            Route::get('/admin/member',[MemberController::class,'member']);
            Route::post('/admin/member/insert',[MemberController::class,'store']);
            Route::get('/admin/member_view/{id}',[MemberController::class,'edit']);
            Route::post('/admin/member/update',[MemberController::class,'update']);
            Route::delete('/admin/member/delete',[MemberController::class,'delete']);

           
           //Report Service Appointment
           Route::get('/report/appointment',[ReportController::class,'report_appointment']);
           Route::post('reportdompdf/doctor-appointment',[ReportController::class,'doctor_appointment']);
  
           //Report Service Diagnostic
            Route::get('/report/diagnostic',[ReportController::class,'report_diagnostic']);

           //Report Nursing
            Route::get('/report/nursing',[ReportController::class,'report_nursing']);
 
            //Report Ambulance
            Route::get('/report/ambulance',[ReportController::class,'report_ambulance']);

            //Report Ambulance
            Route::get('/report/medicine',[ReportController::class,'report_medicine']);

           //Report Rating
            Route::get('/report/rating',[ReportController::class,'report_rating']);
          
          });


        //Member login
        Route::get('/member/login',[MemberAuthController::class,'login'])->middleware('MemberTokenExist');
        Route::get('/member/register',[MemberAuthController::class,'register'])->middleware('MemberTokenExist');
        Route::post('/member/register_insert',[MemberAuthController::class,'register_insert']);
        Route::post('/member/login_insert',[MemberAuthController::class,'login_insert']);
       
       

         Route::middleware('MemberToken')->group(function(){
              Route::get('/member/logout',[MemberAuthController::class,'logout']);
              Route::get('/member/dashboard',[MemberAuthController::class,'dashboard']);
         });  

    
    

  require __DIR__.'/auth.php';
