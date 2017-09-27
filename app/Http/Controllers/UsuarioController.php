<?php

namespace sldb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use sldb\Http\Requests\UsuarioRequest;
use sldb\Models\User;
use sldb\Services\UsuarioService;
use sldb\Services\ProdutoService;

class UsuarioController extends Controller
{

    private $usuarioService;
    private $produtoService;
    private $pageId = 'lista-usuarios';

    /**
     * Construtor padrao da classe
     * Realiza a injeção das dependencias necessarias para utilizacao da classe
     *
     * UsuarioController constructor.
     * @param UsuarioService $usuarioService
     */
    public function __construct(UsuarioService $usuarioService, ProdutoService $produtoService)
    {
        $this->middleware('auth');
        $this->usuarioService = $usuarioService;
        $this->produtoService = $produtoService;
    }

    public function lista()
    {

        $qtdItens = Request::input('qtdItens', 10); //se o parametro nao for informado, exibe 10 como padrao
        $textoPesquisa = Request::input('textoPesquisa');
        $totalDeRegistros = User::all()->count();

        $usuarios = $this->usuarioService->lista($qtdItens, $textoPesquisa);

        return view('painel.usuario.lista')
            ->withUsuarios($usuarios)
            ->with('qtdItens', $qtdItens)
            ->with('totalDeRegistros', $totalDeRegistros)
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

        if(Auth::user()->perfil_id==1) {
            return redirect()->action('UsuarioController@lista');
        } else {
            return redirect()->action('SiteController@painel');
        }

    }

    public function remove($id)
    {

        $this->usuarioService->remove($id);

        Session::flash('flash_message', 'Usuario removido com suceso!');

        return redirect()->action('UsuarioController@lista');
    }

    public function listaCompras($id)
    {
        $qtdItens = Request::input('qtdItens', 10); //se o parametro nao for informado, exibe 10 como padrao
        $compras = $this->usuarioService->listaCompras($id);

        return view('painel.usuario.compras')
            ->withCompras($compras)
            ->with('totalDeRegistros', count($compras))
            ->with('qtdItens', $qtdItens);
    }

    public function mostraDetalhesCompra($compraId)
    {

        $compra = $this->usuarioService->buscaCompra($compraId);
        $enderecoEntrega = $compra->enderecoEntrega;
        $itemsCompra = $compra->itensCompra;
        $produtos = [];
        $i=0;

        foreach($itemsCompra as $item)
        {
            $produtos[$i] = $this->produtoService->buscaPorNome($item->nome_produto);
            $i++;
        }

        return view('painel.usuario.detalhes-compra')
            ->withCompra($compra)
            ->withProdutos($produtos)
            ->with('enderecoEntrega', $enderecoEntrega)
            ->with('itemsCompra', $itemsCompra);

    }
}
