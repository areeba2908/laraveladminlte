@extends('admin.layout.dashboard')
@section('page-heading')
Users Profile
@endsection

@section('content')
    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
        {{--@role('admin')--}}

            <div class="text-right">
                <a href="{{url('/addUser')}}"><button  class="btn btn-info">Create User</button></a>
            </div>
        {{--@endrole--}}
        <div class="card-body p-4">
            <table class="table" id="table_id">
                <thead>
                <tr class="table-warning">
                    <td>ID</td>
                    <td>{{Auth::user()->name}}</td>
                    <td>Email</td>
                    <td class="text-center">Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $users)
                    <tr>
                        <td>{{$users->id}}</td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->email}}</td>

                        <td class="text-center">
                            <a href="{{ url('/editUser')}}/{{$users->id}}"><button class="btn btn-primary btn-sm" >Edit</button></a>
                            <a href="{{url('/deleteUser')}}/{{$users->id}}"><button class="btn btn-danger btn-sm" >Delete</button></a>
                            <a href="{{url('/api/getUserRoles')}}/{{$users->id}}"><button class="btn btn-info btn-sm" >Roles</button></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

@endsection

@section('custom-scripts')
            @include('users.scripts')
@endsection