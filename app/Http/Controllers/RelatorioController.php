<?php

namespace sldb\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use sldb\Services\LojaService;
use sldb\Services\RelatorioService;

class RelatorioController extends Controller
{

    private $relatorioService;
    private $lojaService;

    public function __construct(RelatorioService $relatorioService, LojaService $lojaService)
    {
        $this->relatorioService = $relatorioService;
        $this->lojaService = $lojaService;
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

    public function produtosMaisVendidosView()
    {

        if(Auth::user()->perfil_id==3) {
            $lojas = $this->lojaService->listaPorId(100, Auth::id());
        }

        return view('relatorio.produtos-mais-vendidos')
            ->with('lojas', sizeof($lojas)>0?$lojas:[])
            ->with('display', 'none');
    }

    public function produtosMaisVendidos()
    {
        $parametros = Request::except('_token');
        $parametros['dataIni'] = $this->convertDateToSqlFormat($parametros['dataIni']);
        $parametros['dataFim'] = $this->convertDateToSqlFormat($parametros['dataFim']);

        if(Auth::user()->perfil_id==3) {
            $produtos = $this->relatorioService->geraRelatorioProdutosMaisVendidosPorLoja($parametros);
            $lojas = $this->lojaService->listaPorId(100, Auth::id());
        } else {
            $produtos = $this->relatorioService->geraRelatorioProdutosMaisVendidosGeral($parametros);
        }

        foreach ($produtos as $produto) {
            $produto->valor_total_vendas = ($produto->valor_produto * $produto->total);
        }

        return view('relatorio.produtos-mais-vendidos')
            ->withProdutos($produtos)
            ->withLojas($lojas)
            ->with('dataIni', Request::input('dataIni'))
            ->with('dataFim', Request::input('dataFim'))
            ->with('lojaSelecionada', $this->lojaService->buscaPorId(Request::input('lojaId')))
            ->with('display', 'block');
    }

    private function convertDateToSqlFormat($date) {

        $dataFormatada = explode("/", $date);
        $year = $dataFormatada[2];
        $month = $dataFormatada[1];
        $day = $dataFormatada[0];

        return Carbon::createFromDate($year, $month, $day);
    }
}
