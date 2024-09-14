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
             {data:'hall_name', name: 'hall_name'},
             {data:'phone', name: 'phone'},
             {data:'request_time', name: 'request_time'},
             {data:'issue_time', name: 'issue_time'},
             {data:'return_time', name: 'return_time'},
             {data:'return_day', name: 'return_day'},
             {data:'status', name: 'status'},
          ]
        });
    }
    
      // delete employee ajax request
      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var book_id = $(this).data('book_id'); 
        var book_status = $(this).data('book_status'); 


        (async () => {
          const { value: return_day } = await Swal.fire({
                 input:'number',
                 inputLabel:'Enter the approximate return day since the book was issued.',
                 inputPlaceholder:'Return Day Maximum 21 day',
                 inputAttributes: {
                  min: 1,
                  max: 21
                }
               })
         if (return_day) {
             $.ajax({
                  url:'/member/book_request',
                  method: 'post',
                  data: {
                    book_id: book_id,
                    return_day: return_day,
                    book_status: book_status,
                  },
                 success: function(response) {
                  console.log(response);
                 if(response.status == 'fail'){
                    Swal.fire("Warning",response.message, "warning");
                 }else if(response.status == 'success')
                    Swal.fire("Successfull",response.message, "success");
  
                  }
                });
  
              }
          })();
  

      });


});