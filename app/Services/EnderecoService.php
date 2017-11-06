<?php

namespace sldb\Services;

use sldb\Models\Estado;
use sldb\Models\EnderecoEntrega;

class EnderecoService extends Service
{

    public function listaEstados() {
        return Estado::all();
    }

    public function salvaEnderecoEntrega($enderecoEntrega)
    {
        if(isset($enderecoEntrega['id']) && $enderecoEntrega['id'] != null)
            return EnderecoEntrega::where('id', $enderecoEntrega['id'])->update($enderecoEntrega);
        else
            return EnderecoEntrega::create($enderecoEntrega);
    }

    public function buscaEnderecoEntrega($idUsuario)
    {
        return EnderecoEntrega::where('user_id', '=', $idUsuario)->first();
    }

}