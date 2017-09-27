<?php

namespace sldb\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use sldb\Http\Requests\ProdutoRequest;
use sldb\Models\Foto;
use sldb\Models\Produto;
use sldb\Services\ProdutoService;
use sldb\Services\LojaService;

class ProdutoController extends Controller
{

    private $pageId = 'produtos';
    private $produtoService;
    private $lojaService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProdutoService $produtoService, LojaService $lojaService)
    {
        $this->middleware('auth');
        $this->produtoService = $produtoService;
        $this->lojaService = $lojaService;
    }

    public function lista()
    {
        $qtdItens = Request::input('qtdItens', 10); //se o parametro nao for informado, exibe 10 como padrao
        $textoPesquisa = Request::input('textoPesquisa');
        $loja = $this->lojaService->buscaPorId(Request::input('loja_id'));
        $totalDeRegistros = Produto::where('loja_id', '=', $loja->id)->count();

        $produtos = $this->produtoService->lista($loja->id, $qtdItens, $textoPesquisa);

        return view('painel.produto.lista')
            ->withProdutos($produtos)
            ->with('loja', $loja)
            ->with('qtdItens', $qtdItens)
            ->with('totalDeRegistros', $totalDeRegistros)
            ->with('pageId'  , $this->pageId);
    }

    public function novo()
    {

        $categorias = $this->produtoService->listaCategorias();
        $loja = $this->lojaService->buscaPorId(Request::input('loja_id'));

        return view('painel.produto.formulario')
            ->withCategorias($categorias)
            ->with('loja', $loja)
            ->with('pageId'  , $this->pageId);
    }

    public function adiciona(ProdutoRequest $request)
    {

        /*$nome_arquivo = $request->foto->store('fotos', env('APP_STORAGE_DISK'));*/
        $nome_arquivo = $this->salvaFotoNoDisco($request->foto);
        $foto = Foto::create(['nome_arquivo' => $nome_arquivo]);

        $dadosProduto = $request->all();
        $dadosProduto['foto_id'] = $foto->id;
        $this->produtoService->adiciona($dadosProduto);

        Session::flash('flash_message', 'Produto ' .$request->input('nome'). ' criado com suceso!');

        return redirect()->route('produto.lista', ['loja_id' => $request->input('loja_id')]);
    }

    public function mostra($id, $edita=null)
    {

        $produto = $this->produtoService->buscaPorId($id);
        $categorias = $this->produtoService->listaCategorias();

        return view('painel.produto.detalhes')
            ->with('produto', $produto)
            ->with('categorias', $categorias)
            ->with('edita', $edita)
            ->with('pageId', $this->pageId);
    }

    public function edita($id)
    {
        return $this->mostra($id, true);
    }

    public function atualiza(\Illuminate\Http\Request $request)
    {

        $idProduto = Request::input('id');
        $foto = $request->file('foto');
        $dadosProduto = Request::except('_token', 'foto');

        if($foto==null) {
            $produto = $this->produtoService->buscaPorId($idProduto);
            $dadosProduto['foto_id'] = $produto->foto_id;
        } else {
            /*$nome_arquivo = $foto->store('fotos', env('APP_STORAGE_DISK')); */
            $nome_arquivo = $this->salvaFotoNoDisco($foto);
            $fotoNova = Foto::create(['nome_arquivo' => $nome_arquivo]);
            $dadosProduto['foto_id'] = $fotoNova->id;
        }

        $this->produtoService->atualiza($idProduto, $dadosProduto);

        Session::flash('flash_message', 'Produto ' .Request::input('nome'). ' atualizado com suceso!');

        return redirect()->route('produto.lista', ['loja_id' => Request::input('loja_id')]);
    }

    public function remove($id)
    {

        $produto = $this->produtoService->buscaPorId($id);
        $loja_id = $produto->loja_id;
        $this->produtoService->remove($id);

        Session::flash('flash_message', 'Produto removido com suceso!');

        return redirect()->route('produto.lista', ['loja_id' => $loja_id]);
    }

    public function listaProdutosAprovacao()
    {
        $produtos = $this->produtoService->listaProdutosEmAprovacao();
        $totalDeRegistros = count($produtos);
        return view('painel.produto.lista-aprovacao')->with('produtos', $produtos)->with('totalDeRegistros', $totalDeRegistros);
    }

    public function aprovarProduto($id)
    {
        $this->produtoService->aprovaProduto($id);
        Session::flash('flash_message', 'Produto aprovado com suceso!');

        return redirect()->action('ProdutoController@listaProdutosAprovacao');
    }

    /**
     * @param $foto
     * @return string
     */
    private function salvaFotoNoDisco($foto)
    {
        $nome_arquivo = time() . '.' . $foto->getClientOriginalExtension();
        $storage = Storage::disk(env('APP_STORAGE_DISK'));
        $caminho_arquivo = '/fotos/' . $nome_arquivo;
        $storage->put($caminho_arquivo, file_get_contents($foto), 'public');
        return $nome_arquivo;
    }

}
