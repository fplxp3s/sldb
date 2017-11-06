@extends('template.site')

@section('content')
    <div class="container">
        <div class="col-sm-12">

            <div class="col-sm-12">
                <img src="{{asset('images/trabalhe-conosco.png')}}" alt="trabalhe conosco" style="width: inherit">
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-12 text-center" style="margin-top: 50px">

                <h3>Como Participar?</h3>

                <div class="col-sm-4">
                    <img src="{{asset('images/quadrado_cadastro.png')}}">
                </div>
                <div class="col-sm-4">
                    <img src="{{asset('images/quadrado_aprovacao.png')}}">
                </div>
                <div class="col-sm-4">
                    <img src="{{asset('images/quadrado_produtos.png')}}">
                </div>
            </div>

            <div class="col-sm-12 text-center" style="margin-top: 50px;">

                <h3>Pronto para vender muito?</h3>

                <div class="col-sm-4 col-sm-offset-4" style="padding: 20px; margin-bottom: 10px">
                    <button class="btn btn-preco btn-lg" type="button" onclick="window.location.href='/cadastro-loja'">Comece Agora!!!</button>
                </div>
            </div>

            <div class="col-sm-12 text-center" style="margin-top: 50px; margin-bottom: 50px">

                <h3>Depoimentos:</h3>

                <div class="col-sm-4">
                    <img src="{{asset('images/depoimento.png')}}">
                </div>
                <div class="col-sm-4">
                    <img src="{{asset('images/depoimento-1.png')}}">
                </div>
                <div class="col-sm-4">
                    <img src="{{asset('images/depoimento-2.png')}}">
                </div>
            </div>

        </div>
    </div>
@endsection

