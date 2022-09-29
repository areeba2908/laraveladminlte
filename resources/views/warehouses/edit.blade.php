@extends('admin.layout.dashboard')

@section('page-heading')
    Warehouse Edit Form
@endsection

@section('content')

    @include('admin.layout.flashmessages')

@section('content')


    <div class="card-body">
        <form method="post" action="{{ url('/api/putWarehouse') }}/{{$data->id}}">
            @method('put')
            <div class="form-group">
                @csrf
                <label for="name">Warehouse Name</label>
                <input type="text" class="form-control" name="name" value="{{$data->name}}"/>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" value="{{$data->location}}"/>

            </div>
            <div class="form-group">
                <select name="status" id="status" >
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                </br>
            </div>

            <button type="submit" class="btn btn-block btn-primary">update Warehouse</button>
        </form>
    </div>
@endsection


@endsection

@section('custom-scripts')

@endsection
