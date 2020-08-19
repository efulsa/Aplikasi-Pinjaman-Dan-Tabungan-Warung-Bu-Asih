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
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Pelanggan</li>
    </ul>
</div>
@if(session('success'))
<div class="alert alert-success text-center" role="alert">
    <p class="font-weight-bold">
        {{ (session('success')) }}
    </p>
</div>
@endif
@if(session('done'))
<div class="alert alert-danger text-center" role="alert">
    <p class="font-weight-bold">
        {{ (session('done')) }}
    </p>
</div>
@endif
@if(session('saving'))
<div class="alert alert-warning text-center" role="alert">
    <p class="font-weight-bold">
        {{ (session('saving')) }}
    </p>
</div>
@endif
@if(session('borrow'))
<div class="alert alert-warning text-center" role="alert">
    <p class="font-weight-bold">
        {{ (session('borrow')) }}
    </p>
</div>
@endif
@if(session('borrowsave'))
<div class="alert alert-warning text-center" role="alert">
    <p class="font-weight-bold">
        {{ (session('borrowsave')) }}
    </p>
</div>
@endif
<section class="tables">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div class="row">
                            <div class="col mb-1">
                                <a href="#" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                    data-target="#createModal">
                                    <img src="{{url('icon/create.png')}}" width="20" alt="">Pelanggan Baru
                                </a>
                            </div>
                            <div class="col">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img src="{{url('icon/print.png')}}" width="20" alt=""> Print
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item text-danger" href="{{route('admin.printBorrow')}}">Print Pinjaman</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-success" href="{{route('admin.printSaving')}}">Print Tabungan</a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="row mt-2 justify-content-center">
                        <div class="col-11">
                            <form action="{{route('admin.customer.index')}}">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text purple lighten-3" id="basic-text1"><img
                                                src="{{url('icon/search.png')}}" width="20" alt=""></span>
                                    </div>
                                    <input class="form-control form-control-sm" type="text"
                                        placeholder="Cari Nama Pelanggan ..." aria-label="Search"
                                        value="{{Request::get('search')}}" name="search">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-bordered table-hover text-center" width="100%" cellpadding="3">
                                <thead>
                                    <tr colspan="2">
                                        <td rowspan="2">ID</td>
                                        <td rowspan="2">Nama</td>
                                        <td colspan="2">Total</td>
                                        <td colspan="2">Riwayat</td>
                                        <td rowspan="2">Menu</td>
                                    </tr>
                                    <tr scope="col">
                                        <td class="text-danger">Pinjaman</td>
                                        <td class="text-success">Tabungan</td>

                                        <td class="text-danger">Pinjaman</td>
                                        <td class="text-success">Tabungan</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($custs as $c)
                                    @if(!$c->isAdmin == 1)
                                    <tr>
                                        <td class="text-nowrap">{{ $c->id }}/WB/{{date('y',strtotime($c->created_at))}}
                                        </td>
                                        <td class="text-nowrap" align="left">{{$c->name}}</td>
                                        <td class="text-nowrap" align="left">
                                            @if(!empty($c->borrowSaldo()->first()->saldo))
                                            <span>
                                                Rp. {{number_format($c->borrowSaldo()->first()->saldo)}}
                                            </span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap" align="left">
                                            @if(!empty($c->loanSaldo()->first()->saldo))
                                            <span>

                                                Rp. {{number_format($c->loanSaldo()->first()->saldo)}}

                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span>
                                                <a href="{{route('admin.borrow.show',$c->id)}}" data-toggle="tooltip"
                                                    data-placement="bottom" title="lihat riwayat pinjaman"><img
                                                        src="{{url('icon/pinjam.png')}}" width="25" alt=""></a>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <a href="{{route('admin.saving.show',$c->id)}}" data-toggle="tooltip"
                                                    data-placement="bottom" title="lihat riwayat tabungan"><img
                                                        src="{{url('icon/tabungan.png')}}" width="25" alt="">
                                                </a>
                                            </span>
                                        </td>
                                        <td class="text-nowrap">
                                            <form action="{{route('admin.customer.destroy',$c->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="" data-toggle="modal" class="bg-primary badge-rounded"
                                                    data-target="#showModal{{$c->id}}" data-toggle="tooltip"
                                                    data-placement="bottom" title="lihat pelanggan">
                                                    <img src="{{url('icon/show.png')}}" width="28" alt="">
                                                </a>
                                                <a href="" data-toggle="modal" class="bg-warning badge-rounded"
                                                    data-target="#editModal{{$c->id}}" data-toggle="tooltip"
                                                    data-placement="bottom" title="edit pelanggan">
                                                    <img src="{{url('icon/edit.jpg')}}" width="25" alt="">
                                                </a>
                                                <button type="submit" class="bg-danger badge-rounded"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="hapus pelaggan">
                                                    <img src="{{url('icon/delete.png')}}" width="20" alt="">
                                                </button>
                                            </form>
                                            @include('admins.customers.modal')
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="justify-content-center pagination pagination-sm justify-content-end mt-2">
                            {{ $custs->appends(Request::all())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Footer-->
@include('admins.layouts.footer')
<!-- Modal Create-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Pelanggan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.customer.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm">
                            <label for="name">Nama Pelanggan</label>
                            <input class="form-control form-control-sm" type="text" name="name" id="" autofocus="name"
                                required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm">
                            <label for="">Email</label>
                            <input class="form-control form-control-sm" type="email" name="email" id=""
                                value="wba{{ $email }}@wba.com">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm">
                            <label for="">Password</label>
                            <input class="form-control form-control-sm" type="password" name="password" id=""
                                value="12345678">
                        </div>
                        <div class="col-sm">
                            <label for="">No Telepon</label>
                            <input class="form-control form-control-sm" type="number" name="no_telp" id="">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm">
                            <label for="">Tempat Kerja</label>
                            <input class="form-control form-control-sm" type="text" name="work_place" id="">
                        </div>
                        <div class="col-sm">
                            <label for="">Alamat</label>
                            <textarea class="form-control form-control-sm" name="address" id="" cols="30"
                                rows="4"></textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-sm btn-primary form-control form-control-sm mt-2">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admins.layouts.footer')

@endsection