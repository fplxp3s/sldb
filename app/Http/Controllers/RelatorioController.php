<?php

namespace sldb\Http\Controllers;

use Illuminate\Support\Facades\Request;
use sldb\Services\RelatorioService;

class RelatorioController extends Controller
{

    private $relatorioService;

    public function __construct(RelatorioService $relatorioService)
    {
        $this->relatorioService = $relatorioService;
    }

    public function usuariosCadastrados()
    {
        $usuarios = $this->relatorioService->geraRelatorioUsuariosCadastrados();
        return view('relatorio.usuarios')->withUsuarios($usuarios)->with('totalDeRegistros', $usuarios->count());
    }

    public function lojistasCadastrados()
    {
        $lojas = $this->relatorioService->geraRelatorioLojasCadastradas();
        return view('relatorio.lojistas')->withLojas($lojas)->with('totalDeRegistros', $lojas->count());
    }

    public function produtosCadastrados()
    {
        $produtos = $this->relatorioService->geraRelatorioProdutosCadastrados();
        return view('relatorio.produtos')->withProdutos($produtos)->with('totalDeRegistros', $produtos->count());
    }

    public function lojasMaisVenderam()
    {
        $parametros = Request::except('_token');
        $lojas = $this->relatorioService->geraRelatorioLojasMaisVenderam($parametros);
        return view('relatorio.lojas-mais-venderam')->withLojas($lojas)->with('totalDeRegistros', sizeof($lojas));
    }

    public function produtosMaisPesquisados()
    {
        $parametros = Request::except('_token');
        $produtos = $this->relatorioService->geraRelatorioProdutosMaisPesquisados($parametros);
        return view('relatorio.produtos-mais-pesquisados')->withProdutos($produtos);
    }

    public function produtosMaisVendidos()
    {
        $parametros = Request::except('_token');
        $produtos = $this->relatorioService->geraRelatorioProdutosMaisVendidos($parametros);
        return view('relatorio.produtos-mais-vendidos')->withProdutos($produtos)->with('totalDeRegistros', sizeof($produtos));
    }
}
