@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('login','active')
@section('homecontent')


<div class="custom-container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      
      <!-- Card 1 -->
      <div class="col">
        <div class="custom-card">
          <h5 class="custom-card-title">Total Book</h5>
          <p class="custom-counter">123</p>
          <a href="{{url('member/book_order')}}" class="custom-card-link">Book Order</a>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col">
        <div class="custom-card">
          <h5 class="custom-card-title">My Book Order</h5>
          <p class="custom-counter">456</p>
          <a href="#" class="custom-card-link"> Details History </a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col">
        <div class="custom-card">
          <h5 class="custom-card-title">Requested Book</h5>
          <p class="custom-counter">789</p>
          <a href="#" class="custom-card-link"> Details History</a>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col">
        <div class="custom-card">
          <h5 class="custom-card-title"> Return Book </h5>
          <p class="custom-counter">101</p>
          <a href="#" class="custom-card-link">Details History</a>
        </div>
      </div>

    </div>
  </div>

@endsection
