@extends('template.painel')

@section('heading')

        <strong>Relat&oacute;rio de Usu&aacute;rios Cadastrados | Total de Registros: {{$totalDeRegistros}}</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if($usuarios->isEmpty())
        <div class="alert alert-danger">
            N&atilde;o existem usu&aacute;rios cadastrados no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>ID</th>
                <th>Nome</th>
                <th>E-Mail</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Perfil</th>
                <th>Data de Cria&ccedil;&atilde;o</th>
                <th>&Uacute;ltima Atualiza&ccedil;&atilde;o</th>
            </tr>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->id }} </td>
                    <td>{{$usuario->name }} </td>
                    <td>{{$usuario->email }} </td>
                    <td>{{$usuario->telefone }} </td>
                    <td>{{$usuario->cpf }} </td>
                    @if($usuario->perfil_id==1)
                        <td>Administrador</td>
                    @elseif($usuario->perfil_id==2)
                        <td>Cliente</td>
                    @else
                        <td>Propriet&aacute;rio</td>
                    @endif
                    <td>{{date('d/m/Y H:i:s', strtotime($usuario->created_at)) }} </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($usuario->updated_at)) }} </td>
                </tr>
            @endforeach
        </table>
        <div class="col-md-12 no-padding">
            <div class="col-md-2 pull-right no-padding">
                {{ $usuarios->links() }}
            </div>
        </div>
    @endif

@endsection
