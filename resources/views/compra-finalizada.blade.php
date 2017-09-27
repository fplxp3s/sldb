@extends('template.site')

@section('content')

    <div class="container">
        <div style="padding: 15px;">
            <div class="col-md-12">
                <div class="text-center">
                    <i class="glyphicon glyphicon-ok-circle text-success" style="font-size: 120px"></i>
                    <h1 class="text-success">Sua Compra foi realizada com Sucesso!</h1>
                    <h3>Obrigado pela sua compra. ;)<br>
                        Para ver os detalhes do seu pedido basta acessar seu painel de controle e navegar at&eacute; <strong class="text-danger">"Meus Pedidos"</strong></h3>
                    <button class="btn btn-preco" onclick="window.location.href='/'" style="margin-top: 150px"> Continuar Comprando </button>
                </div>
            </div>

        </div>
    </div>

@endsection

