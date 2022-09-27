@if (session()->has('success'))
    <div id="successMessage">
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> {{ session('success') }}</strong>
        </div>
    </div>
@endif


@if ($message = Session::has('error'))
    <div id="successMessage">
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('error') }}</strong>
        </div>
    </div>
@endif


@if ($message = Session::has('warning'))
    <div id="successMessage">
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('warning') }}</strong>
        </div>
    </div>
@endif


@if ($message = Session::has('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ session('info') }}</strong>
    </div>
@endif


@if ($errors->any())
    <div id="successMessage">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Please check the form below for errors
        </div>
    </div>
@endif