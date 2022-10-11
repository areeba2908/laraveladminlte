@extends('admin.layout.dashboard')

@section('page-heading')
    Stores Form
@endsection

@section('content')

    @include('admin.layout.flashmessages')

@section('content')


    <div class="card-body">
        <form method="post" action="{{ url('/api/createStore') }}">
            <div class="form-group">
                @csrf
                <label for="name">Store Name</label>
                <input type="text" class="form-control" name="name"/>
            </div>

            <div class="form-group">
                <label for="name">Slug</label>
                <input type="text" class="form-control" name="slug"/>

            </div>
            <div class="form-group">
                <select name="status" id="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                </br>
            </div>

            @foreach($warehouses as $warehouse)
                <div class="form-group">
                    <p>
                    <input class="form-check-input big-checkbox" name="warehouses[]" type="checkbox" value="{{$warehouse->id}}" id="defaultCheck1">
                        {{$warehouse->name}}
                    </p>
                </div>
                    @endforeach

            <button type="submit" class="btn btn-block btn-danger">Create Store</button>
        </form>
    </div>
@endsection


@endsection

@section('custom-scripts')

@endsection
