@extends('admin.layout.dashboard')

@section('page-heading')
    Customers Data
@endsection

@section('content')
    @include('admin.layout.flashmessages')
    <div class="container">
        <div class="text-right">
            <a href="{{url('/api/addCustomer')}}"><button  class="btn btn-info">Create Customer</button></a>
        </div>
        <table class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>PhoneNumber</th>
                <th>Status</th>
                <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">

                    <form id="customerEditForm" name="customerEditForm" method="POST" class="form-horizontal">
                        @csrf
                        <div id="validation-errors"></div>
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"  maxlength="50" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email"value="email" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phonenumber" class="col-sm-2 control-label">phone Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="phonenumber" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-12">
                                <select name="status" id="status">
                                    <option value="online">online</option>
                                    <option value="offline">offline</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('custom-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customers') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data:'phonenumber',name:'phonenumber'},
                    {data:'status',name:'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


        });

        $(document).on('click', '.deleteCustomer', function() {

            var id = $(this).data("id");
            if (confirm("Are You sure want to delete !")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: '/api/deleteCustomer' + '/' + id,
                    success: function(data) {
                        alert(data.success);
                        window.location.href = "/customers";
                    },
                    error: function(data) {
                        alert(data.error);
                        window.location.href = "/customers";
                        console.log('Error:', data);
                    }
                });
            }
        });



        //edit form open
        $(document).on('click', '.editCustomer', function() {
                var id = $(this).data("id");
                if (confirm("Are You sure want to edit !")) {
                    $.ajax({
                        type: "GET",
                        url: '/api/editCustomer' + '/' + id,
                        success: function (data) {
//                            alert("customer Found Now you can edit Form");
                            $('#modelHeading').html("Edit Book");
                            $('#saveBtn').val("edit-book");
                            $('#ajaxModel').modal('show');
                            var userData = (data);
                            $("input[name='id']").val(userData.id);
                            $("input[name='name']").val(userData.name);
                            $("input[name='email']").val(userData.email);
                            $("input[name='phonenumber']").val(userData.phonenumber);
//                            $("input[name='status']").val(userData.status);
                            console.log('success', userData)
                        },
                        error: function (data) {
                            alert(data.error);
                            console.log('Error:', data);
                            //window.location.href = "/customers";

                        }
                    });
                }

        })

        //update
        $(document).on('submit', '#customerEditForm', function(e) {
            e.preventDefault();
            let formData = new FormData($('#customerEditForm')[0]);
            var id = $('#id').val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '/api/updateCustomer' + '/' + id,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 400) {
                        $('#validation-errors').html('');
                        $.each(response.success, function(key,value) {
                           alert(value);
//                            $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div>');
                        });
                    } else if (response.status == 200) {
                        alert(response.success);
                        window.location.href = "/api/customers";
                    }
                },

                error: function(response) {
                    alert(response.message);
                }
            })

        });




    </script>

@endsection