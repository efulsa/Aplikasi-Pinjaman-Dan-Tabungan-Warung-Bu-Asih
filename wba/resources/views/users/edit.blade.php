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
        <input type="text" value="{{$error}}"" hidden>
        <p align="center">email sudah digunakan pelanggan lain</p>
        @endforeach
    </ul>
</div>
@endif

@error('title')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="row justify-content-center mt-3">
<div class="col-md-8">

<div class="card">
    <div class="card-header">
        Ubah Data Anda
    </div>
    <div class="card-body">

        <form action="{{route('user.update',Auth::user()->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="">Nama</label>
                    <input class="form-control form-control-sm" type="text" name="name" value="{{Auth::user()->name}}"
                        readonly>
                    <small class="text-red">nama tidak bisa di ubah</small>
                </div>
                <div class="col">
                    <label for="">Email</label>
                    <input class="form-control form-control-sm" type="email" name="email"
                        placeholder="{{Auth::user()->email}}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <script>
                            alert('{{ '
                                Email sudah digunakan sama yang lain!Ganti lagi ya ? ' }}')
                        </script>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <label for="">Password</label>
                    <input class="form-control form-control-sm" type="text" name="password" minlength="8" autocomplete="off" required>
                    <small class="text-red">password jangan kurang dari 8 karakter</small>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <script>
                            alert('{{ '
                               Password kurang dari 8 karakter ! ' }}')
                        </script>
                    </span>
                    @enderror
                </div>
                <div class="col">
                    <label for="">No Telepon</label>
                    <input class="form-control form-control-sm" type="number" name="no_telp"
                        value="{{Auth::user()->no_telp}}">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <label for="">Tempat Kerja</label>
                    <input class="form-control form-control-sm" type="text" name="work_place"
                        value="{{Auth::user()->work_place}}">
                </div>
                <div class="col">
                    <label for="">Alamat</label>
                    <textarea class="form-control form-control-sm" name="address" cols="30"
                        rows="4">{{Auth::user()->address}}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary form-control form-control-sm mt-2">Ubah</button>
        </form>
    </div>
</div>
</div>
</div>
@endsection