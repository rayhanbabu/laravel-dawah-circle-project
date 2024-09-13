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
                url: "/admin/issue",
                error: function(xhr, error, code) {
                    console.log(xhr.responseText);
                }
            },
            columns: [
                { data: 'member_name', name: 'member_name' },
                { data: 'phone', name: 'phone' },
                { data: 'title', name: 'title' },
                { data: 'author_name', name: 'author_name' },
                { data: 'request_time', name: 'request_time' },
                { data: 'issue_time', name: 'issue_time' },
                { data: 'return_time', name: 'return_time' },
                { data: 'status', name: 'status' },
                { data: 'edit', name: 'edit', orderable: false, searchable: false },
                { data: 'user_name', name: 'user_name' },
            ]
        });
    }
     

        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var view_id = $(this).data('id'); 
            $('#EditModal').modal('show');
               // console.log(view_id);         
            $.ajax({
              type: 'GET',
              url: '/admin/issue_view/' + view_id,
              success: function(response) {
                //console.log(response);
                if (response.status == 404) {
                  $('#success_message').html("");
                  $('#success_message').addClass('alert alert-danger');
                  $('#success_message').text(response.message);
                } else {
                  $('#edit_id').val(response.value.id);
                  $('#edit_issue_status').val(response.value.issue_status);
              
                }
              }
            });


          });

   
      // update employee ajax request
    $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
  
        const fd = new FormData(this);
  
        $.ajax({
          type: 'POST',
          url: '/admin/issue/update',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          beforeSend: function() {
            $('.loader').show();
            $("#edit_employee_btn").prop('disabled', true);
          },
          success: function(response) {
            $("#edit_employee_btn").prop('disabled', false);
            if (response.status == 200) {
                $('#success_message').html();
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
                $("#EditModal").modal('hide');
                $("#edit_employee_form")[0].reset();
                fetchAll();
            } else if (response.status == 400) {
                 $('.edit_error_registration').text(response.message.registration);
                 $('.edit_error_phone').text(response.message.phone);
                 $('.edit_error_email').text(response.message.email);
                 $('.edit_error_member_name').text(response.message.member_name);
            }
  
               $('.loader').hide();
            }
  
          });
  
        });
  
           
});