@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('book','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
   <div class="card-header">
       <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> Book @if(!$id) Add @else Edit @endif </h5></div>
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
  <form method="post" action="{{url('admin/book/insert')}}"  class="myform"  enctype="multipart/form-data" >
  {!! csrf_field() !!}

     <input type="hidden" name="id"  value="{{$id}}" class="form-control" >

     <div class="row px-2">

     <div class="form-group col-sm-6 my-2">
               <label class=""><b> Category Name <span style="color:red;"> * </span></b></label><br>
                 <select class="js-example-basic-multiple form-control" name="category_id[]" id="category_id" multiple="multiple" required>                       
                @foreach($category as $row)
                  <option value="{{ $row->id }}" 
                  @foreach($mul_category as $row1){{ $row1->category_id==$row->id ? 'selected': ''}}   @endforeach    > {{ $row->category_name }}
                  </option>
                @endforeach  

           </select>
           </div> 


           <div class="form-group col-sm-6 my-2">
                 <label class="">  <b> Author Name  <span style="color:red;"> * </span>  </b>  </label><br>
                 <select class="js-example-basic-multiple form-control" name="author_id[]" id="author_id" multiple="multiple" required>                       
                 @foreach($author as $row)
                   <option value="{{ $row->id }}" 
                    @foreach($mul_author as $row1){{ $row1->author_id==$row->id ? 'selected': ''}}   @endforeach > {{ $row->author_name }}
                   </option>
                @endforeach  

           </select>
           </div> 
          

         


           <div class="form-group col-sm-3 my-2">
               <label class=""><b> Publisher Name <span style="color:red;"> * </span></b></label><br>
                 <select name="publisher_id" id="publisher_id"  class="form-control js-example-disabled-results" style="max-width:300px;" required>
                  <option value="">Select Publisher </option>
                     @foreach($publisher as $row)
                       <option value="{{ $row->id }}" {{ $row->id == $publisher_id ? 'selected' : '' }}>
                            {{ $row->publisher_name }}
                       </option>
                     @endforeach
                 </select>
           </div> 


           @if(Auth::user()->userType=='Admin')
           <div class="form-group col-sm-3 my-2">
               <label class=""><b> User Name <span style="color:red;"> * </span></b></label><br>
                 <select name="user_id" id="user_id"  class="form-control js-example-disabled-results" style="max-width:300px;" required>
                  <option value="">Select User </option>
                     @foreach($user as $row)
                       <option value="{{ $row->id }}" {{ $row->id == $user_id ? 'selected' : '' }}>
                            {{ $row->name }}  ({{ $row->userType }})
                       </option>
                     @endforeach
                 </select>
           </div> 
       @else
             <input type="hidden" name="user_id"  value="{{Auth::user()->id}}" class="form-control" >
      @endif


          <div class="form-group col-sm-4 my-2">
               <label class=""><b> Book Name <span style="color:red;"> * </span></b></label>
               <input type="text" name="title" class="form-control form-control-sm" value="{{$title}}" required>
          </div> 


          <div class="form-group col-sm-2 my-2">
               <label class=""><b> Book Page <span style="color:red;"> * </span></b></label>
               <input type="number" name="page" class="form-control form-control-sm" value="{{$page}}" required>
          </div> 


          <div class="form-group col-sm-2  my-2">
                <label class=""><b>Book Status <span style="color:red;"> * </span> </b></label>
                 <select class="form-select form-select-sm" name="book_status"  aria-label="Default select example">
                      <option value="1" {{ $book_status == '1' ? 'selected' : '' }}> Active </option>
                      <option value="0" {{ $book_status == '0' ? 'selected' : '' }}> Inactive </option>
                </select>
           </div> 

           <div class="form-group col-sm-2 my-2">
              <label class=""><b> book Image (Max 800KB)</b></label>
              <input type="file" name="image"  class="form-control form-control-sm" placeholder="" >
          </div>
            

          <div class="form-group col-sm-2  my-2">
                <label class=""><b>Book Language <span style="color:red;"> * </span> </b></label>
                 <select class="form-select form-select-sm" name="lang"  aria-label="Default select example" required>
                      <option value="Bangla" {{ $lang == 'Bangla' ? 'selected' : '' }}> Bangla </option>
                      <option value="English" {{ $lang == 'English' ? 'selected' : '' }}> English </option>
                      <option value="Arabic" {{ $lang == 'Arabic' ? 'selected' : '' }}> Arabic </option>
                 </select>
           </div> 
          


          <div class="form-group col-sm-12 my-2">
              <label class=""><b> Description  <span style="color:red;"> * </span></b></label>
              <textarea name="desc" id="summernote" cols="30" rows="10" > {{$desc}}  </textarea >

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
    $('.js-example-basic-multiple').select2();
   
    $('#summernote').summernote({
placeholder: 'Description...',
tabsize: 2,
height: 60
});
</script>




   


@endsection