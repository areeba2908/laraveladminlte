@extends('admin.layout.dashboard')

@section('page-heading')
    Stores
@endsection

@section('content')

    @include('admin.layout.flashmessages')

    <div class="container mt-5 mb-3">
        <div class="text-right">
            @role('admin')
            <a href="{{url('/api/addStore')}}"><button  class="btn btn-info">Create Store</button></a>
            @endrole
        </div>
        <div class="row">
            <?php $i=0 ?>
            @foreach($stores as $store)
                        <div class="col-md-4">
                            {{--<a href="{{url('/api/getStoreCustomers')}}/{{$store->id}}">--}}
                            <div class="card p-3 mb-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                        <div class="ms-2 c-details">
                                            <h6 class="mb-0">Status: <span class="p-1 mb-2 bg-success text-white">
                                                @if($store->status==1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif</span></h6>
                                        </div>
                                    </div>
                                    <div class="badge"> <span><?php $i=$i+1 ?>{{$i}}</span> </div>
                                </div>
                                <div class="mt-5">
                                    <h3 class="heading">STORE:</h3><h2><span class="text-info">{{$store->name}}</span></h2>
                                    <div class="mt-5">
                                        {{--<div class="progress">--}}
                                        {{--<div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                        {{--</div>--}}
                                        <div class="mt-3">
                                            <form action="{{url('/api/deleteStore/')}}/{{$store->id}}" method="post">
                                                <input class="btn btn-danger btn-sm" type="submit" value="Delete" />
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </div>
                                        <div class="mt-3 ">
                                            <a href="{{url('/api/editStore/')}}/{{$store->id}}" >
                                                <input  type="button" class="btn btn-info btn-sm" value="Edit" />
                                            </a>
                                            <a href="{{url('/api/getStoreCustomers/')}}/{{$store->id}}" >
                                                <input  type="button" class="btn btn-default btn-sm" value="Customers" />
                                            </a>
                                            <a href="{{url('/api/getStoreWarehouses/')}}/{{$store->id}}" >
                                                <input  type="button" class="btn btn-default btn-sm" value="Warehouses" />
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

@section('custom-scripts')

@endsection
