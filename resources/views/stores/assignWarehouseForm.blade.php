@extends('admin.layout.dashboard')

@section('page-heading')
    Add warehouse
@endsection

@section('content')
    <div class="card-body" >

        {{ Form::open(array('url' => '/api/postWarehouseStoreForm/'.$store->id,'id'=>'WarehouseForm','method' => 'POST', 'enctype' => 'multipart/form-data')) }}

        @csrf

        <div class="form-group">
            {{ Form::label('Warehouse','Warehouse', ['class' => 'awesome'])}}
            {{Form::select('warehouse',$warehouses->pluck('name','id'), ['id' => 'status'])}}
            {{--//pluck first is value other is option--}}
        </div>

        <div class="form-group">
            {{$store->name}}
        </div>

        <button type="submit" class="btn btn-block btn-info">Submit</button>
        {{ Form::close() }}

    </div>

    @endsection