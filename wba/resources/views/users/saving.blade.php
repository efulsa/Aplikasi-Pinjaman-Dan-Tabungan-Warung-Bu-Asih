@extends('users.layouts.app')
@section('content')

<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Riwayat Tabungan</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="card">
            <div class="table-responsive">
                <table class="table-sm table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Transaksi</th>
                            <th class="text-nowrap">Uang Setor</th>
                            <th class="text-nowrap">Uang Tarik</th>
                            <th class="text-nowrap">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($saving as $s)
                        <tr>
                            <td class="text-nowrap">{{date('d, F Y',strtotime($s->created_at))}}</td>
                            @if($s->desc == "Setor")
                            <td class="text-success text-nowrap"><img src="{{url('icon/plus.png')}}" width="20" alt=""> {{$s->desc}}</td>
                            @else
                            <td class="text-danger text-nowrap"><img src="{{url('icon/minus.png')}}" width="17" alt=""> {{$s->desc}}</td>
                            @endif
                            <td class="text-success text-nowrap">Rp. {{number_format($s->debit)}}</td>
                            <td class="text-danger text-nowrap">Rp. {{number_format($s->credit)}}</td>
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
    </div>
</section>

@endsection