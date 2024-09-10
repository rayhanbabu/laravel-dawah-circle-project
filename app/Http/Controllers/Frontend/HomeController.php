<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{

       public function home(Request $request){
            $product = Product::where('product_status',1)->orderBy('serial','asc')->get(); 
            return view('frontend.home',['product'=>$product]);  
        }


        public function cart(Request $request){
            return view('frontend.cart');  
        }


        public function category_detail(Request $request){
            $category_id=$request->category_id;
            $category=Category::where('id', $category_id)->first();
            $category_product = Product::where('category_id',$category_id)->orderBy('serial','asc')->get(); 
            return view('frontend.category_product',['category_product'=>$category_product,'category'=>$category]);  
        }


        
        public function product_detail(Request $request){
             $product_id=$request->product_id;
             $product = Product::find($product_id); 
             $product_slider=Slider::where('product_id',$product_id)->orderBy('serial','asc')->get();
             return view('frontend.product_detail',['product'=>$product,'product_slider'=>$product_slider]);  
         }

        




  

}
