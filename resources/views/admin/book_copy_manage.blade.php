@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('book','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
   <div class="card-header">
       <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> book Copy </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    

                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/book')}}" role="button"> Back </a>
                         </div>
                     </div> 
         </div>

       @if($errors->any())
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

  </div>

  <div class="card-body">    
  <form method="post" action="{{url('admin/book_copy/insert')}}"  class="myform"  enctype="multipart/form-data" >
  {!! csrf_field() !!}

     <input type="hidden" name="id"  value="{{$book->id}}" class="form-control" >

    

     <div class="row px-2">


          <div class="form-group col-sm-6 my-2">
               <label class=""><b> Book Name <span style="color:red;"> * </span></b></label>
               <input type="text" name="title" class="form-control form-control-sm" value="{{$book->title}}" readonly>
          </div> 


        

          <div class="form-group col-sm-2  my-2">
                <label class=""><b>Book Status <span style="color:red;"> * </span> </b></label>
                 <select class="form-select form-select-sm" name="book_status"  aria-label="Default select example">
                      <option value="1" {{ $book->book_status == '1' ? 'selected' : '' }}> Active </option>
                      <option value="0" {{ $book->book_status == '0' ? 'selected' : '' }}> Inactive </option>
                </select>
           </div> 


           <div class="form-group col-sm-3 my-2">
               <label class=""><b> User Name <span style="color:red;"> * </span></b></label><br>
                 <select name="user_id" id="user_id"  class="form-control js-example-disabled-results" style="max-width:300px;" required>
                  <option value="">Select User </option>
                     @foreach($user as $row)
                       <option value="{{ $row->id }}" {{ $row->id == $book->user_id ? 'selected' : '' }}>
                            {{ $row->name }}
                       </option>
                     @endforeach
                 </select>
           </div> 

      
       </div>
           <br>
        <input type="submit"   id="insert" value="Submit" class="btn btn-success" />
	  
              
     </div>

     </form>

  </div>
</div>







   


@endsection