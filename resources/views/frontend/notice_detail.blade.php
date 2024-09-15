@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('login','active')
@section('homecontent')


 @if($notice->event_id==2)
       
 <div class="container mt-5">
        <div class="card">
      
            <div class="card-body">
                <h3 class="card-title"> {{$notice->title}} </h3>
           
                <p class="card-text">
                   {!!$notice->desc!!}
                </p>
               
            </div>
        </div>
    </div>

 @else


 <div class="container mt-5">
        <div class="card">
        <img src="{{ asset('uploads/admin/'.$notice->image) }}" class="card-img-top" alt="Notice Image" style="height: 400px;">
            <div class="card-body">
                <h3 class="card-title"> {{$notice->title}} </h3>
                <p class="text-muted">Date: {{$notice->date}}</p>
                <p class="card-text">
                   {!!$notice->desc!!}
                </p>
                <a href="{{url('/')}}" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    </div>

  @endif


  
   


@endsection

