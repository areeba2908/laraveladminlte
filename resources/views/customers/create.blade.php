@extends('admin.layout.dashboard')
@section('page-heading')
    Create Customer
@endsection

@section('content')
    @include('admin.layout.flashmessages')
    <div class="card-body" >

        {{ Form::open(array('id'=>'customerForm','method' => 'POST', 'enctype' => 'multipart/form-data')) }}

        @csrf
        <div class="form-group">
            {{Form::label('name', 'Name', ['class' => 'awesome'])}}
            {{Form::text('name', '', ['class' => 'form-control'  ,'placeholder' => 'Enter name'])}}
            <span class="text-danger">@error('name'){{ $message }} @enderror</span>
        </div>

        <div class="form-group">
            {{Form::label('email', 'Email', ['class' => 'awesome'])}}
            {{Form::text('email', '', ['class' => 'form-control'  ,'placeholder' => 'Enter email'])}}
            <span class="text-danger">@error('email'){{ $message }} @enderror</span>
        </div>

        <div class="form-group">
            {{Form::label('phonenumber', 'Phone Number', ['class' => 'awesome'])}}
            {{Form::text('phonenumber', '', ['class' => 'form-control'  ,'placeholder' => 'Enter phone no.'])}}
            <span class="text-danger">@error('phonenumber'){{ $message }} @enderror</span>
        </div>

        <div class="form-group">
            {{ Form::label('status','Status', ['class' => 'awesome'])}}
            {{Form::select('status',['online'=>'online','offline'=>'offline'], ['id' => 'status'])}}
            {{--{{Form::number('number','number')}}--}}
            <span class="text-danger">@error('status'){{ $message }} @enderror</span>
        </div>

        <button id="submit" class="btn btn-primary">Submit</button>
        {{ Form::close() }}

    </div>
@endsection

@section('custom-scripts')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script>
        if ($("#customerForm").length > 0) {
            $("#customerForm").validate({
                rules: {
                    phonenumber: {
                        required: true,
                        maxlength: 11,
                        minlength: 11
                    },
                },
                messages: {
                    phonenumber: {
                        required: "Please enter your phone number",
                        maxlength: "Your name maxlength should be 11 characters long.",
                        minlength: "Your name minlength should be 11 characters long."
                    },
                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#submit').html('Please Wait...');
                    $("#submit"). attr("disabled", true);
                    $.ajax({
                        url: "{{url('/createCustomer')}}",
                        type: "POST",
                        data: $('#customerForm').serialize(),
                        success: function( response ) {
                            if (response.status == 200) {
                                $('#submit').html('Submit');
                                $("#submit").attr("disabled", false);
                                alert(response.success);
                                console.log("success error:", response.success);
                                //document.getElementById("customerForm").reset();
                                window.location.href = "/customers";
                            }
                            else if (response.status == 400) {
                                $.each(response.success, function(key,value) {
                                    alert(value);
                                });
                                console.log("validation error:", response.success);
                                //document.getElementById("customerForm").reset();
                            }
                        },
                        error: function (response){
                            alert(response.error);
                        }

                    });
                }
            })
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

@endsection