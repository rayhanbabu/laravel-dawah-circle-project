@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('login','active')
@section('homecontent')


<div class="login-container">
        <h3 class="text-center login-header">Login</h3>
          <form method="POST" action="{{ url('member/login_insert') }}">
        @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <div class="mb-3 password-container">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                <!-- Bootstrap Icon for password toggle -->
                <i class="bi bi-eye toggle-password mt-3" id="togglePassword"></i>
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
                <a href="{{url('member/forget_password')}}" class="secondary-color">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-primary mt-3 " style="width:100%">Login</button>
        </form>
        <div class="footer-links mt-3">
            <p class="text-muted">New User? <a href="{{url('member/register')}}" class="secondary-color">Create an account</a></p>
        </div>
    </div>

   
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            // Toggle the eye icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>



  
   


@endsection

