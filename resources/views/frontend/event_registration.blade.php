@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('event_registration','active')
@section('homecontent')

<div class="container mt-5 shadow p-4 rounded">
    <h5 style="margin:0px;" class="text-center"> {!! admin_info()['program_title'] !!}  </h5>

    <p class="text-center"> <b> {!! admin_info()['program_desc'] !!}  </b> </p>
  

@if ($errors->any())
          <div class="alert alert-danger">
             <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
           </div>
       @endif

            @if(Session::has('fail'))
                <div  class="alert alert-danger"> {{Session::get('fail')}}</div>
            @endif
                           
             @if(Session::has('success'))
                   <div  class="alert alert-success"> {{Session::get('success')}}</div>
             @endif
    <form method="POST" action="{{ url('event/event_registration') }}">
    @csrf
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Enter your name" required>
            </div>

            <div class="col-sm-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" name="phone" value="{{ old('phone') }}"  maxlength="11"  pattern="[0][1][3 4 7 6 5 8 9][0-9]{8}" title="
                Please select Valid mobile number" class="form-control" id="phone" placeholder="Enter your phone number" required>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" placeholder="Enter your email" required>
            </div>

           
            <div class="col-sm-6 mb-3">

             <label for="registration" class="form-label"> Institution Type </label>
               <select class="form-select" id="registration" value="{{ old('registration') }}"  name="registration" required>
                  <option value="">Select Institution Type </option>
                  <option value="University of Dhaka">University of Dhaka</option>
                  <option value="Public University">Public University</option>
                  <option value="National University">National University</option>
                  <option value="Other University">Other University</option>
                  <option value="Private University">Private University</option>
                  <option value="Engineering University">Engineering University</option>
                  <option value="Medical College"> Medical College </option>
                  <option value="7 Colleges under DU">7 Colleges under DU</option>
                  <option value="Polytechnic Institute"> Polytechnic Institute </option>
                  <option value="Others">Others</option>
            </select>

            </div>


        </div>
        <div class="row">
 
        <div class="col-sm-6 mb-3">
    <label for="department" class="form-label"> Institution Name </label>
    <input type="text" class="form-control" value="{{ old('registration_type') }}" id="registration_type" name="registration_type"
                 placeholder="Enter Instritution Name "
                 required />
    </div>

        <div class="col-sm-6 mb-3">
    <label for="department" class="form-label">Department Name</label>
    <input type="text" class="form-control" value="{{ old('department') }}" id="department" name="department"
                 placeholder="Enter Department Name "
                 required />
    </div>

  

   
  

     </div>


        <div class="row">
           
        <div class="col-sm-6 mb-3">
                <label for="gender" class="form-label">Gender</label>
                   <select class="form-select" id="gender" name="gender" required>
                      <option value="" {{ old('gender') == '' ? 'selected' : '' }}>Select gender</option>
                      <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                      <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                  </select>
            </div>


            <div class="col-sm-6 mb-3">
                <label for="session" class="form-label">HSC Batch</label>
                <select class="form-select" id="passing_year" name="passing_year" required>
                    <option value=""> Select One</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="Before 2010">Before 2010</option>
                </select>
        </div>
   </div>



   <div class="row">
            <!-- <div class="col-sm-6 mb-3">
                <label for="gender" class="form-label">Resident at Hall</label>
                   <select class="form-select" id="resident" name="resident" required>
                      <option value="" {{ old('resident') == '' ? 'selected' : '' }}>Select Resident</option>
                      <option value="Yes" {{ old('resident') == 'Yes' ? 'selected' : '' }}>Yes</option>
                      <option value="No" {{ old('resident') == 'No' ? 'selected' : '' }}>No</option>
                  </select>
            </div> -->

            <div class="col-sm-6 mb-3">
                <label for="session" class="form-label">Registration Type</label>
                <select class="form-select" id="category_id" name="category_id" required>
        <option value="" {{ old('category_id') == '' ? 'selected' : '' }}>Select Registration Type</option>
        @foreach(event_info() as $row)
             <option value='{{ $row["id"] }}' {{ old('category_id') == $row["id"] ? 'selected' : '' }}>
                  {{ $row["category"] }}
             </option>
          @endforeach
    </select>
        </div>

        <div class="col-sm-6 mb-3">
      <label for="address" class="form-label"> Delivery Address </label>
     <input type="text" class="form-control" value="{{ old('address') }}" id="address" name="address"
                 placeholder="Enter Delivery Address "
                 required />
     </div>

   </div>



    



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
  



@endsection

