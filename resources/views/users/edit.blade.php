@extends('admin.layout.dashboard')
@section('page-heading')
    Edit User
@endsection

@section('content')
    <div class="card-body">
        <form method="post" action="{{ url('/updateUser') }}/{{$user->id}}">
            <div class="form-group">
                @csrf
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value = "{{$user->name}}"/>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value = "{{$user->email}}"/>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value = "{{$user->password}}"/>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation"/>
            </div>
            <span class="text-danger">@error('password_confirmation'){{$message}}@enderror</span>

            <button type="submit" class="btn btn-block btn-danger">Update User</button>
        </form>
    </div>
    </div>
@endsection

@section('custom-scripts')

@endsection