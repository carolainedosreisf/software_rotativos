
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button type="button" ng-click="openModalCad()" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Nova
            </button>
        </div>
    </div>

    <h2>Formas de Pagamento</h2><br>

    <div class="row form-group">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Pesquisar..." ng-model="filtrar">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="10%">#</th>
                        <th>Descrição</th>
                        <th class="text-center" width="10%">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_formas_pagamento | filter:filtrar ).length <=0">
                        <td class="text-center" colspan="3">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_formas_pagamento" dir-paginate="l in lista_formas_pagamento| filter:filtrar | itemsPerPage:20">
                        <td class="text-center">{{l.FormaPagamentoId}}</td>
                        <td>{{l.Descricao}}</td>
                        <td class="text-center">
                            <button ng-click="openModalCad(l)" class="btn btn-primary btn-sm">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="pull-right">
                <dir-pagination-controls 
                    max-size="7" 
                    direction-links="true" 
                    boundary-links="true" 
                    pagination-id="pg_formas_pagamento">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>
    <div id="cadFormaPagamento" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{txt_modal}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-group" ng-show="form_forma_pagamento.$invalid && form_forma_pagamento.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>
                    <form name="form_forma_pagamento" id="form_forma_pagamento" novalidate ng-submit="setFormaPagamento()">
                        <div class="row form-group" ng-show="cad.FormaPagamentoId">
                            <div class="col-sm-3">
                                <label for="FormaPagamentoId">Código:</label>
                                <input type="text" class="form-control" name="FormaPagamentoId" id="FormaPagamentoId" autocomplete="off" ng-model="cad.FormaPagamentoId" ng-disabled="true">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_forma_pagamento.Descricao.$invalid && (form_forma_pagamento.$submitted || form_forma_pagamento.Descricao.$dirty)?'has-error':''">
                                <label for="Descricao">Descrição:</label>
                                <input type="text" name="Descricao" autocomplete="of" class="form-control" maxlength="50" ng-model="cad.Descricao" ng-required="true">
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="form_forma_pagamento" class="btn btn-success" ng-disabled="form_promocao.$invalid">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>

         
