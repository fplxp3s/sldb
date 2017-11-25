@extends('template.painel')

@section('heading')
    <strong>Relat&oacute;rio de Lojas Com Maior N&uacute;mero de Vendas</strong>
@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif

    <h3>Informe os filtros que deseja utilizar:</h3>
    <div class="col-sm-12" style="margin-bottom: 50px">
        <form>
            {{csrf_field()}}
            <div class="input-group-sm date col-sm-2">
                <label for="dataIni">Data Inicial</label>
                <input type="text" class="form-control" name="dataIni" id="dataIni" required>
            </div>
            <div class="form-group-sm col-sm-2">
                <label for="dataFim">Data Final</label>
                <input type="text" class="form-control" name="dataFim" id="dataFim" required>
            </div>
            <div>
                <button type="button"
                        class="btn btn-primary btn-sm"
                        style="margin-top: 25px"
                        onclick="geraRelatorioLojasMaisVenderam('{{action('RelatorioController@lojasMaisVenderam')}}', '{{csrf_token()}}')">
                    Gerar Relat&oacute;rio
                </button>
            </div>
        </form>
    </div>

    <div id="relatorioLojasMaisVendasList" style="display: {{$display}}; margin-bottom: 30px">
        <table class="table table-striped table-condensed">
            <thead>
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>ID</th>
                <th>Loja</th>
                <th>Valor Total de Vendas</th>
                <th>% Comiss&atilde;o Site</th>
            </tr>
            </thead>
            <tbody id="listaLojaMaisVendas">

            </tbody>
        </table>
    </div>
    <div id="relatorioLojasMaisVendas" class="col-sm-12" style="margin-top:80px;display: {{$display}}">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>

@endsection
