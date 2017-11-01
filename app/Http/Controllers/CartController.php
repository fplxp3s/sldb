<?php

namespace sldb\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use sldb\Models\EnderecoEntrega;
use sldb\Models\ItemCompra;
use sldb\Services\ProdutoService;
use sldb\Services\EnderecoService;

class CartController extends Controller
{

    private $produtoService;
    private $enderecoService;

    public function __construct(ProdutoService $produtoService, EnderecoService $enderecoService)
    {
        $this->middleware('auth');
        $this->produtoService = $produtoService;
        $this->enderecoService = $enderecoService;
    }

    public function insereProdutoCarrinho()
    {
        $produtoCarrinho = Request::except('_token');
        Cart::add($produtoCarrinho);
    }

    public function removeProdutoCarrinho($idProduto)
    {
        Cart::remove($idProduto);
    }

    public function esvaziaCarrinho()
    {
        Cart::destroy();
    }

    public function checkoutCarrinho()
    {

        $produtos = $this->getProdutosCarrinho();

        return view('checkout')->with('produtos', $produtos);
    }

    public function atualizaValoresCarrinho($idProduto, $qtd)
    {
        Cart::update($idProduto, $qtd);
    }

    public function calculaFrete($cep)
    {

        $pac = rand(10,30);
        $sedex = rand(35, 70);
        $subtotal = Cart::subtotal();
        $subtotal = str_replace(',','', $subtotal);

        $totalPac = $subtotal + $pac;
        $totalSedex = $subtotal + $sedex;

        //chamar webservice dos correios para calcular o frete PAC e SEDEX ou gerar valores randomicos para cada chamada
        $frete = ['PAC' => $pac, 'SEDEX' => $sedex, 'totalPac' => $totalPac, 'totalSedex' => $totalSedex];
        return $frete;
    }

    public function finalizarCompra()
    {

        $usuario = Auth::user();
        $produtos = $this->getProdutosCarrinho();
        $dadosCompra = Request::all();
        $enderecoEntrega = null;
        $estados = $this->enderecoService->listaEstados();

        if(isset($dadosCompra['retirarLoja']) && $dadosCompra['retirarLoja']!="on") {
            $enderecoEntrega = $this->enderecoService->buscaEnderecoEntrega($usuario->id);
        } else if(!isset($dadosCompra['retirarLoja'])) {
            $dadosCompra['retirarLoja'] = 'off';
        }

        return view('finalizar-compra')
            ->with('usuario', $usuario)
            ->with('produtos', $produtos)
            ->with('dadosCompra', $dadosCompra)
            ->with('estados', $estados==null ? [] : $estados)
            ->with('enderecoEntrega', $enderecoEntrega==null ? new EnderecoEntrega() : $enderecoEntrega);
    }

    public function salvaEnderecoEntrega()
    {
        $enderecoEntrega = Request::except('_token');
        $this->enderecoService->salvaEnderecoEntrega($enderecoEntrega);
    }

    /*
     *
     * RODAR MIGRATIONS E TESTAR NOVAMENTE
     *
     * */
    public function salvaPagamento()
    {
        $dadosCompra = Request::except('_token');
        $dadosCompra['user_id'] = Auth::id();
        $dadosCompra['data'] = date('Y-m-d H:i:s');

        if($dadosCompra['retirar_loja']=='off') {
            $dadosCompra['endereco_entrega_id'] = $this->enderecoService->buscaEnderecoEntrega(Auth::id())->id;
            $dadosCompra['retirar_loja'] = 'N';
        } else {
            $dadosCompra['retirar_loja'] = 'S';
            $dadosCompra['endereco_entrega_id'] = null;
        }

        $compra = $this->produtoService->salvaCompra($dadosCompra);

        $produtosCarrinho = Cart::content();

        foreach ($produtosCarrinho as $produto) {

            $itemCompra = new ItemCompra();
            $itemCompra->compra_id = $compra->id;
            $itemCompra->produto_id = $produto->id;
            $itemCompra->nome_produto = $produto->name;
            $itemCompra->valor_produto = $produto->price;
            $itemCompra->quantidade = $produto->qty;

            $itemCompra->create($itemCompra->attributesToArray());

            $produtoBanco = $this->produtoService->buscaPorId($produto->id);
            $produtoBanco->quantidade -= $produto->qty;
            $this->produtoService->atualiza($produto->id, $produtoBanco->attributesToArray());
        }

        Cart::destroy();

        return 'ok';

    }

    public function compraFinalizada()
    {
        return view('compra-finalizada');
    }

    /**
     * @return array
     */
    public function getProdutosCarrinho()
    {
        $produtosCarrinho = Cart::content();
        $produtos = [];
        $i = 0;

        foreach ($produtosCarrinho as $produto) {
            $produtos[$i] = $this->produtoService->buscaPorNome($produto->name);
            $i++;
        }
        return $produtos;
    }

}
