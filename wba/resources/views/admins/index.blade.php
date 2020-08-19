@extends('admins.layouts.app')
@section('content')

<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Dashboard</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl col-sm">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><img src="{{url('icon/customer.png')}}" width="28" alt=""></div>
                    <div class="title"><span>Total<br>Pelanggan</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="1000" style="width:{{percent($users)}}%"></div>
                        </div>
                    </div>

                </div>
                <div class="number"><strong>{{ $users }}</strong></div>
            </div>
            <!-- Item -->
            <div class="col-xl col-sm">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><img src="{{url('icon/borrow.png')}}" width="28" alt=""></div>
                    <div class="title"><span>Total<br>Pinjaman</span>
                        <div class="progress">
                        @if(!empty($borrows->total))
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $borrows->total }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ percentTotal($borrows->total) }}%"></div>
                        @else
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        @endif
                        </div>
                    </div>

                </div>
                @if(!empty($borrows->total))
                <div class="number"><strong>Rp. {{ number_format($borrows->total) }}</strong></div>
                @else
                <div class="number"><strong>Rp. 0</strong></div>
                @endif
            </div>
            <!-- Item -->
            <div class="col-xl col-sm">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><img src="{{url('icon/saving.png')}}" width="35" alt=""></div>
                    <div class="title"><span>Total<br>Tabungan</span>
                        <div class="progress">
                        @if(!empty($savings->total))
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $savings->total }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ percentTotal($savings->total) }}%"></div>
                        @else
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        @endif
                        </div>
                    </div>

                </div>
                @if(!empty($savings->total))
                <div class="number"><strong>Rp. {{ number_format($savings->total) }}</strong></div>
                @else
                <div class="number"><strong>Rp. 0</strong></div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('admins.layouts.footer')

@endsection