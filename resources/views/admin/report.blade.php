@extends('layouts/dashboardheader')
@section('page_title','Admin Dashboard')
@section('report','active')
@section('content')

<div class="card mt-2 mb-2 shadow-sm">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h5 class="mt-0">Book Report</h5>
            </div>
            <div class="col-2">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <!-- Add content here if needed -->
                </div>
            </div>
            <div class="col-2">
                <div class="d-grid gap-2 d-md-flex">
                 
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <!-- Search by phone number -->
            <div class="col-md-4">
                <input type="text" id="phone_search" class="form-control" placeholder="Search by phone number">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" onclick="searchByPhone()">Search</button>
            </div>
        </div>

        <div class="row">
            <div id="success_message"></div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                               <td>Issue Id</td>
                                <td>Name</td>
                                <td>Phone</td>
                                <td>Book Id</td>
                                <td>Book Name</td>
                                <td>Requested Time</td>
                                <td>Issue Time</td>
                                <td>Return Time</td>
                                <td>Status</td>                           
                                <td>Probably Return Day</td>
                                <td>Comment</td>
                                <td>Staff Name</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic content will be injected here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

function searchByPhone() {
    const phoneNumber = document.getElementById('phone_search').value;
    
    if (phoneNumber) {
        // If you are using AJAX to fetch data dynamically
        $.ajax({
            url: '/admin/book/search', // The route for searching based on phone number
            method: 'GET',
            data: { phone: phoneNumber },
            success: function(response) {
                // Clear the current table
                $('.data-table tbody').empty();

                // Inject new rows dynamically (assuming response contains the book details)
                $.each(response, function(index, row) {
                    $('.data-table tbody').append(`
                        <tr>
                           <td>${row.id}</td>
                            <td>${row.member_name}</td>
                            <td>${row.phone}</td>
                            <td>${row.book_id}</td>
                            <td>${row.title}</td>
                            <td>${row.request_time}</td>
                            <td>${row.issue_time}</td>
                            <td>${row.return_time}</td>
                           <td>${row.issue_status == 1 ? 'Issue' : row.issue_status == 3 ? 'Requested' : 'Return'} </td> 
                           
                            <td>${row.return_day}</td>
                            <td>${row.comment}</td>
                            <td>${row.user_name}</td>
                        </tr>
                    `);
                });
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    } else {
        alert('Please enter a phone number to search.');
    }
}

</script>


@endsection