@if (session()->has('success'))
    <div class="row col-lg-auto">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session()->get('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
@if (session()->has('error'))
    <div class="row col-lg-auto">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! session()->get('error') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
@if ($errors->any())
    <div class="row col-lg-auto">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="list-group">
                @foreach ($errors->all() as $error)
                    <li class="ml-2">{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
        </div>
    </div>
@endif
@if (session('success_message'))
    <div class="alert-alert-success">
        {{ session('success_message') }}
    </div>
@endif
