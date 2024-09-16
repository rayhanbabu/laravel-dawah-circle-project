@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('home','active')
@section('homecontent')



  <div class="container mt-5 shadow p-4 rounded">
    <h5 style="margin:0" class="mb-4 text-center">ঢাবি সীরাত মাহফিল ও পুরস্কার বিতরণী-২০২৪</h5>

    <p class="text-center"> <b>  স্থান: টিএসসি, ঢাকা বিশ্ববিদ্যালয়
             তারিখঃ ২১ সেপ্টেম্বর,
             ব্যাপ্তিঃ সারাদিন ব্যাপি   </b> </p>
    <p>  TSC অডিটরিয়ামে সিটের জন্য রেজিস্ট্রেশন ফী ১০০ টাকা।  অডিটোরিয়ামের সিট পূর্ণ হয়ে গেলে এ অপশনটি সয়ংক্রিয়ভাবে বন্ধ হয়ে যাবে।

বাকিদের ফ্রি রেজিস্ট্রেশন আবশ্যক। তাদের জন্য টিএসসি মাঠ ও গেমসরুমে ব্যবস্থা করা হয়েছে ।
 
রেজিস্ট্রেশন সম্পন্ন হলে ইমেইলের মাধ্যমে আপনাকে কনফার্ম করা হবে। প্রোগামের দিন টিএসসিতে প্রবেশের সময় ঢাবি আইডি কার্ড অথবা শিক্ষার্থী পরিসেবা আইডির সফট/হার্ডকপি দেখিয়ে প্রবেশ করতে হবে।
</p>
    <form method="POST" action="{{ url('event/event_registration') }}">
    @csrf
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Enter your name" required>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="registration" class="form-label"> Du Registration Number</label>
                <input type="text" class="form-control" value="{{ old('registration') }}" id="registration" name="registration"
                 placeholder="Enter registration number"
                 pattern="\d{10}" 
                 maxlength="10" 
                 title="Please enter a valid 10-digit registration number"
                 required />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" name="phone" value="{{ old('phone') }}"  maxlength="11"  pattern="[0][1][3 7 6 5 8 9][0-9]{8}" title="
                Please select Valid mobile number" class="form-control" id="phone" placeholder="Enter your phone number" required>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-6 mb-3">
    <label for="department" class="form-label">Department Name</label>
    <select class="form-select" id="department" name="department" required>
        <option value="" {{ old('department') == '' ? 'selected' : '' }}>Select Department</option>
        @foreach(department() as $row)
            <option value="{{ $row->department_name }}" {{ old('department') == $row->department_name ? 'selected' : '' }}>
                {{ $row->department_name }}
            </option>
        @endforeach
    </select>
    </div>

           <div class="col-sm-6 mb-3">
    <label for="address" class="form-label">Hall Name</label>
    <select class="form-select" id="address" name="address" required>
        <option value="" {{ old('address') == '' ? 'selected' : '' }}>Select Hall</option>
        @foreach(hall() as $row)
            <option value="{{ $row->hall_name }}" {{ old('address') == $row->hall_name ? 'selected' : '' }}>
                {{ $row->hall_name }}
            </option>
        @endforeach
    </select>
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
                <label for="session" class="form-label">Current Year</label>
                <select class="form-select" id="passing_year" name="passing_year" required>
                      <option value="" {{ old('passing_year') == '' ? 'selected' : '' }}>Select Current Year</option>
                      <option value="1st Year" {{ old('passing_year') == '' ? 'selected' : '' }}> 1st Year </option>
                      <option value="2nd Year" {{ old('passing_year') == '' ? 'selected' : '' }}> 2nd Year </option>
                      <option value="3rd Year" {{ old('passing_year') == '' ? 'selected' : '' }}> 3rd Year </option>
                      <option value="4th Year" {{ old('passing_year') == '' ? 'selected' : '' }}> 4th Year </option>
                      <option value="MS" {{ old('passing_year') == '' ? 'selected' : '' }}> MS </option>
                      <option value="Honors Pass" {{ old('passing_year') == '' ? 'selected' : '' }}> Honors Pass </option>
                      <option value="Masters Pass " {{ old('passing_year') == '' ? 'selected' : '' }}> Masters Pass  </option>
                    </select>
        </div>
   </div>



   <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="gender" class="form-label">Resident</label>
                   <select class="form-select" id="resident" name="resident" required>
                      <option value="" {{ old('resident') == '' ? 'selected' : '' }}>Select Resident</option>
                      <option value="Yes" {{ old('resident') == 'Yes' ? 'selected' : '' }}>Yes</option>
                      <option value="No" {{ old('resident') == 'No' ? 'selected' : '' }}>No</option>
                  </select>
            </div>

            <div class="col-sm-6 mb-3">
                <label for="session" class="form-label">Registration Type</label>
                <select class="form-select" id="registration_type" name="registration_type" required>
                      <option value="" {{ old('registration_type') == '' ? 'selected' : '' }}>Select Registration Type</option>
                      <option value="Free" {{ old('registration_type') == '' ? 'selected' : '' }}> টিএসসি মাঠ ও গেমসরুমে রেজিস্ট্রেশন ফ্রি  </option>
                      <option value="Paid" {{ old('registration_type') == '' ? 'selected' : '' }}> টিএসসি অডিটরিয়ামে সিটের জন্য রেজিস্ট্রেশন ফী ১০০ টাকা </option>
                    
                    </select>
        </div>
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



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
  

