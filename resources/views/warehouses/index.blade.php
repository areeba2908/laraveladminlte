@extends('admin.layout.dashboard')

@section('page-heading')
    Warehouses
@endsection

@section('content')

    @include('admin.layout.flashmessages')

@section('content')

    @include('admin.layout.flashmessages')

    <div class="container mt-5 mb-3">
        <div class="text-right">
            <a href="{{url('/api/addWarehouse')}}"><button  class="btn btn-primary">Create Warehouse</button></a>
        </div>
        <div class="row">
            <?php $i=0 ?>
            @foreach($warehouses as $warehouse)
                <div class="col-md-4">
                    {{--<a href="{{url('/api/getStoreCustomers')}}/{{$store->id}}">--}}
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">Status: <span class="p-1 mb-2 bg-success text-white">
                                                @if($warehouse->status==1)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif</span></h6>
                                    </div>
                                </div>
                                <div class="badge"> <span><?php $i=$i+1 ?>{{$i}}</span> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading">WAREHOUSE:<br><span class="text-info">{{$warehouse->name}}</span></h3>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3">
                                        <form action="{{url('/api/deleteWarehouse/')}}/{{$warehouse->id}}" method="post">
                                            <input class="btn btn-info" type="submit" value="Delete" />
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{url('/api/editWarehouse/')}}/{{$warehouse->id}}" >
                                            <input class="btn btn-info" value="Edit" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{--</a>--}}
                </div>


            @endforeach

        </div>
    </div>


@endsection


@endsection

@section('custom-scripts')

@endsection
