@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('login','active')
@section('homecontent')




 <!-- About Start -->
 <div class="container-xxl py-2">
      <div class="container ">
          <div class="row  g-5 shadow">
              <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                   <div class="text-center"> 
                     <div class="ps-5 pt-2 h-100">
                      <img class="img-fluid"   src="{{ !empty($book->max('image')) ? asset('uploads/admin/' . $book->max('image')) : asset('/frontend/img/bookicon.png') }}" 
                         style="height: 220px; width: auto; transition: transform 0.3s ease, filter 0.3s ease;"  alt="">
                         <br> <br>
                         <div> Page No : {{$book->max('page')}} </div>
                        <div> Language : {{$book->max('lang')}} </div>
                     </div>
                  </div>

              </div>
              <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.5s">
                  <div class="h-100">
                     <br><br>
                 <div class="row"> 
                            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                               <h4 class="display-8"> {{$book->max('title')}}</h4>
                                <h6 class="display-8">
                                   @foreach( author_detail($book->max('book_id')) as $row ) 
                                     <li>{{$row->author_name}} </li>
                                   @endforeach
                                </h6>
                             </div>

                 <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                      <form action="{{ url('/book_detail/'.$book->max('book_code')) }}" method="GET" class="mb-4">
                     <div class="input-group">
                            <select class="form-select" id="hall_id"  name="hall_id" required>
                                <option selected disabled> Select the Book Received Hall </option>
                                  @foreach($book as $row)
                                 <option value="{{ $row->hall_id }}" {{ $row->hall_id == $hall_id ? 'selected' : '' }}>
                                   {{ $row->hall_name }}
                                 </option>
                               @endforeach       
                              <!-- Add more options as needed -->
                              </select>
                           <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                     </form>         
                  </div>  

            </div>
                   
                      
                     
             
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
        @if($book_detail->isEmpty())
             <tr >
                 <td colspan="4"> 
                   <p class="text-center"> Select the Book Received Hall</p>
                 </td>
                 
             </tr>
       @else

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
       @endif
          

        </tbody>
    </table>
                   
                    
                  </div>
              </div>

           
               <div class="row p-5"> 
                       {!! $book->min('book_desc') !!}
               </div>

          </div>

                   

      </div>
  </div>
  <!-- About End -->


  <script src="{{ asset('js/book_order.js') }}"></script>


@endsection

