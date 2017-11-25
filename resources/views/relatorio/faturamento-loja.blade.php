@extends('template.painel')

@section('heading')

    <strong>Relat&oacute;rio de Faturamento por Loja</strong>

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
        <form action="" method="post">
            {{csrf_field()}}
            <div class="input-group-sm date col-sm-2">
                <label for="dataIni">Data Inicial</label>
                <input type="text" class="form-control" name="dataIni" id="dataIni" required>
            </div>
            <div class="form-group-sm col-sm-2">
                <label for="dataFim">Data Final</label>
                <input type="text" class="form-control" name="dataFim" id="dataFim" required>
            </div>
            @if($loja_id>0)
                <input type="hidden" name="lojaId" id="lojaId" value="{{$loja_id}}">
            @else
                <div class="form-group-sm col-sm-2">
                    <label for="lojaId">Loja</label>
                    <select name="lojaId" id="lojaId" class="form-control" required>
                        <option value="">-- Selecione --</option>
                        @foreach($lojas as $loja)
                            <option value="{{$loja->id}}">{{$loja->nome_fantasia}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div>
                <button type="button"
                        class="btn btn-primary btn-sm"
                        style="margin-top: 25px"
                        onclick="javascript:geraRelatorioFaturamentoLoja('{{action('RelatorioController@faturamentoLoja')}}', '{{csrf_token()}}')">
                    Gerar Relat&oacute;rio
                </button>
            </div>
        </form>
    </div>

    <div class="col-sm-12" style="display: {{$display}}; margin-bottom: 30px" id="relatorioFaturamentoLoja">
        <div class="col-sm-3">
            <table class="table table-striped table-condensed">
                <thead>
                <tr style="background-color: #2e353d; color: whitesmoke">
                    <th>M&ecirc;s</th>
                    <th>Faturamento</th>
                </tr>
                </thead>
                <tbody id="listaFaturamentoLoja">

                </tbody>
            </table>
        </div>
        <div class="col-sm-9">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div>

@endsection
