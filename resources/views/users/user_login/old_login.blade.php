@extends('admin.layout.dashboard')
@section('page-heading')
    customer Login
@endsection

@section('content')

    <div class="jumbotron vertical-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-lg-6" >
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">
                        <h1 class="text-center"> customer Login</h1>

                        <form method="POST" action="{{ url('/api/user-login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email"/>
                            </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password"/>
                            </div>
                            <button type="submit" class="btn btn-block btn-danger">Login</button>
                        </form>

                        <a href="/api/register"> Dont have Account?? Register here </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')

@endsection