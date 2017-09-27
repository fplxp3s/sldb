<div id="maioridade-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary">
                <h4 class="modal-title">SLDB</h4>
            </div>

            <div class="modal-body">
                <h3 class="text-info"><strong>Sua idade &eacute; superior a 18 anos?</strong></h3>
                <h4>A venda de bebidas alco&oacute;licas &eacute; proibida para menores de 18 anos.</h4>
            </div>

            <div class="modal-footer">
                <div class="col-md-12">
                    <button type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            aria-label="Close"
                            onclick="sessionStorage.setItem('maioridadeRespondida', true)">
                        SIM
                    </button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='https://www.ambev.com.br/consumo-responsavel/'">
                        N&Atilde;O
                    </button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->