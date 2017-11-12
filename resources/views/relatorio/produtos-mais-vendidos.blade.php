@extends('template.painel')

@section('heading')

    <strong>Relat&oacute;rio de Produtos Mais Vendidos</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    <h3>Informe os filtros que deseja utilizar:</h3>
    <div class="col-sm-12">
        <form action="{{action('RelatorioController@produtosMaisVendidos')}}" method="post">
            {{csrf_field()}}
            <div class="input-group-sm date col-sm-2">
                <label for="dataIni">Data Inicial</label>
                <input type="text" class="form-control" name="dataIni" id="dataIni" required>
            </div>
            <div class="form-group-sm col-sm-2">
                <label for="dataFim">Data Final</label>
                <input type="text" class="form-control" name="dataFim" id="dataFim" required>
            </div>
            <div class="form-group-sm col-sm-2">
                <label for="lojaId">Loja</label>
                <select name="lojaId" id="lojaId" class="form-control" required>
                    <option value="">-- Selecione --</option>
                    @foreach($lojas as $loja)
                        <option value="{{$loja->id}}">{{$loja->nome_fantasia}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit"
                        class="btn btn-primary btn-sm"
                        style="margin-top: 25px">
                    Gerar Relat&oacute;rio
                </button>
            </div>
        </form>
    </div>

    <div class="col-sm-12" style="margin-top:80px; display: {{$display}}">
        @if(empty($produtos))
            <div class="alert alert-danger">
                N&atilde;o houve resultado para os filtros utilizados.
            </div>
        @else
            @if($lojaSelecionada)
                <h4 class="text-info">Exibindo resultados para o periodo de <span class="text-danger">{{$dataIni}}</span> a <span class="text-danger">{{$dataFim}}</span>, da loja <span class="text-danger">{{$lojaSelecionada->nome_fantasia}}</span>.</h4>
            @else
                <h4 class="text-info">Exibindo resultados para o periodo de <span class="text-danger">{{$dataIni}}</span> a <span class="text-danger">{{$dataFim}}</span></h4>
            @endif
            <table class="table table-striped table-hover">
                <tr style="background-color: #2e353d; color: whitesmoke">
                    <th>Nome Produto</th>
                    <th>Quantidade de Vendas</th>
                    <th>Valor Total das Vendas</th>
                </tr>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->nome_produto }} </td>
                        <td>{{$produto->total }} </td>
                        <td class="text-success"><strong>R$ {{$produto->valor_total_vendas }}</strong></td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

@endsection
