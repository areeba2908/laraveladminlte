@extends('admin.layout.dashboard')
@section('page-heading')
    Create User
@endsection

@section('content')
    <div class="card-body">
        <form method="post" action="{{ url('/api/roleToStores') }}/{{$role->id}}">
            <div class="form-group">
                @csrf
                <label for="name">Which Stores can be accessed By this Role {{$role->name}}:</label>

                @foreach($stores as $store)
                    <div class="form-group">
                        <p>
                            <input class="form-check-input big-checkbox" name="stores[]" type="checkbox" value="{{$store->id}}" id="defaultCheck1">
                            {{$store->name}}
                        </p>
                    </div>
                @endforeach

            </div>
            <button type="submit" class="btn btn-block btn-danger">Submit</button>
        </form>
    </div>
@endsection

@section('custom-scripts')

@endsection