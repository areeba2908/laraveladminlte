@extends('admin.layout.dashboard')
@section('page-heading')
    Create User
@endsection

@section('content')
    <div class="card-body">
            <form method="post" action="{{ url('/createUser') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name"/>
                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email"/>
                    <span class="text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password"/>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation"/>
                    <span class="text-danger">@error('password_confirmation'){{$message}}@enderror</span>
                </div>
                <span class="text-danger">@error('password_confirmation'){{$message}}@enderror</span>

                <button type="submit" class="btn btn-block btn-danger">Create User</button>
            </form>
    </div>
@endsection

@section('custom-scripts')

@endsection