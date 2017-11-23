<?php
/**
 * Created by PhpStorm.
 * User: vmarques
 * Date: 05/11/17
 * Time: 14:51
 */

namespace sldb\Services;

use Illuminate\Support\Facades\DB;
use sldb\Models\Loja;
use sldb\Models\Produto;
use sldb\Models\User;

class RelatorioService extends Service
{

    public function geraRelatorioUsuariosCadastrados()
    {
        return User::where('perfil_id', '=', 2)->paginate(15);
    }

    public function geraRelatorioLojasCadastradas()
    {
        return Loja::paginate(15);
    }

    public function geraRelatorioProdutosCadastrados()
    {
        return Produto::paginate(15);
    }

    public function geraRelatorioLojasMaisVenderam($parametros)
    {

        $lojas = DB::select('SELECT tl.nome_fantasia, sum(tic.quantidade) as total
                                    FROM tb_item_compra tic
                                    JOIN tb_produto tp ON tic.produto_id = tp.id
                                    JOIN tb_loja tl ON tp.loja_id = tl.id
                                    WHERE tic.created_at BETWEEN :dataIni AND :dataFim
                                    GROUP BY tl.nome_fantasia 
                                    ORDER BY total DESC 
                                    limit 50;' , ['dataIni' => $parametros['dataIni'], 'dataFim' => $parametros['dataFim']]);

        return $lojas;

    }

    public function geraRelatorioProdutosMaisPesquisados($parametros)
    {

        $termosPesquisa = DB::select('SELECT tpp.texto, count(tpp.texto) as total
                                            FROM tb_pesquisa_produto tpp
                                            GROUP BY tpp.texto 
                                            ORDER BY total DESC 
                                            limit 50;');

        return $termosPesquisa;

    }

    public function geraRelatorioProdutosMaisVendidosPorLoja($parametros)
    {

        $produtos = DB::select('SELECT nome_produto, valor_produto, sum(ic.quantidade) as total
                                      FROM tb_item_compra ic
                                      join tb_produto tp ON ic.produto_id = tp.id
                                      join tb_loja tl ON tp.loja_id = tl.id AND tl.id = :lojaId
                                      where ic.created_at BETWEEN :dataIni AND :dataFim
                                      group by nome_produto, valor_produto
                                      ORDER BY total DESC 
                                      limit 50;', ['lojaId' => $parametros['lojaId'], 'dataIni' => $parametros['dataIni'], 'dataFim' => $parametros['dataFim']]);

        return $produtos;

    }

    public function geraRelatorioProdutosMaisVendidosGeral($parametros)
    {

        $produtos = DB::select('SELECT nome_produto, valor_produto, sum(ic.quantidade) as total
                                      FROM tb_item_compra ic 
                                      where ic.created_at BETWEEN :dataIni AND :dataFim
                                      group by nome_produto, valor_produto
                                      ORDER BY total DESC 
                                      limit 50;', ['dataIni' => $parametros['dataIni'], 'dataFim' => $parametros['dataFim']]);

        return $produtos;

    }

}