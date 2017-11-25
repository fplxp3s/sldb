<?php

namespace sldb\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use sldb\Models\Foto;
use sldb\Services\ProdutoService;
use sldb\Services\LojaService;

class SiteController extends Controller
{

    private $produtoService;
    private $lojaService;

    public function __construct(ProdutoService $produtoService, LojaService $lojaService)
    {
        $this->produtoService = $produtoService;
        $this->lojaService = $lojaService;
    }

    public function index()
    {
        $produtos = $this->produtoService->listaRecentes();
        return view('index')->withProdutos($produtos);
    }

    public function carrinho()
    {
        return view('site.cart');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function painel()
    {
        return view('painel.home');
    }

    public function quemSomos()
    {
        return view('quemsomos');
    }

    public function vendaNasSldb()
    {
        return view('venda-na-sldb');
    }

    public function listaProdutosPorCategoria($categoria)
    {
        $produtos = $this->produtoService->listaProdutosPorCategoria($categoria);
        return view('site.resultado-busca')
            ->withProdutos($produtos)
            ->with('textoPesquisa', $categoria);
    }

    public function exibeDetalhesProduto($nome)
    {
        $produto = $this->produtoService->buscaPorNome($nome);
        $loja = $produto->loja;
        $produtosSemelhantes = $this->produtoService->listaProdutosSemelhantes($produto);
        return view('produto')->with('produto', $produto)->with('produtos', $produtosSemelhantes)->with('loja', $loja);
    }

    public function exibeDetalhesLoja($nome)
    {
        $loja = $this->lojaService->buscaPorNome($nome);
        $produtos = $this->produtoService->listaProdutosLoja($loja->id);

        return view('loja')->with('loja', $loja)->with('produtos', $produtos);
    }


    public function pesquisa()
    {
        $parametros = Request::except('_token');
        $produtos = $this->produtoService->pesquisaProdutos($parametros['texto-busca']);

        return view('site.resultado-busca')
            ->withProdutos($produtos)
            ->with('textoPesquisa', $parametros['texto-busca']);
    }

    public function cadastroLoja()
    {
        return view('cadastro-loja');
    }
}
