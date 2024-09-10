@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('book','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
  <div class="card-header">
  <div class="row ">
               <div class="col-8"> <h5 class="mt-0"> book   </h5></div>
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                             
                                     
                         </div>
                     </div>

                    
                     <div class="col-2">
                         <div class="d-grid gap-2 d-md-flex ">
                           <a class="btn btn-primary btn-sm" href="{{url('admin/book/manage')}}" role="button"> Add </a>
                         </div>
                     </div> 
         </div>
           
         @if(Session::has('fail'))
             <div  class="alert alert-danger"> {{Session::get('fail')}}</div>
         @endif
                        
        @if(Session::has('success'))
              <div  class="alert alert-success"> {{Session::get('success')}}</div>
            @endif


      </div>
  <div class="card-body">   

   <div class="row">
         <div class="col-md-12">
           <div class="table-responsive">
                <table class="table  table-bordered data-table">
                   <thead>
                     <tr>
                         <td> Book id </td>
                         <td> Image </td>
                         <td> Categeory </td>
                         <td> Author </td>
                         <td> Publisher </td>
                         <td> Book Name </td>
                         <td> Book Assign </td>
                         <td> Book Copy</td>
                         <td> Book Status</td>
                         <td> Edit </td>
                         <td> Delete </td>
                      </tr>
                   </thead>
                   <tbody>

                   </tbody>

                </table>
          </div>
       </div>
    </div>


  </div>
</div>




<script>
       $(function() {
   var table = $('.data-table').DataTable({
       processing: true,
       serverSide: true,
       ajax: {
           url: "{{ url('/admin/book') }}",
           error: function(xhr, error, code) {
               console.log(xhr.responsediagnostic);
           }
       },
       columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'category_name', name: 'category_name'},
            {data: 'author_name', name: 'author_name'},
            {data: 'publisher_name', name: 'publisher_name'},
            {data: 'title', name: 'title'},
            {data: 'name', name: 'name'},
            {data: 'book_copy', name: 'book_copy'},
            {data: 'status', name: 'status'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false},
       ]
   });
});

   </script>


      



   


@endsection