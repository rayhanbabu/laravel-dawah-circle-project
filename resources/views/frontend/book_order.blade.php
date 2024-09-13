@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('login','active')
@section('homecontent')

<div class="container my-5">

<div class="card mt-2 mb-2 shadow-sm">
  <div class="card-header">
  <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Book Order  </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                       
                         </div>
                     </div>

                    
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           
                         </div>
                     </div> 
         </div>
           
       

      </div>
  <div class="card-body">   
   <div class="row">
         <div class="col-md-12">
           <div class="table-responsive">
                <table class="table  table-bordered data-table">
                   <thead>
                     <tr>
                         <td> Book Id </td>
                         <td> Title  </td>
                         <td> Author  </td>
                         <td> Category  </td>
                         <td> Publisher  </td>
                         <td>  Status</td>
                         <td> Request </td>
                      
                      </tr>
                   </thead>
                   <tbody>

                   </tbody>

                </table>
          </div>
       </div>
    </div>


  </div>
</div>
</div>



<script src="{{ asset('js/book_order.js') }}"></script>


      

@endsection

