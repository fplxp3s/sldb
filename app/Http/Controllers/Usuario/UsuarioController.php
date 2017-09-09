<?php

namespace sldb\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use sldb\Http\Requests\UsuarioRequest;
use sldb\Services\UsuarioService;

class UsuarioController extends Controller
{

    private $usuarioService;
    private $pageId = 'lista-usuarios';

    /**
     * Construtor padrao da classe
     * Realiza a injeção das dependencias necessarias para utilizacao da classe
     *
     * UsuarioController constructor.
     * @param UsuarioService $usuarioService
     */
    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function lista()
    {

        $qtdItens = Request::input('qtdItens', 10); //se o parametro nao for informado, exibe 10 como padrao
        $textoPesquisa = Request::input('textoPesquisa');

        $usuarios = $this->usuarioService->lista($qtdItens, $textoPesquisa);

        return view('painel.usuario.lista')
            ->withUsuarios($usuarios)
            ->with('qtdItens', $qtdItens)
            ->with('pageId'  , $this->pageId);
    }

    public function novo()
    {
        return view('painel.usuario.formulario')->with('pageId'  , $this->pageId);
    }

    /**
     * Metodo responsavel por adicionar ou atualizar um usuario na base de dados
     * O objeto UsuarioRequest recebido por parametro realiza as validacoes necessarias do formulario
     *
     * @param UsuarioRequest $request
     * @return $this
     */
    public function adiciona(UsuarioRequest $request)
    {

        $this->usuarioService->adiciona($request);

        Session::flash('flash_message', 'Usuario ' .$request->input('name'). ' criado com suceso!');

        return redirect()->action('UsuarioController@lista');
    }

    public function mostra($id, $edita=null)
    {

        $usuario = $this->usuarioService->buscaPorId($id);

        if(empty($usuario)) {
            return('Usuário inexistente!');
        }

        return view('painel.usuario.detalhes')
            ->with('usuario', $usuario)
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
        $this->usuarioService->atualiza($id, Request::except('_token'));

        Session::flash('flash_message', 'Usuario ' .Request::input('name'). ' atualizado com suceso!');

        return redirect()->action('UsuarioController@lista');
    }

    public function remove($id)
    {

        $this->usuarioService->remove($id);

        Session::flash('flash_message', 'Usuario removido com suceso!');

        return redirect()->action('UsuarioController@lista');
    }
}
