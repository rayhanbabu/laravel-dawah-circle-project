$(document).ready(function(){ 

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
    fetchAll();

   function fetchAll() {
     // Destroy existing DataTable if it exists
     if ($.fn.DataTable.isDataTable('.data-table')) {
         $('.data-table').DataTable().destroy();
     }

     // Initialize DataTable
     var table = $('.data-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
             url: "/member/book_order",
             error: function(xhr, error, code) {
                 console.log(xhr.responseText);
             }
         },
         columns: [
            {data:'book_id', name:'book_id'},
            {data:'title', name: 'title'},
            {data:'author_name', name: 'author_name'},
            {data:'category_name', name: 'category_name'},
            {data:'publisher_name', name: 'publisher_name'},
            {data:'status', name: 'status'},
            {data:'delete', name: 'delete', orderable: false, searchable: false},
         ]
       });
   }



      // delete employee ajax request
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var book_id = $(this).data('book_id'); 
        var book_status = $(this).data('book_status'); 
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to request this book!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Request it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url:'/member/book_request',
              method:'post',
              data: {
                 book_id: book_id,
                 book_status: book_status,
              },
               success: function(response){
                  console.log(response);
                 if(response.status == 'fail'){
                    Swal.fire("Warning",response.message, "warning");
                 }else if(response.status == 'success')
                    Swal.fire("Successfull",response.message, "success");
                   fetchAll();
              }
            });
          }
        })
      });


});