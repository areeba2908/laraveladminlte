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

                        <form method="post" action="{{url('api/user-register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="enter full name"/>
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email"/>
                            </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password"/>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="password_confirmation">Confirm Password</label>--}}
                                {{--<input type="password" class="form-control" name="password_confirmation"/>--}}
                            {{--</div>--}}

                            <button type="submit" class="btn btn-block btn-danger">Register</button>
                        </form>

                        <a href="/api/login"> Already have account?? Login here </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')

@endsection