<?php

namespace sldb\Services;

use sldb\Models\Loja;

class LojaService extends Service
{

    public function listaTodos() {
        return Loja::all();
    }

    public function lista($qtdItens, $textoPesquisa=null)
    {
        return Loja::where('nome_fantasia', 'like', '%'.$textoPesquisa.'%')
            ->orWhere('razao_social', 'like', '%'.$textoPesquisa.'%')
            ->orWhere('nome_representante', 'like', '%'.$textoPesquisa.'%')
            ->paginate($qtdItens);
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

    public function buscaPorNome($nome)
    {
        return Loja::where('razao_social', '=', $nome)->first();
    }

    public function remove($id)
    {
        Loja::where('id', $id)->delete($id);
    }
}