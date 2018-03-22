@extends('adminlte::page')

@section('title', 'Transferência')

@section('content_header')
<h1>Transferir Saldo</h1>
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
</ol>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h3>Transferir saldo(Informe o recebedor)</h3>
    </div>
    <div class="box-body">
        @include('admin.includes.alerts')
        
        <form method="POST" action="{{ route('confirma.transferencia') }}">
            {!! csrf_field() !!}
            
            <div class="form-group">
                <input type="text" name="sender" placeholder="Informação de quem vai receber a transferência (Nome ou e-mail)" class="form-control"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Próxima etapa</button>
            </div>
        </form>
    </div>
</div>
@stop