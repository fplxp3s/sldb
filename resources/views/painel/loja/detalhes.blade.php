@extends('template.painel')

@section('heading')
    @if(!$edita)
        <strong>Detalhes da Loja</strong>
    @else
        <strong>Editar Informa&ccedil;&otilde;es da Loja</strong>
    @endif
@endsection

@section('content')

    @if(!$edita)

        <div class="col-md-3 perfil-usuario text-center">
            <i class="fa fa-shopping-cart" style="font-size: 210px"></i>
            <div class="clearfix"></div>
            <h2>{{$loja->razao_social}} </h2>
        </div>
        <div class="col-md-7 col-md-offset-1" style="margin-bottom: 30px">
            <ul class="list-unstyled detalhe-usuario">
                <li>
                    <b>Propriet&aacute;rio:</b> {{$usuario->name}}
                </li>
                <li>
                    <b>Nome Fantasia:</b> {{$loja->nome_fantasia}}
                </li>
                <li>
                    <b>Nome Representante:</b> {{$loja->nome_representante}}
                </li>
                <li>
                    <b>CPF Representante:</b> {{$loja->cpf_representante}}
                </li>
                <li>
                    <b>CNPJ:</b> {{$loja->cnpj}}
                </li>
                <li>
                    <b>Endere&ccedil;o:</b> {{$loja->endereco}}, {{$loja->bairro}}
                </li>
                <li>
                    <b>Cidade:</b> {{$loja->cidade}}
                </li>
                <li>
                    <b>Estado:</b> {{$loja->estado}}
                </li>
                <li>
                    <b>Telefone:</b> {{$loja->telefone}}
                </li>
                @if($loja->telefone2 != '' && $loja->telefone2 != null)
                    <li>
                        <b>Telefone2:</b> {{$loja->telefone2}}
                    </li>
                @endif
            </ul>
            <br>

            <div class="form-group">
                <div class="col-md-6 no-padding">
                    <div class="col-md-3 no-padding">
                        <button type="button" class="btn btn-info"
                                onclick="location.href ='{{action('LojaController@edita', $loja->id)}}'">
                            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Editar
                        </button>
                    </div>
                    <div class="col-md-3 no-padding">
                        <button class="btn btn-danger" type="button" onclick="confirmarExclusao('{{action('LojaController@remove', $loja->id)}}');">
                            <i class="glyphicon glyphicon-trash"></i> Excluir
                        </button>
                    </div>
                    <div class="col-md-3 no-padding">
                        <button type="button" class="btn btn-success"
                                onclick="location.href ='{{action('ProdutoController@lista', ['loja_id' => $loja->id])}}'">
                            <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Ver Produtos
                        </button>
                    </div>
                    <div class="col-md-1" style="padding-top: 7px; padding-left: 50px;">
                        <a href="#" onclick="javascript:history.back(1);">Voltar</a>
                    </div>
                </div>
            </div>

        </div>
    @else

        <form id="form-atualiza-loja" class="form-horizontal" method="post" action="{{ action('LojaController@atualiza') }}">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->getAuthIdentifier()}}">
            <input type="hidden" name="id" value="{{$loja->id}}">

            <div class="form-group{{ $errors->has('razao_social') ? ' has-error' : '' }}">
                <label for="razao_social" class="col-md-2 control-label">Raz&atilde;o Social</label>

                <div class="col-md-6">
                    <input id="razao_social" type="text" class="form-control" name="razao_social" value="{{ $loja->razao_social }}" required autofocus>

                    @if ($errors->has('razao_social'))
                        <span class="help-block"><strong>{{ $errors->first('razao_social') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('nome_fantasia') ? ' has-error' : '' }}">
                <label for="nome_fantasia" class="col-md-2 control-label">Nome Fantasia</label>

                <div class="col-md-6">
                    <input id="nome_fantasia" type="text" class="form-control" name="nome_fantasia" value="{{ $loja->nome_fantasia }}" required>

                    @if ($errors->has('nome_fantasia'))
                        <span class="help-block"><strong>{{ $errors->first('nome_fantasia') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('nome_representante') ? ' has-error' : '' }}">
                <label for="nome_representante" class="col-md-2 control-label">Nome Representante</label>

                <div class="col-md-6">
                    <input id="nome_representante" type="text" class="form-control" name="nome_representante" value="{{ $loja->nome_representante }}" required>

                    @if ($errors->has('nome_representante'))
                        <span class="help-block"><strong>{{ $errors->first('nome_representante') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('cpf_representante') ? ' has-error' : '' }}">
                <label for="cpf_representante" class="col-md-2 control-label">CPF Representante</label>

                <div class="col-md-6">
                    <input id="cpf_representante" type="text" class="form-control" name="cpf_representante" value="{{ $loja->cpf_representante }}" required>

                    @if ($errors->has('cpf_representante'))
                        <span class="help-block"><strong>{{ $errors->first('cpf_representante') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
                <label for="cnpj" class="col-md-2 control-label">CNPJ</label>

                <div class="col-md-6">
                    <input id="cnpj" type="text" class="form-control" name="cnpj" value="{{ $loja->cnpj }}" required>

                    @if ($errors->has('cnpj'))
                        <span class="help-block"><strong>{{ $errors->first('cnpj') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                <label for="endereco" class="col-md-2 control-label">Endere&ccedil;o</label>

                <div class="col-md-6">
                    <input id="endereco" type="text" class="form-control" name="endereco" value="{{ $loja->endereco }}" required>

                    @if ($errors->has('endereco'))
                        <span class="help-block"><strong>{{ $errors->first('endereco') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                <label for="bairro" class="col-md-2 control-label">Bairro</label>

                <div class="col-md-6">
                    <input id="bairro" type="text" class="form-control" name="bairro" value="{{ $loja->bairro }}" required>

                    @if ($errors->has('bairro'))
                        <span class="help-block"><strong>{{ $errors->first('bairro') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                <label for="cidade" class="col-md-2 control-label">Cidade</label>

                <div class="col-md-6">
                    <input id="cidade" type="text" class="form-control" name="cidade" value="{{ $loja->cidade }}" required>

                    @if ($errors->has('cidade'))
                        <span class="help-block"><strong>{{ $errors->first('cidade') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                <label for="estado" class="col-md-2 control-label">Estado</label>

                <div class="col-md-6">

                    <select name="estado" class="form-control">
                        {{--Recuperar os dados da tabela de estados ou inserir hardcode--}}
                        @foreach($estados as $estado)
                            <option @if($loja->estado==$estado->sigla) {{'selected="selected"'}} @endif value="{{$estado->sigla}}">{{$estado->descricao}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('estado'))
                        <span class="help-block"><strong>{{ $errors->first('estado') }}</strong></span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                <label for="telefone" class="col-md-2 control-label">Telefone</label>

                <div class="col-md-6">
                    <input id="telefone" type="text" class="form-control" name="telefone" value="{{ $loja->telefone }}" required>

                    @if ($errors->has('telefone'))
                        <span class="help-block"><strong>{{ $errors->first('telefone') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('telefone2') ? ' has-error' : '' }}">
                <label for="telefone2" class="col-md-2 control-label">Telefone 2</label>

                <div class="col-md-6">
                    <input id="telefone2" type="text" class="form-control" name="telefone2" value="{{ $loja->telefone2 }}">

                    @if ($errors->has('telefone2'))
                        <span class="help-block"><strong>{{ $errors->first('telefone2') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 col-md-offset-2">
                    <div class="col-md-6 no-padding">
                        <button type="submit" class="btn btn-primary">
                            Enviar
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
