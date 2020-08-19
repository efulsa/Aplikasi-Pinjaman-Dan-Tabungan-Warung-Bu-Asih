@extends('admins.layouts.app')
@section('content')
<div class="table-responsive">
    <table border="1" class="table-hover table-striped text-left" width="100%">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Total</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; ?>
            @foreach($custs as $c)
            @if(!$c->isAdmin == 1)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{$c->name}}</td>
                <td>
                    @if(!empty($c->borrowSaldo()->first()->saldo))

                    Rp. {{number_format($c->borrowSaldo()->first()->saldo)}}

                    @endif
                </td>
                <td></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection