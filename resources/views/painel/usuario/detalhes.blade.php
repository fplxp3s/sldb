@extends('template.painel')

@section('heading')
    @if(!$edita)
        <strong>Detalhes do Usu&aacute;rio</strong>
    @else
        <strong>Editar Informa&ccedil;&otilde;es do Usu&aacute;rio</strong>
    @endif
@endsection

@section('content')

    @if(!$edita)

        <div class="col-md-3 perfil-usuario text-center">
            <i class="fa fa-user" style="font-size: 210px"></i>
            <div class="clearfix"></div>
            <h2>{{$usuario->name}} </h2>
        </div>
        <div class="col-md-7 col-md-offset-1">
            <ul class="list-unstyled detalhe-usuario">
                <li>
                    <b>Perfil:</b>
                    @if($usuario->perfil_id==1)
                        Administrador
                    @elseif($usuario->perfil_id==2)
                        Cliente
                    @else
                        Propriet&aacute;rio
                    @endif
                </li>
                <li>
                    <b>E-mail:</b> {{$usuario->email}}
                </li>
                <li>
                    <b>Data de criação:</b> {{date('d/m/Y H:i:s', strtotime($usuario->created_at))}}
                </li>
                <li>
                    <b>Última atualização:</b> {{date('d/m/Y H:i:s', strtotime($usuario->updated_at))}}
                </li>
            </ul>
            <br>

            <div class="form-group">
                <div class="col-md-6 no-padding">
                    <div class="col-md-3 no-padding">
                        <button type="button" class="btn btn-info"
                                onclick="location.href ='{{action('UsuarioController@edita', $usuario->id)}}'">
                            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Editar
                        </button>
                    </div>
                    <div class="col-md-3 no-padding">
                        <button class="btn btn-danger" type="button" onclick="confirmarExclusao('{{action('UsuarioController@remove', $usuario->id)}}');">
                            <i class="glyphicon glyphicon-trash"></i> Excluir
                        </button>
                    </div>
                    <div class="col-md-3 no-padding">
                        <button class="btn btn-primary" type="button" onclick="location.href = '{{action('LojaController@novo'), $usuario->id}}'">
                            <i class="glyphicon glyphicon-plus"></i> Cadastrar Loja
                        </button>
                    </div>
                    <div class="col-md-1" style="padding-top: 7px; padding-left: 55px">
                        <a href="#" onclick="javascript:history.back(1);">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    @else

        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="form-atualiza-usuario" class="form-horizontal" method="post" action="{{ action('UsuarioController@atualiza') }}">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$usuario->id}}">

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-1 control-label">Nome</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}" required autofocus>
                </div>
            </div>


            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-1 control-label">E-Mail</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                <label for="cpf" class="col-md-1 control-label">CPF</label>

                <div class="col-md-6">
                    <input id="cpf" type="text" class="form-control" name="cpf" value="{{$usuario->cpf }}" required autofocus>
                </div>
            </div>

            <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                <label for="telefone" class="col-md-1 control-label">Telefone</label>

                <div class="col-md-6">
                    <input id="telefone" type="text" class="form-control" name="telefone" value="{{ $usuario->telefone }}" required autofocus>
                </div>
            </div>

            @if(Auth::user()->perfil_id==1)
                <div class="form-group{{ $errors->has('perfil_id') ? ' has-error' : '' }}">
                    <label for="perfil-id" class="col-md-1 control-label">Perfil</label>
                    <div class="col-md-6">
                        <select name="perfil_id" class="form-control">
                            <option @if($usuario->perfil_id==1) {{'selected="selected"'}} @endif value="1">Administrador</option>
                            <option @if($usuario->perfil_id==2) {{'selected="selected"'}} @endif value="2">Cliente</option>
                            <option @if($usuario->perfil_id==3) {{'selected="selected"'}} @endif value="3">Propriet&aacute;rio</option>
                        </select>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <div class="col-md-2 col-md-offset-1">
                    <div class="col-md-6 no-padding">
                        <button type="submit" class="btn btn-primary">
                            Atualizar
                        </button>
                    </div>
                    <div class="col-md-6" style="padding-top: 7px">
                        <a href="#" onclick="javascript:history.back(1);">Voltar</a>
                    </div>
                </div>
            </div>
        </form>
    @endif

@endsection
