@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('issue','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
  <div class="card-header">
  <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Book Issue  </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    
                   <div class="col-2">
                       <div class="d-grid gap-2 d-md-flex ">
                              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add</button>  
                       </div>
                     </div> 
         </div>
           
      </div>
  <div class="card-body">   
       
   <div class="row">
       <div id="success_message"></div>

         <div class="col-md-12">
           <div class="table-responsive">
                <table class="table  table-bordered data-table">
                   <thead>
                     <tr>
                        
                         <td> Name </td>
                         <td> Phone </td>
                         <td> Book name </td>
                         <td> Title </td>
                         <td> Retuested Time </td>
                         <td> Booking Time </td>
                         <td> Return Time </td>
                         <td> Status </td>
                         <td> Edit </td>
                         <td> Staff Name </td>
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


<script src="{{ asset('js/issue.js') }}"></script>

      
     

{{-- edit employee modal start --}}
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="edit_employee_form" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id">
        <div class="modal-body p-4 bg-light">
          <div class="row">

    
            <div class="col-lg-12 ">
                  <label class="">Issue Status  <span style="color:red;"> * </span> </label>
                     <select class="form-select" name="issue_status" id="edit_issue_status" aria-label="Default select example">
                        <option value="1">Return</option>
                        <option value="2">Issue</option>
                        <option value="3">Request</option>
                    </select>
            </div>


          </div>



          <div class="mt-2" id="avatar"> </div>

          <div class="loader">
            <img src="{{ asset('images/abc.gif') }}" alt="" style="width: 50px;height:50px;">
          </div>

          <div class="mt-4">
            <button type="submit" id="edit_employee_btn" class="btn btn-success">Update </button>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}






@endsection