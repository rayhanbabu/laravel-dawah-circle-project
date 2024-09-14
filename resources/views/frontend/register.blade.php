@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('register','active')
@section('homecontent')


<div class="login-container">
    <h3 class="text-center login-header">Registration</h3>
    <form method="POST" action="{{ url('member/register_insert') }}">
    @csrf


         <div class="mb-3">
              <label for="Name" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="Enter your Name" required>
         </div>

      <div class="mb-3">
         <label for="registration" class="form-label">DU Registration No</label>
            <input type="text" name="registration" value="{{ old('registration') }}" class="form-control" id="registration" 
                placeholder="Enter your Registration Number" 
                pattern="\d{10}" 
                maxlength="10" 
                title="Please enter a valid 10-digit registration number" required>
       </div>

        
         <div class="mb-3">
              <label for="Name" class="form-label">Phone Number</label>
              <input type="text" name="phone" value="{{ old('phone') }}"  pattern="[0][1][3 7 6 5 8 9][0-9]{8}" title="
              Please select Valid mobile number" class="form-control" id="phone" placeholder="Enter your Phone Number" required>
         </div>

         <div class="mb-3">
             <label for="email" class="form-label">Email address</label>
             <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter your email" required>
         </div>

         <div class="mb-3">
            <label for="department" class="form-label">Hall Name</label>
               <select class="form-select" id="hall_id"  name="hall_id" required>
                  <option selected disabled>Select your Hall</option>
                      @foreach(hall() as $row)
                        <option value="{{ $row->id }}">
                           {{ $row->hall_name }}
                        </option>
                      @endforeach       
                 <!-- Add more options as needed -->
              </select>
        </div>


        <div class="mb-3">
            <label for="department" class="form-label"> Gender </label>
               <select class="form-select" id="gender"  name="gender" required>
                  <option selected disabled>Select Gender</option>
                  <option value="Male">Male</option>  
                  <option value="Female">Female</option>       
                 <!-- Add more options as needed -->
              </select>
        </div>

         <div class="mb-3">
               <label for="Name" class="form-label">Current Address</label>
               <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="name" placeholder="Enter your Current Address" required>
         </div>


         <div class="mb-3 password-container">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>  
         </div>

         <div class="mb-3 password-container">
             <label for="confirmPassword" class="form-label">Confirm Password</label>
             <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
         </div>

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

         <div class="d-flex justify-content-between">
              <a href="#" class="secondary-color">Forgot Password?</a>
         </div>

        <button type="submit" class="btn btn-primary mt-3" style="width:100%">Login</button>

    </form>
    <div class="footer-links mt-3">
        <p class="text-muted">Already Account? <a href="{{url('member/login')}}" class="secondary-color">Login</a></p>
    </div>
</div>




  
   


@endsection

