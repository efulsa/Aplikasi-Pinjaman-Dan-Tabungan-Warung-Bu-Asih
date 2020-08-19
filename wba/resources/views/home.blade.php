<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->

<div class="row justify-content-center align-middle py-5 mb-5">
            <div class="col text-center">
                <div class="_1">WARUNG BU ASIH</div>
                <hr>
                <br>
                @if(Auth::user()->isAdmin == 1)
                <a class="btn" href="/public/admin/dashboard">
                    Go To Dashboard</a>
                @elseif(Auth::user()->isAdmin == 0)
                <a class="btn" href="/public/user/dashboard">
                    Go To Dashboard</a>
                @endif
            </div>
        </div>
