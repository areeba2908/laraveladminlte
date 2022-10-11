@extends('admin.layout.dashboard')
@section('page-heading')
    customer Registeration
@endsection

@section('content')

    <div class="jumbotron vertical-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-lg-6" >
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">

                        <form id="user-register-form" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="enter full name"/>
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"/>
                            </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"/>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-12">
                                    <select name="status" id="status">
                                        <option value="active">active</option>
                                        <option value="inactive">inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="submit" value="create">Submit
                                </button>
                            </div>
                        </form>

                        <a href="/api_web/login"> Already have account?? Login here </a>

                    </div>
                </div>
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
<script>
    $(document).on('submit', '#user-register-form', function(e) {
        e.preventDefault();
        let formData = new FormData($('#user-register-form')[0]);
        var id = $('#id').val() //method to get form field
//        if (id == "") {
            url = '/api/user-register';
//        } else {
//            url = 'customers' + '/' + id;
//        }
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 400) {
//                    $('#save_errorlist').html('');
//                    $('#save_errorlist').removeClass('d-none')
//                    $.each(response.error, function(key, err_value) {
                        alert(response.error);
//                        $('#save_errorlist').append('<li>' + err_value + '</li>');
//                    });
                } else if (response.status == 200) {
//                    $('#save_errorlist').html('');
//                    $('#save_errorlist').addClass('d-none');
                    token= response.token;
                    alert(response.success);
                    window.location.href = "/api/dashboard";
                }
            }
        })

    });
</script>
@endsection