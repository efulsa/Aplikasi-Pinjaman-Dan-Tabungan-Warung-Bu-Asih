@extends('admins.layouts.app')
@section('content')
<div class="table-responsive">
    <table class="table-bordered table-hover table-striped text-left" width="100%">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nama</td>
                <td>Total</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach($custs as $c)
            @if(!$c->isAdmin == 1)
            <tr>
                <td>{{ $c->id }}/WB/{{date('y',strtotime($c->created_at))}}</td>
                <td>{{$c->name}}</td>
                <td>
                    @if(!empty($c->loanSaldo()->first()->saldo))


                    Rp. {{number_format($c->loanSaldo()->first()->saldo)}}


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