@extends('admin.layout.dashboard')

@section('page-heading')
    Warehouse Form
@endsection

@section('content')

    @include('admin.layout.flashmessages')


@section('content')


    <div class="card-body" >

        {{ Form::open(array('url' => '/api/createWarehouse','id'=>'WarehouseForm','method' => 'POST', 'enctype' => 'multipart/form-data')) }}

        @csrf
        <div class="form-group">
            {{Form::label('name', 'Name', ['class' => 'awesome'])}}
            {{Form::text('name', '', ['class' => 'form-control' ])}}
            {{--<span class="text-danger">@error('name'){{ $message }} @enderror</span>--}}
        </div>

        <div class="form-group">
            {{Form::label('location', 'Location', ['class' => 'awesome'])}}
            {{Form::text('location', '', ['class' => 'form-control'])}}
            {{--<span class="text-danger">@error('email'){{ $message }} @enderror</span>--}}
        </div>

        <div class="form-group">
            {{ Form::label('status','Status', ['class' => 'awesome'])}}
            {{Form::select('status',['active'=>'active','inactive'=>'inactive'], ['id' => 'status'])}}
            {{--{{Form::number('number','number')}}--}}
            {{--<span class="text-danger">@error('status'){{ $message }} @enderror</span>--}}
        </div>

        <button type="submit" class="btn btn-block btn-info">Create Warehouse</button>
        {{ Form::close() }}

    </div>
@endsection

@endsection

@section('custom-scripts')

@endsection
