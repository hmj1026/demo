@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>歡迎，管理員帳號 {{ auth()->user()->account }} 登入</p>
@stop

@section('css')

@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop