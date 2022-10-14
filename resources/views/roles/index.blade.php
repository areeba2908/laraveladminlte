@extends('admin.layout.dashboard')
@section('page-heading')
     Roles
@endsection

@section('content')
    <div class="card shadow-0 border" style="background-color: #f0f2f5;">

        {{--<div class="text-right">--}}
        {{--<a href="{{url('/addUser')}}"><button  class="btn btn-info">Create User</button></a>--}}
        {{--</div>--}}

        <div class="card-body p-4">
            <table class="table" id="table_id">
                <thead>
                <tr class="table-warning">
                    <td>ID</td>
                    <td>Role</td>
                    <td class="text-center">Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>

                        <td class="text-center">
                        <a href="{{ url('/api/assignRoles')}}/{{$role->id}}"><button class="btn btn-primary btn-sm" >assign</button></a>
                        {{--<a href="{{url('/deleteUser')}}/{{$users->id}}"><button class="btn btn-danger btn-sm" >Delete</button></a>--}}
                        {{--<a href="{{url('/api_web/getUserRoles')}}/{{$users->id}}"><button class="btn btn-info btn-sm" >Roles</button></a>--}}

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