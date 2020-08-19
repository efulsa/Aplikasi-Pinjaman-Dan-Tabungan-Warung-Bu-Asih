@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="jumbotron text-center bg-light">

            <h1>
                <p class="font-weight-bold">Daftar nama pelanggan</p>
            </h1>
            <hr>
            <p><u>Password Default : 12345678</u></p>

            <b class="text-danger">Anda dapat mengubah password ketika sudah login</b>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <a href="{{route('home')}}" class="btn btn-secondary"><img src="{{asset('icon/home.png')}}" width="30" alt=""> Kembali Ke Home</a>
    </div>
</div>
<div class="card">
    <div class="row">
        <div class="col">
            <div class="card-header font-weight-bold">
                Daftar Pelanggan
            </div>
        </div>
        <div class="col pt-3 mr-4">
            <form action="{{route('check')}}">
                <div class="input-group input-group-sm md-form form-1">
                    <div class="input-group-prepend ">
                        <span class="input-group-text purple lighten-3" id="basic-text1"><img
                                src="{{url('icon/search.png')}}" width="20" alt=""></span>
                    </div>
                    <input class="form-control" type="text" placeholder="Cari Nama Anda ..." aria-label="Search"
                        value="{{Request::get('search')}}" name="search">
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <div class="card" style="border:none;">
            <table class="table-striped table-bordered table-hover" width="100%" cellpadding="4">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach($custs as $c)
                    @if($c->isAdmin == 0)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td class="text-nowrap">{{ $c->name }}</td>
                        <td class="text-nowrap"><b>{{ $c->email }}</b></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="clear"><br></div>
    <div class="pagination pagination-sm justify-content-end">
        {{ $custs->appends(Request::all())->links()}}
    </div>
</div>

@endsection
