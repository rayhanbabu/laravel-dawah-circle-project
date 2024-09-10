@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('publisher','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
   <div class="card-header">
       <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Publisher @if(!$id) Add @else Edit @endif </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                          
                         </div>
                     </div>

                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/publisher')}}" role="button"> Back </a>
                         </div>
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

  </div>

  <div class="card-body">    
  <form method="post" action="{{url('admin/publisher/insert')}}"  class="myform"  enctype="multipart/form-data" >
  {!! csrf_field() !!}

     <input type="hidden" name="id"  value="{{$id}}" class="form-control" >

     <div class="row px-2">

          <div class="form-group col-sm-6 my-2">
               <label class=""><b>Publisher Name <span style="color:red;"> * </span></b></label>
               <input type="text" name="publisher_name" class="form-control" value="{{$publisher_name}}" required>
          </div> 

        
         
            
            <div class="form-group col-sm-6  my-2">
                <label class=""><b>Publisher Status </b></label>
                 <select class="form-select" name="publisher_status"  aria-label="Default select example">
                      <option value="1" {{ $publisher_status == '1' ? 'selected' : '' }}> Active </option>
                      <option value="0" {{ $publisher_status == '0' ? 'selected' : '' }}> Inactive </option>
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