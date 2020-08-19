@extends('admins.layouts.app')
@section('content')
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Pengelola Pinjaman</h2>
    </div>
</header>
<!-- Breadcrumb-->
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Pinjaman</li>
    </ul>
</div>

@if(!empty($bill_back))
<div class="alert alert-warning text-center" role="alert">
    <p class="font-weight-bold">
        Uang Kembalian Rp. {{ number_format($bill_back) }}
    </p>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger text-center" role="alert">
    <p class="font-weight-bold">
        {{ (session('error')) }}
    </p>
</div>
@endif
@if(session('pinjam'))
<div class="alert alert-success text-center" role="alert">
    <p class="font-weight-bold">
        {{ (session('pinjam')) }}
    </p>
</div>
@endif
@if(session('bayar'))
<div class="alert alert-warning text-center" role="alert">
    <p class="font-weight-bold">
        {{ (session('bayar')) }}
    </p>
</div>
@endif

<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <!-- Inline Form-->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="dropdown-toggle">X</button>
                            <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                    href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a
                                    href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Transaksi Pinjaman</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.borrow.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm">
                                    <label for="">Pilih Pelanggan</label>
                                    <select class="custom-select custom-select-sm" id="country" name="user_id" required>
                                        <option value=""></option>
                                        @foreach($custs as $c)
                                        @if(!$c->isAdmin == 1)
                                        <option value="{{ $c->id }}">{{$c->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label for="">Jenis Transaksi</label>
                                    <select name="type" class="custom-select custom-select-sm" required>
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="1">Pinjam</option>
                                        <option value="2">Bayar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="">Jumlah Uang</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp.</div>
                                        </div>
                                        <input autocomplete="off" name="bill_amount" type="text" class="form-control"
                                            id="rupiah" placeholder="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit"
                                        class="form-control custom-select-sm btn btn-sm btn-outline-primary mt-3 mr-auto">
                                        Enter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Form-->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header align-items-center">
                        <div class="row">
                            <div class="col">
                                <p>Transaksi Terbaru</p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($borrow as $b)
                            <div class="col">
                                <p class="h4">Total Peminjaman dari <h4 class="text-uppercase">{{$b->user->name}}</h4>
                                </p>
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold">Rp. {{number_format($b->saldo)}}</h1>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Elements -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-close">
                    </div>
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Riwayat Transaksi Pinjaman</h3>
                    </div>
                    <div class="table-responsive">
                        <div class="card-body">
                            <table class="table-striped table-bordered text-center" width="100%" cellpadding="4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th class="text-nowrap">Nama Pelanggan</th>
                                        <th class="text-nowrap">Jenis Transaksi</th>
                                        <th class="text-nowrap">Jumlah Uang</th>
                                        <th class="text-nowrap">Total Pinjaman</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($borrows as $b)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class="text-nowrap">{{date('d F Y', strtotime($b->created_at))}}</td>
                                        <td class="text-nowrap">{{$b->user->name}}</td>
                                        @if($b->desc == "Pinjam")
                                        <td class="text-nowrap"><img src="{{url('icon/plus.png')}}" width="20" alt="">
                                            {{$b->desc}}</td>
                                        @else
                                        <td class="text-nowrap"><img src="{{url('icon/minus.png')}}" width="17" alt="">
                                            {{$b->desc}}</td>
                                        @endif
                                        @if($b->desc == "Pinjam")
                                        <td class="text-nowrap" align="left">Rp. {{number_format($b->debit)}}</td>
                                        @else
                                        <td class="text-nowrap" align="left">Rp. {{number_format($b->credit)}}</td>
                                        @endif
                                        <td class="text-nowrap" align="left">Rp. {{number_format($b->total)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="pagination pagination-sm justify-content-end mr-3 mt-1">
                        {{ $borrows->appends(Request::all())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('admins.layouts.footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script type="text/javascript">
    $("#country").select2({
        placeholder: "Cari Nama Pelanggan",
        allowClear: true
    });
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function (e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? rupiah : "";
    }
</script>
@endsection