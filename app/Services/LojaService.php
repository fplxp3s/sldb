<?php
/**
 * Created by PhpStorm.
 * User: Vitor
 * Date: 30/08/2017
 * Time: 10:17
 */

namespace sldb\Services;

use sldb\Models\Loja;

class LojaService extends Service
{

    public function listaTodos() {
        return Loja::all();
    }

    public function lista($qtdItens, $textoPesquisa=null)
    {
        return Loja::where('name', 'like', '%'.$textoPesquisa.'%')->paginate($qtdItens);
    }

    public function atualiza($id, $request)
    {
        Loja::where('id', $id)->update($request);
    }

    public function adiciona($request)
    {
        Loja::create($request);
    }

    public function buscaPorId($id)
    {
        return Loja::find($id);
    }

    public function remove($id)
    {
        Loja::where('id', $id)->delete($id);
    }
}