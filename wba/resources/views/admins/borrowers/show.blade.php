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
        <p class="font-weight-bold h5 text-center">Rincian Riwayat Transaksi Pinjaman "{{$cust->name}}"</p>
    </div>
    <div class="card-body">
    <a class="btn btn-sm btn-outline-primary mb-2" href="{{route('admin.borrow.index')}}">Transaksi Pinjaman</a>
        <div class="table-responsive">
            <table class="table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th class="text-nowrap">Jenis Transaksi</th>
                        <th class="text-nowrap">Uang Pinjam</th>
                        <th class="text-nowrap">Uang Bayar</th>
                        <th class="text-nowrap">Uang Kembali</th>
                        <th class="text-nowrap">Total Pinjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrow as $b)
                    <tr>
                        <td class="text-nowrap">{{$b->id}}/WB/{{date('y',strtotime($b->created_at))}}</td>
                        <td class="text-nowrap">{{date('d, F Y',strtotime($b->created_at))}}</td>
                        @if($b->desc == "Pinjam")
                        <td><img src="{{url('icon/plus.png')}}" width="20" alt=""> {{$b->desc}}</td>
                        @else
                        <td><img src="{{url('icon/minus.png')}}" width="17" alt=""> {{$b->desc}}</td>
                        @endif
                        <td class="text-nowrap">Rp. {{number_format($b->debit)}}</td>
                        <td class="text-nowrap">Rp. {{number_format($b->credit)}}</td>
                        <td class="text-nowrap">Rp. {{number_format($b->bill_back)}}</td>
                        <td class="text-nowrap">Rp. {{number_format($b->saldo)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="pagination pagination-sm justify-content-end mr-3 mt-1">
                        {{ $borrow->appends(Request::all())->links()}}
                    </div>
    </div>
</div>
@endsection