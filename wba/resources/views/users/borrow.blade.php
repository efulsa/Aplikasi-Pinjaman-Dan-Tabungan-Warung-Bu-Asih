@extends('users.layouts.app')
@section('content')

<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Riwayat Peminjaman</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="card">
        <div class="table-responsive">
        <table class="table-bordered table-striped table-hover table-sm" width="100%" cellpadding="4">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Transaksi</th>
                        <th class="text-nowrap">Uang Pinjam</th>
                        <th class="text-nowrap">Uang Bayar</th>
                        <th class="text-nowrap">Total Pinjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrow as $b)
                    <tr>
                        <td class="text-nowrap">{{date('d, F Y',strtotime($b->created_at))}}</td>
                        @if($b->desc == "Pinjam")
                        <td class="text-danger text-nowrap"><img src="{{url('icon/plus.png')}}" width="20" alt=""> {{$b->desc}}</td>
                        @else
                        <td class="text-success text-nowrap"><img src="{{url('icon/minus.png')}}" width="17" alt=""> {{$b->desc}}</td>
                        @endif
                        <td class="text-danger text-nowrap">Rp. {{number_format($b->debit)}}</td>
                        <td class="text-success text-nowrap">Rp. {{number_format($b->credit)}}</td>
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
    </div>
</section>

@endsection