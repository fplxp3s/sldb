@extends('template.painel')

@section('heading')
    <strong>Dashboard</strong>
@endsection

@section('content')

    Bem-vindo ao seu painel de controle <strong>{{Auth::user()->name}}</strong>!

@endsection
