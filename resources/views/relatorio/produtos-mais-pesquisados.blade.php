@extends('template.painel')

@section('heading')

        <strong>Relat&oacute;rio de Termos Mais Pesquisados</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if(empty($produtos))
        <div class="alert alert-danger">
            N&atilde;o existem produtos cadastrados no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>Texto Pesquisado</th>
                <th>Quantidade de Buscas</th>
            </tr>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->texto }} </td>
                    <td>{{$produto->total }} </td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection
