@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('slider','active')
@section('content')

 <div class="card mt-2 mb-2 shadow-sm">
    <div class="card-header">
       <div class="row">
               <div class="col-8"> <h5 class="mt-0"> {{event_id_detail($event_id)->event_name }} @if(!$id) Add @else Edit @endif </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    

                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/notice/'.$event_id)}}" role="button"> Back </a>
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
  <form method="post" action="{{url('admin/notice/insert')}}"  class="myform"  enctype="multipart/form-data" >
  {!! csrf_field() !!}

     <input type="hidden" name="id"  value="{{$id}}" class="form-control" >

     <div class="row px-2">

   

          <div class="form-group col-sm-3 my-2">
               <label class=""><b> Date <span style="color:red;"> * </span> </b></label>
               <input type="date" name="date" class="form-control form-control-sm" value="{{$date}}" required>
          </div> 

          <input type="hidden" name="event_id"  value="{{$event_id}}" class="form-control" >
      
          <div class="form-group col-sm-3 my-2">
               <label class=""><b> Serial <span style="color:red;"> * </span></b></label>
               <input type="number" name="serial" class="form-control form-control-sm" value="{{$serial}}" required>
          </div> 

          <div class="form-group col-sm-3  my-2">
                <label class=""><b> Notice Status <span style="color:red;"> * </span> </b></label>
                 <select class="form-select form-select-sm" name="notice_status"  aria-label="Default select example">
                      <option value="1" {{ $notice_status == '1' ? 'selected' : '' }}> Active </option>
                      <option value="0" {{ $notice_status == '0' ? 'selected' : '' }}> Inactive </option>
                </select>
           </div> 

           <div class="form-group col-sm-3 my-2">
              <label class=""><b>  Image  (Max:600KB)</b></label>
              <input type="file" name="image"  class="form-control form-control-sm" placeholder="" >
          </div>

          <div class="form-group col-sm-6 my-2">
               <label class=""><b> Title Name <span style="color:red;"> * </span></b></label>
               <input type="text" name="title" class="form-control form-control-sm" value="{{$title}}" required>
          </div> 


          <div class="form-group col-sm-6 my-2">
               <label class=""><b> Link </b></label>
               <input type="text" name="link" class="form-control form-control-sm" value="{{$link}}" >
          </div> 


          <div class="form-group col-sm-12 my-2">
                <label class=""><b> Short  Description  </b></label>
                 <textarea name="text"class="form-control form-control-sm"  cols="10" rows="3" > {{$text}}  </textarea >
         </div>

          <div class="form-group col-sm-12 my-2">
              <label class=""><b>  Description  <span style="color:red;"> * </span></b></label>
              <textarea name="desc" id="summernote" cols="30" rows="10" required > {{$desc}}  </textarea >
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

    $('#summernote').summernote({
       placeholder: 'Description...',
       tabsize: 2,
       height: 60
     });

</script>




   


@endsection