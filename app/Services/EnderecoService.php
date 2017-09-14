<?php

namespace sldb\Services;

use sldb\Models\Estado;

class EnderecoService extends Service
{

    public function listaEstados() {
        return Estado::all();
    }

}