@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('slider','active')
@section('content')

 <div class="card mt-2 mb-2 shadow-sm">
    <div class="card-header">
       <div class="row">
               <div class="col-8"> <h5 class="mt-0"> Slider @if(!$id) Add @else Edit @endif </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    

                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/slider/'.$product_id)}}" role="button"> Back </a>
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
  <form method="post" action="{{url('admin/slider/insert')}}"  class="myform"  enctype="multipart/form-data" >
  {!! csrf_field() !!}

     <input type="hidden" name="id"  value="{{$id}}" class="form-control" >

     <div class="row px-2">

   

          <div class="form-group col-sm-3 my-2">
               <label class=""><b> Title Name </b></label>
               <input type="text" name="title" class="form-control form-control-sm" value="{{$title}}" required>
          </div> 

          <input type="hidden" name="product_id"  value="{{$product_id}}" class="form-control" >
      
          <div class="form-group col-sm-3 my-2">
               <label class=""><b> Serial <span style="color:red;"> * </span></b></label>
               <input type="text" name="serial" class="form-control form-control-sm" value="{{$serial}}" required>
          </div> 

          <div class="form-group col-sm-3  my-2">
                <label class=""><b> Slider Status <span style="color:red;"> * </span> </b></label>
                 <select class="form-select form-select-sm" name="slider_status"  aria-label="Default select example">
                      <option value="1" {{ $slider_status == '1' ? 'selected' : '' }}> Active </option>
                      <option value="0" {{ $slider_status == '0' ? 'selected' : '' }}> Inactive </option>
                </select>
           </div> 

           <div class="form-group col-sm-3 my-2">
              <label class=""><b> Slider Image  <span style="color:red;"> * </span></b></label>
              <input type="file" name="image"  class="form-control form-control-sm" placeholder="" >
          </div>
            

       </div>
           <br>
        <input type="submit"   id="insert" value="Submit" class="btn btn-success" />
	  
              
     </div>

     </form>

  </div>
</div>



<script type="text/javascript">
    $(".js-example-disabled-results").select2();
</script>




   


@endsection