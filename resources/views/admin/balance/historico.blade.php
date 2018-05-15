@extends('adminlte::page')

@section('title', 'Histórico de movimentações')

@section('content_header')
    <h1>Histórico de movimentações</h1>
    <ol class="breadcrumb">
        <li>
            <a href="">Dashboard</a>
        </li>
        <li>
            <a href="">Histórico</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
         
        </div>
        
        
        <div class="box-body">
            @include('admin.includes.alerts')
            <table>
                <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
            </table>
            
        </div>
    </div>
@stop