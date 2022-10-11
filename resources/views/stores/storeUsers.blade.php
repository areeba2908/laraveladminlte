@extends('admin.layout.dashboard')

@section('page-heading')
    USERS LINKED WITH STORE
@endsection

@section('content')

    @include('admin.layout.flashmessages')

    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
        {{--<div class="text-right">--}}
            {{--<a href="{{url('/allowCustomerToStore')}}"><button  class="btn btn-info"></button></a>--}}
        {{--</div>--}}
        <div class="card-body p-4">
            <table class="table" id="table_id">
                <thead>
                <tr class="table-warning">
                    <td>Customer ID</td>
                    <td>Customer Name</td>
                    <td>Customer email</td>
                    {{--<td class="text-center">Action</td>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>

                        {{--<td class="text-center">--}}
                            {{--<a href="{{ url('/editUser')}}/{{$users->id}}"><button class="btn btn-primary btn-sm" >Edit</button></a>--}}
                            {{--<a href="{{url('/deleteUser')}}/{{$users->id}}"><button class="btn btn-danger btn-sm" >Delete</button></a>--}}
                        {{--</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('custom-scripts')

@endsection
