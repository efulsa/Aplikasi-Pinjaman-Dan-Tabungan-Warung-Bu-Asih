@extends('admins.layouts.app')
@section('content')
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Pengelola Pelanggan</h2>
    </div>
</header>
<!-- Breadcrumb-->
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.customer.index')}}">Pelanggan</a></li>
        <li class="breadcrumb-item active">{{$cust->name}}</li>
    </ul>
</div>

<div class="card border-dark">
    <div class="card-header">
        <p class="font-weight-bold h5 text-center">Rincian Riwayat Transaksi Tabungan "{{$cust->name}}"</p>
    </div>
    <div class="card-body">
    <a class="btn btn-sm btn-outline-primary mb-2" href="{{route('admin.saving.index')}}">Transaksi Tabungan</a>
        <div class="table-responsive">
            <table class="table-sm table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th class="text-nowrap">Jenis Transaksi</th>
                        <th class="text-nowrap">Uang Setor</th>
                        <th class="text-nowrap">Uang Tarik</th>
                        <th class="text-nowrap">Total Tabungan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saving as $s)
                    <tr>
                        <td class="text-nowrap">{{$s->id}}/WB/{{date('y',strtotime($s->created_at))}}</td>
                        <td class="text-nowrap">{{date('d, F Y',strtotime($s->created_at))}}</td>
                        @if($s->desc == "Setor")
                        <td class="text-nowrap"><img src="{{url('icon/plus.png')}}" width="20" alt=""> {{$s->desc}}</td>
                        @else
                        <td class="text-nowrap"><img src="{{url('icon/minus.png')}}" width="17" alt=""> {{$s->desc}}</td>
                        @endif
                        <td class="text-nowrap">Rp. {{number_format($s->debit)}}</td>
                        <td class="text-nowrap">Rp. {{number_format($s->credit)}}</td>
                        <td class="text-nowrap">Rp. {{number_format($s->saldo)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="pagination pagination-sm justify-content-end mr-3 mt-1">
                        {{ $saving->appends(Request::all())->links()}}
                    </div>
    </div>
</div>
@endsection