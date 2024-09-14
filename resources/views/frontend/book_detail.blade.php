@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('login','active')
@section('homecontent')




 <!-- About Start -->
 <div class="container-xxl py-2">
      <div class="container">
          <div class="row  g-5 shadow">
              <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                   <div class="text-center"> 
                     <div class="ps-5 pt-2 h-100">
                      <img class="img-fluid"   src="{{ !empty($book->image) ? asset('uploads/admin/' . $book->image) : asset('/frontend/img/bookicon.png') }}" 
                         style="height: 220px; width: auto; transition: transform 0.3s ease, filter 0.3s ease;"  alt="">
                        <div> Page No : {{$book->page}} </div>
                        <div> Language : {{$book->lang}} </div>
                     </div>
                  </div>

              </div>
              <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.5s">
                  <div class="h-100">
                      <br><br>
                      <h4 class="display-8"> {{$book->title}}</h4>
                      <h6 class="display-10">
                        Author: {{ author_id_detail($book->author_id)}}
                      </h6>
                     
             
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Book Id</th>
                <th scope="col">Location</th>
                <th scope="col">Book Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        @foreach($book_detail as $row)
            <tr>
                <th scope="row"> {{$row->book_id}} </th>
                <td> {{$row->hall_name}} </td>
                <td>
            @if($row->book_status == 1)
                <span class="text-success">Available</span>
            @elseif($row->book_status == 2)
                <span class="text-danger">Booked</span>
            @elseif($row->book_status == 3)
                <span class="text-warning">Requested</span>
            @else
                <span class="text-secondary">Unknown Status</span>
            @endif
        </td>

        <td>
        @if($row->book_status == 1)
          
             <a href="javascript:void(0);"  
                data-book_status="{{ $row->book_status }}" 
                data-book_id="{{ $row->book_id }}" 
                 class="delete btn btn-primary btn-sm">Request Now</a>
       
        @endif
        </td>

            </tr>
       @endforeach

          

        </tbody>
    </table>
                   
                    
                  </div>
              </div>

           
               <div class="row p-5"> 
                     
               </div>

          </div>

                   

      </div>
  </div>
  <!-- About End -->


  <script src="{{ asset('js/book_order.js') }}"></script>


@endsection

