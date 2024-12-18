@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('week','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
  <div class="card-header">
  <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Member Information </h5></div>
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
                         <td> Email</td>
                         <td> Phone </td>
                         <td> Du Reg </td>
                         <td> Hall </td>
                         <td> Address </td>
                         <td> Email Verify </td>
                         <td> Status </td>
                         <td> Edit </td>
                         <td> Delete </td>
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

<script src="{{ asset('js/memberauth.js') }}"></script>

      
     
{{-- add new Student modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form  method="POST" id="add_employee_form" enctype="multipart/form-data">

        <div class="modal-body p-4 bg-light">
          <div class="row">


            <div class="col-lg-6">
               <label for="roll">Name<span style="color:red;"> * </span></label>
               <input type="text" name="name" id="name" class="form-control" placeholder="" required>
               <p class="text-danger error_name"></p>
            </div>


            <div class="col-lg-6 ">
                  <label class=""> Gender  <span style="color:red;"> * </span> </label>
                     <select  class="form-control" name="gender" id="gender" aria-label="Default select example">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
            </div>


            <div class="col-lg-6 ">
                <label for="roll">Registartion <span style="color:red;"> * </span> </label>
                <input type="text" name="registration"   pattern="\d{10}" 
                maxlength="10" 
                title="Please enter a valid 10-digit registration number" id="registration" class="form-control" placeholder="" required>
                <p class="text-danger error_registration"></p>
            </div>

            <div class="col-lg-6 ">
                  <label class=""> Hall Name  <span style="color:red;"> * </span> </label>
                     <select  class="form-control" name="hall_id" id="hall_id" aria-label="Default select example">
                     <option  disabled>Select your Hall</option>
                      @foreach(hall() as $row)
                        <option value="{{ $row->id }}">
                           {{ $row->hall_name }}
                        </option>
                      @endforeach      
                       
                    </select>
            </div>

            <div class="col-lg-6 ">
                <label for="roll">Email <span style="color:red;"> * </span></label>
                <input type="text" name="email" id="email" class="form-control" placeholder="" required>
                <p class="text-danger error_email"></p>
            </div>


            <div class="col-lg-6 ">
                 <label for="roll">Phone <span style="color:red;"> * </span></label>
                 <input type="text" name="phone" pattern="[0][1][3 7 6 5 8 9][0-9]{8}" title="
                 Please select Valid mobile number" id="phone" class="form-control" placeholder="" required>
                 <p class="text-danger error_phone"></p>
            </div>


            <div class="col-lg-6 ">
                <label for="roll"> Address </label>
                <input type="text" name="address" id="address" class="form-control" placeholder="" >
                <p class="text-danger error_address"></p>
            </div>

          <div class="col-lg-6 ">
               <input type="text" name="password" id="password" class="form-control" value="Member12345" readonly>
          </div>

            <ul class="alert alert-warning d-none" id="add_errorlist"></ul>

            
          </div>    
          <div class="loader">
            <img src="{{ asset('images/abc.gif') }}" alt="" style="width: 50px;height:50px;">
          </div>

        <div class="mt-4">
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Submit </button>
       </div>  

      </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
        </div>
      </form>
    </div>
  </div>
</div>

{{-- add new employee modal end --}}


{{-- edit employee modal start --}}
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="edit_employee_form" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id">
        <div class="modal-body p-4 bg-light">
          <div class="row">

          <div class="col-lg-6">
               <label for="roll">Name<span style="color:red;"> * </span></label>
               <input type="text" name="name" id="edit_name" class="form-control" placeholder="" required>
               <p class="text-danger error_name"></p>
            </div>


      

            <div class="col-lg-6 ">
                <label for="roll">Email <span style="color:red;"> * </span></label>
                <input type="text" name="email" id="edit_email" class="form-control" placeholder="" required>
                <p class="text-danger error_email"></p>
            </div>


            <div class="col-lg-6 ">
                 <label for="roll">Phone <span style="color:red;"> * </span></label>
                 <input type="text" name="phone" id="edit_phone" class="form-control" placeholder="" required>
                 <p class="text-danger error_phone"></p>
            </div>

            <div class="col-lg-6 ">
                <label for="roll">Registartion/ Employee <span style="color:red;"> * </span> </label>
                <input type="text" name="registration" id="edit_registration" class="form-control" placeholder="" required>
                <p class="text-danger error_registration"></p>
            </div>


            <div class="col-lg-6 ">
                  <label class=""> Gender  <span style="color:red;"> * </span> </label>
                     <select  class="form-control" name="gender" id="edit_gender" aria-label="Default select example">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
            </div>



            <div class="col-lg-6 ">
                  <label class=""> Hall Name  <span style="color:red;"> * </span> </label>
                     <select  class="form-control" name="hall_id" id="edit_hall_id" aria-label="Default select example">
                     <option  disabled>Select your Hall</option>
                      @foreach(hall() as $row)
                        <option value="{{ $row->id }}">
                           {{ $row->hall_name }}
                        </option>
                      @endforeach      
                       
                    </select>
            </div>


      
            <div class="col-lg-6 ">
                <label for="roll"> Image (Max:300*300px)</label>
                <input type="file" name="image" id="image" class="form-control" placeholder="" >
                <p class="text-danger error_building_image"></p>
            </div>

            <div class="col-lg-6 ">
                <label for="roll"> Address </label>
                <input type="text" name="address" id="edit_address" class="form-control" placeholder="" >
                <p class="text-danger error_address"></p>
            </div>

            <div class="col-lg-6 ">
                  <label class=""> Member Status  <span style="color:red;"> * </span> </label>
                     <select class="form-select" name="status" id="edit_status" aria-label="Default select example">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
            </div>


            <div class="col-lg-6 ">
                  <label class=""> E-mail Status  <span style="color:red;"> * </span> </label>
                     <select class="form-select" name="email_verify_status" id="edit_email_verify_status" aria-label="Default select example">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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



<script type="text/javascript">
    $(document).ready(function() {
        $('#EditModal').on('shown.bs.modal', function () {
            $('#edit_gender').select2({
                dropdownParent: $('#EditModal')
            });
        });
    });
</script>




@endsection