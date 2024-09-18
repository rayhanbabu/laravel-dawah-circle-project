@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('event_verification','active')
@section('homecontent')

<div class="container mt-5 shadow p-4 rounded">
    <h5 style="margin:0px;" class="text-center">ঢাবি সীরাত মাহফিল ও পুরস্কার বিতরণী- ২০২৪ প্রবেশাধিকার যাচাই</h5>

   
           <br>
<form  method="POST" id="add_employee_form" enctype="multipart/form-data">
        <div class="row">
             <div class="col-sm-4 mb-3">
                   <label for="gender" class="form-label">Search Type</label>
                   <select class="form-select" id="status" name="status" required>
                      <option value="registration"> DU Registration </option>
                      <option value="id"> Registration Id </option>
                  </select>
              </div>

              <div class="col-sm-4 mb-3">
                  <label for="name" class="form-label"> DU Registartion/ Registration Id</label>
                  <input type="number" class="form-control" name="registration"  id="registration" placeholder="DU Registartion/ Registration Id" required>
              </div>

              <div class="col-sm-4 mb-3">
                    <br>
              <button type="submit" id="add_employee_btn" class="btn btn-primary"> Submit </button>
       </div>    

      </div>
    </form>
</div>
  

     <div id="employeeCardContainer"> </div>
  
   

<script>
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

$("#add_employee_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
              type:'POST',
              url:"/event/verification_search",
              data: fd,
              cache: false,
              contentType: false,
              processData: false,
              dataType: 'json',
              beforeSend : function()
                   {
                   $("#add_employee_btn").prop('disabled', true).text("Searching...");
                   },
              success: function(response){
                $("#add_employee_btn").prop('disabled', false).text("Submit");
                console.log(response);
                if (response.status == "success") {
                 // Dynamically create the employee card with the response data
                 let employeeCard = `
                 <div class="container mt-2">
                    <div class="row justify-content-center">
                        <div class="col-md-6 card-container">
                            <div class="card shadow-lg">
                                <div class="card-header">
                                  
                                </div>
                                <div class="card-body">
                                    <p><strong>Registration Id:</strong> ${response.data.id}</p>
                                     <p><strong> DU Registration:</strong> ${response.data.registration}</p>
                                    <p><strong>Name:</strong> ${response.data.name}</p>
                                    <p><strong>Department:</strong> ${response.data.department}</p>
                                    <p><strong>Hall:</strong> ${response.data.address}</p>
                                    <p><strong>Registration Type:</strong> ${response.data.registration_type}</p>
                                    <p><strong>Payment Status:</strong> ${response.data.payment_status}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                
                // Replace the content inside the container with the new employee card
                $("#employeeCardContainer").html(employeeCard);
            } else {
                // Handle the error response here (e.g., show an alert)
                    let employeeCard = '<h2 class="text-center"> Data Not Found </h2>'
                $("#employeeCardContainer").html(employeeCard);
            }
                
              }
            });
      
          });


</script>


@endsection