<br><br>

    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" style="height: 500px;">

          @php
               $index = 0; // Initialize counter
          @endphp

          @foreach($slider as $row)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
              <img class="w-100" src="{{asset('uploads/admin/'.$row->image)}}" alt="Image" />
              <div class="carousel-caption">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-lg-7">
                      <a href="{{url($row->link)}}" class="btn btn-primary py-sm-3 px-sm-5"
                        > বিস্তারিত </a
                      >
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
         
          @php
             $index++; // Increment counter
         @endphp

       @endforeach

           


          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#header-carousel"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#header-carousel"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <!-- Carousel End -->



      <div class="container mt-0">
    <div class="row">
        <!-- Column 1 -->

        @foreach($values as $item)
            <div class="col-md-4 icon-box">
                <i class="bi bi-check-circle"> </i>
                <h5>{{$item->title}}</h5>
                <p> {!!$item->text !!} </p>
           </div>
        @endforeach
        
    </div>
</div>






      @if($notice->isNotEmpty())
           <!-- Notice Start -->
   <div class="container courses my-2 py-1 pb-0 ">
   <div class="container">
     <div class="text-center mx-auto mb-2 wow fadeInUp" data-wow-delay="0.1s">
      
       <h1 class="display-6 mb-4">
          নোটিশ সমূহ
       </h1>
    </div>
    <div class="row g-4 justify-content-center p-2">
         <!-- Owl Carousel Wrapper -->
       <div class="owl-carousel courses-carousel">

       @foreach($notice as $item)
        <!-- Course Item 1 -->
        <div class="courses-item d-flex flex-column bg-white overflow-hidden shadow">
          <div class="position-relative mt-auto">
             <div class="text-center">
                <img class="img-fluid mx-auto d-block" src="{{ asset('uploads/admin/'.$item->image) }}" alt="" style="height: 270px; width: auto;" />
            </div>
            <div class="courses-overlay">
              <a class="btn btn-outline-primary border-2" href="{{url('notice_detail/'.$item->id)}}">Read More</a>
            </div>
          </div>
          <div class="text-center py-4 pt-3">
            <p> {{$item->title}} </p>
          </div>
        </div>
        @endforeach
       
        <!-- Repeat for more items as needed -->
      </div>
    </div>
  </div>
</div>
<!-- Notice End -->
@endif


            





      <div class="container service-page">
        <div class="section-title">
          <h1> কার্যক্রম সমূহ </h1>
        
        </div>
    
        <div class="row">
          <!-- Outdoor Service Card -->

          @foreach($service as $item)
    <div class="col-md-4 p-2">
        <div class="service-card">
            <h3>{{ $item->title }}</h3>
            <p>{{ $item->text }}</p>
            <!-- <a href="{{ !empty($item->link) ? url($item->link) : url('#') }}" class="btn btn-outline-primary btn-details">বিস্তারিত</a> -->
             <a href="{{url('notice_detail/'.$item->id)}}" class="btn btn-outline-primary btn-details">বিস্তারিত</a>
          </div>
       </div>
   @endforeach
        

        <!-- Repeat for more items as needed -->
      </div>
    </div>
  </div>
</div>
<!-- Courses End -->



 

  @if($testimonial->isNotEmpty())
     <!-- Testimonial Start -->
     <div class="container-xxl py-2">
      <div class="container">
        <div
          class="text-center mx-auto mb-5 wow fadeInUp"
          data-wow-delay="0.1s"
        >
          <h1 class="display-6 mb-4"> ঢাকা বিশ্ববিদ্যালয় দাওয়াহ সার্কেল  সম্পর্কে  </h1>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8  wow fadeInUp " data-wow-delay="0.1s">
            <div class="owl-carousel testimonial-carousel">


         @foreach($testimonial as $item)
              <div class="testimonial-item text-center">
                <div class="position-relative mb-5">
                  <img
                  class="img-fluid rounded-circle mx-auto"
                  src="{{ asset('uploads/admin/'.$item->image) }}"
                  alt=""
                  style="width: 100px; height: 100px;"
                />
                  <div
                    class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle"
                    style="width: 60px; height: 60px"
                  >
                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                  </div>
                </div>
                <p class="fs-4">
                   {{$item->text}}
                </p>
                <hr class="w-25 mx-auto" />
                <h5>{!!$item->title!!}</h5>
               
              </div>
         @endforeach



            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Testimonial End -->
    @endif

  
   


@endsection

