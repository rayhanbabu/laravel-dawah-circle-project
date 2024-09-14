<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ঢাকা বিশ্ববিদ্যালয় দাওয়াহ সার্কেল</title>
    <link rel="stylesheet" href="{{asset('frontend/css/style3.css')}}">
    
    <!-- Favicon -->
    <link href="{{asset('frontend/img/dawah.png')}}" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="{{asset('frontend/lib/animate/animate.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('dashboardfornt/css/dataTables.bootstrap5.min.css')}}">
    <link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend/css/bootstrap.min3.css')}}" rel="stylesheet" />


     <!-- JavaScript Libraries -->
     <script src="{{asset('dashboardfornt/js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('dashboardfornt/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dashboardfornt/js/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('dashboardfornt/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/frontend/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('/frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('dashboardfornt/js/sweetalert.min.js')}}"></script>

  

</head>
<body>
 
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg sticky-top px-0">
      <div class="container-xxl d-flex justify-content-between align-items-center">
        <!-- Logo on the left side -->
        <div class="logo">
            <a href="{{url('/')}}"> 
                <img src="{{asset('frontend/img/dawah.png')}}" width="300px" alt="logo">
            </a>
        </div>

        <!-- Toggle button for mobile view -->
        <button
          type="button"
          class="navbar-toggler"
          style="color:rgb(34, 10, 10);"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
        >
          <span class="navbar-toggler-icon"><img src="./frontend/img/icon.svg" alt="" style="width:30px;"></span>
        </button>

        <!-- Menu items on the right side -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ms-auto"> <!-- ms-auto will push items to the right -->
          
            


            <li class="nav-item  ">
                 <a href="{{url('/')}}" class="nav-link @yield('home')">Home</a>
            </li>

            @if(!member_info())
            <li class="nav-item">
                 <a href="{{url('/member/login')}}" class="nav-link @yield('login')">Login</a>
            </li>

            <li class="nav-item">
                 <a href="{{url('/member/register')}}" class="nav-link @yield('register')">Register</a>
            </li>
            @else
            <li class="nav-item">
                 <a href="{{url('/member/dashboard')}}" class="nav-link @yield('dashbaord')">Dashboard</a>
            </li>
            @endif

         @if(member_info() && member_info()['email'])
              <li class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                >Profile</a>
                <ul class="dropdown-menu">
                  <li><a href="#" class="dropdown-item"> {{ member_info()['name'] }} 
                  </a></li>
                  <li><a href="{{url('/book')}}" class="dropdown-item">Book Order</a></li>
                  <li><a href="{{url('member/book_order')}}" class="dropdown-item">My Order Books</a></li>
               
                  <li><a href="{{url('member/logout')}}" class="dropdown-item">Logout</a></li>
                 
                </ul>
              </li>
            <!-- Repeat similar structure for other dropdowns -->
           @endif

          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->


     <div>
           @yield('homecontent')
      </div>
 
    

    <!-- Footer Start -->
    <div
      class="container-fluid bg-dark text-light footer my-6 mb-0 py-6 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container">
        <div class="row g-5">
          <div class="col-lg-3 col-md-6">
            <h4 class="text-white mb-4">Get In Touch</h4>
            <h6 class="text-primary mb-4">
               ঢাকা বিশ্ববিদ্যালয় দাওয়াহ সার্কেল
            </h6>
            <p class="mb-2">
              <i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA
            </p>
            <p class="mb-2">
              <i class="fa fa-phone-alt me-3"></i>+012 345 67890
            </p>
            <p class="mb-2">
              <i class="fa fa-envelope me-3"></i>info@example.com
            </p>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-light mb-4">Quick Links</h4>
            <a class="btn btn-link" href="{{url('#')}}">About Us</a>
            <a class="btn btn-link" href="{{url('#')}}">Contact Us</a>
            <a class="btn btn-link" href="{{url('#')}}">Our Services</a>
            <a class="btn btn-link" href="{{url('#')}}">Terms & Condition</a>
            <a class="btn btn-link" href="{{url('#')}}">Support</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-light mb-4">Popular Links</h4>
            <a class="btn btn-link" href="{{url('#')}}">About Us</a>
            <a class="btn btn-link" href="{{url('#')}}">Contact Us</a>
            <a class="btn btn-link" href="{{url('#')}}">Our Services</a>
            <a class="btn btn-link" href="{{url('#')}}">Terms & Condition</a>
            <a class="btn btn-link" href="{{url('/login')}}">Staff Login</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-light mb-4">Newsletter</h4>
            <form action="">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control p-3 border-0"
                  placeholder="Your Email Address"
                />
                <button class="btn btn-primary">Sign Up</button>
              </div>
            </form>
            <h6 class="text-white mt-4 mb-3">Follow Us</h6>
            <div class="d-flex pt-2">
              <a class="btn btn-square btn-outline-light me-1" href=""
                ><i class="fab fa-twitter"></i
              ></a>
              <a class="btn btn-square btn-outline-light me-1" href=""
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a class="btn btn-square btn-outline-light me-1" href=""
                ><i class="fab fa-youtube"></i
              ></a>
              <a class="btn btn-square btn-outline-light me-0" href=""
                ><i class="fab fa-linkedin-in"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div
      class="container-fluid copyright text-light py-4 wow fadeIn"
      data-wow-delay="0.1s"
    >
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            &copy; <a href="#">ঢাকা বিশ্ববিদ্যালয় দাওয়াহ সার্কেল</a>, All Right Reserved.
          </div>
          <div class="col-md-6 text-center text-md-end">
            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
            Designed and Developed By <a href="https://ancova.com.bd">ANCOVA</a>
           
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    


   

  
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>
</html>
