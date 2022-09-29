@extends('admin.layout.dashboard')

@section('page-heading')
    Stores
@endsection

@section('content')

    @include('admin.layout.flashmessages')

    <div class="container mt-5 mb-3">
        <div class="row">
            <?php $i=0 ?>
            @foreach($stores as $store)
            <div class="col-md-4">
                <a href="{{url('/api/getStoreCustomers')}}/{{$store->id}}">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                            {{--<div class="ms-2 c-details">--}}
                                {{--<h6 class="mb-0">Store Name</h6> <span>{{$store->name}}</span>--}}
                            {{--</div>--}}
                        </div>
                        <div class="badge"> <span><?php $i=$i+1 ?>{{$i}}</span> </div>
                    </div>
                    <div class="mt-5">
                        <h3 class="heading">STORE:<br><span class="text-info">{{$store->name}}</span></h3>
                        <div class="mt-5">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div>
                        </div>
                    </div>
                </div>
            </div>
                </a>
                @endforeach

        </div>
    </div>


@endsection

@section('custom-scripts')

@endsection
