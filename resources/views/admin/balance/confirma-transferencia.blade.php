@extends('adminlte::page')

@section('title', 'Confirmar transferência')

@section('content_header')
<h1>Confirmar transferência</h1>
<ol class="breadcrumb">
    <li>
        <a href="">Dashboard</a>
    </li>
    <li>
        <a href="">Saldo</a>
    </li>
    <li>
        <a href="">Transferir</a>
    </li>
    <li>
        <a href="">Confirmação</a>
    </li>
</ol>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h3>Confirmar transferência</h3>
    </div>
    <div class="box-body">
        @include('admin.includes.alerts')
        
        <div class="form-group">
            <label>Recebedor:</label>
            <input type="text" value="{{ $sender->name }}" disabled="disabled" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Seu saldo atual:</label>
            <input type="text" value="R$ {{ number_format($balance->amount, 2, ',', '') }}" disabled="disabled" class="form-control"/>
        </div>
        
        <form method="POST" action="{{ route('transferencia.store') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="sender_id" class="form-control" value="{{ $sender->id }}"/>
            <div class="form-group">
                <label>Valor:</label>
                <input type="text" name="valorMoney" placeholder="Informe o valor" class="form-control"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Transferir</button>
            </div>
        </form>
    </div>
</div>
@stop