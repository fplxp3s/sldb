<?php
/**
 * Created by PhpStorm.
 * User: Vitor
 * Date: 30/08/2017
 * Time: 10:17
 */

namespace sldb\Services;

use sldb\Models\Produto;

class ProdutoService extends Service
{

    public function listaTodos() {
        return Produto::all();
    }

    public function lista($qtdItens, $textoPesquisa=null)
    {
        return Produto::where('name', 'like', '%'.$textoPesquisa.'%')->paginate($qtdItens);
    }

    public function atualiza($id, $request)
    {
        Produto::where('id', $id)->update($request);
    }

    public function adiciona($request)
    {
        Produto::create($request);
    }

    public function buscaPorId($id)
    {
        return Produto::find($id);
    }

    public function remove($id)
    {
        Produto::where('id', $id)->delete($id);
    }
}