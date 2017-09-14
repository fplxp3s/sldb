<?php

namespace sldb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use sldb\Http\Requests\LojaRequest;
use sldb\Models\Loja;
use sldb\Models\User;
use sldb\Services\LojaService;
use sldb\Services\EnderecoService;
use sldb\Services\UsuarioService;

class LojaController extends Controller
{

    private $pageId = 'lojas';
    private $lojaService;
    private $enderecoService;
    private $usuarioService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LojaService $lojaService, EnderecoService $enderecoService, UsuarioService $usuarioService)
    {
        $this->middleware('auth');
        $this->lojaService = $lojaService;
        $this->enderecoService = $enderecoService;
        $this->usuarioService = $usuarioService;
    }

    public function lista()
    {

        $qtdItens = Request::input('qtdItens', 10); //se o parametro nao for informado, exibe 10 como padrao
        $textoPesquisa = Request::input('textoPesquisa');
        $totalDeRegistros = Loja::all()->count();

        $lojas = $this->lojaService->lista($qtdItens, $textoPesquisa);

        return view('painel.loja.lista')
            ->withLojas($lojas)
            ->with('qtdItens', $qtdItens)
            ->with('totalDeRegistros', $totalDeRegistros)
            ->with('pageId'  , $this->pageId);

    }

    public function novo()
    {

        $estados = $this->enderecoService->listaEstados();

        return view('painel.loja.formulario')->withEstados($estados)->with('pageId'  , $this->pageId);
    }

    /**
     * Metodo responsavel por adicionar ou atualizar um usuario na base de dados
     * O objeto UsuarioRequest recebido por parametro realiza as validacoes necessarias do formulario
     *
     * @param UsuarioRequest $request
     * @return $this
     */
    public function adiciona(LojaRequest $request)
    {

        $this->lojaService->adiciona($request->all());

        $usuarioLogado = $this->usuarioService->buscaPorId(Auth::user()->getAuthIdentifier());

        if($usuarioLogado->perfil_id == 2) { //se for cliente
            $usuarioLogado->perfil_id = 3; //vira proprietario
            $this->usuarioService->atualiza($usuarioLogado->id, $usuarioLogado->toArray());
        }

        Session::flash('flash_message', 'Loja ' .$request->input('nome_fantasia'). ' cadastrada com suceso!');

        return redirect()->action('LojaController@lista');
    }

    public function mostra($id, $edita=null)
    {

        $loja = $this->lojaService->buscaPorId($id);
        $usuario = $this->usuarioService->buscaPorId($loja->user_id);
        $estados = $this->enderecoService->listaEstados();

        return view('painel.loja.detalhes')
            ->with('loja', $loja)
            ->with('usuario', $usuario)
            ->with('estados', $estados)
            ->with('edita', $edita)
            ->with('pageId'  , $this->pageId);
    }

    public function edita($id)
    {
        return $this->mostra($id, true);
    }

    public function atualiza()
    {

        $id = Request::input('id');
        $this->lojaService->atualiza($id, Request::except('_token'));

        Session::flash('flash_message', 'Loja ' .Request::input('nome_fantasia'). ' atualizada com suceso!');

        return redirect()->action('LojaController@lista');
    }

    public function remove($id)
    {

        $this->lojaService->remove($id);

        Session::flash('flash_message', 'Loja removida com suceso!');

        return redirect()->action('LojaController@lista');
    }


}
