@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('home','active')
@section('homecontent')



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
             <a href="{{ !empty($item->link) ? url($item->link) : url('notice_detail/'.$item->id) }}" class="btn btn-outline-primary btn-details">বিস্তারিত</a>
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

