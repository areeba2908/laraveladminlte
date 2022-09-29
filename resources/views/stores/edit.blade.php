@extends('admin.layout.dashboard')

@section('page-heading')
    Stores Edit Form
@endsection

@section('content')

    @include('admin.layout.flashmessages')

@section('content')


    <div class="card-body">
        <form method="post" action="{{ url('/api/putStore') }}/{{$store->id}}">
            @method('put')
            <div class="form-group">
                @csrf
                <label for="name">Store Name</label>
                <input type="text" class="form-control" name="name" value="{{$store->name}}"/>
            </div>

            <div class="form-group">
                <label for="name">Slug</label>
                <input type="text" class="form-control" name="slug" value="{{$store->slug}}"/>

            </div>
            <div class="form-group">
                <select name="status" id="status" >
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                </br>
            </div>

            <button type="submit" class="btn btn-block btn-primary">update Store</button>
        </form>
    </div>
@endsection



@endsection

@section('custom-scripts')

@endsection
