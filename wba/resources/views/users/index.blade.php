@extends('users.layouts.app')
@section('content')
@if(session('success'))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@error('title')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Home</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom mb-4">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl col-sm">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><img src="{{url('icon/borrow.png')}}" width="28" alt=""></div>
                    <div class="title"><span>Total<br>Pinjaman Anda</span>
                        <div class="progress">
                            @if(!empty($borrows->saldo))
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="{{ $borrows->saldo }}" aria-valuemin="0" aria-valuemax="100"
                                style="width: {{ percentTotal($borrows->saldo) }}%"></div>
                            @else
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            @endif
                        </div>
                    </div>

                </div>
                @if(!empty($borrows->saldo))
                <div class="number"><strong>Rp. {{ number_format($borrows->saldo) }}</strong></div>
                @else
                <div class="number"><strong>Rp. 0</strong></div>
                @endif
            </div>
            <!-- Item -->
            <div class="col-xl col-sm">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><img src="{{url('icon/saving.png')}}" width="35" alt=""></div>
                    <div class="title"><span>Total<br>Tabungan Anda</span>
                        <div class="progress">
                            @if(!empty($savings->saldo))
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="{{ $savings->saldo }}" aria-valuemin="0" aria-valuemax="100"
                                style="width: {{ percentTotal($savings->saldo) }}%"></div>
                            @else
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            @endif
                        </div>
                    </div>

                </div>
                @if(!empty($savings->saldo))
                <div class="number"><strong>Rp. {{ number_format($savings->saldo) }}</strong></div>
                @else
                <div class="number"><strong>Rp. 0</strong></div>
                @endif
            </div>
        </div>
        <div class="row bg-white has-shadow mt-2">
            <!-- Item -->
            <div class="col">
                <div class="">
                    <div class="row pl-4">
                        <div class="icon bg-primary"><img src="{{url('icon/customer.png')}}" width="28" alt=""></div>
                        <div class="title"><span>Rincian<br>Data Diri Anda</span>
                        </div>
                        <div class="table-responsive">
                        <table width="100%">
                            <tr>
                                <th>ID</th>
                                <td class="text-nowrap">: {{Auth::user()->id}}/WBA/{{date('y',strtotime(Auth::user()->created_at))}}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td class="text-nowrap">: {{Auth::user()->name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td class="text-nowrap">: {{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">Tempat Kerja</th>
                                <td class="text-nowrap">: {{Auth::user()->work_place}}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>: {{Auth::user()->address}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">No Telpon</th>
                                <td class="text-nowrap">: {{Auth::user()->no_telp}}</td>
                            </tr>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@include('users.layouts.footer')

@endsection