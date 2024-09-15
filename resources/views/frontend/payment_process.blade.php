@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('payment_process','active')
@section('homecontent')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 card-container">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5 class="card-title">Payment Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{$data['name']}}</p>
                    <p><strong>Email:</strong> {{$data['email']}}</p>
                    <p><strong>Phone:</strong> {{$data['phone']}}</p>
                    <p><strong>Address:</strong> {{$data['address']}}</p>
                    <p><strong>Payment Amount:</strong> {{$data['total_amount']}} BD</p>
                    <a href="{{url('https://amaderthikana.com/nonmember_epay/dudcircle/'.$data['tran_id'])}}" class="btn btn-primary">Proceed to Payment</a>
                </div>
            </div>
        </div>
    </div>
</div>
  
   


@endsection

