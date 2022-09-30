
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
        </div>
    </div>

    <h2>Pagamentos do Software</h2><br>

    <div class="row form-group">
        <div class="col-sm-12">
            <div class="alert {{verificacao.alert}}" role="alert">
                <span ng-bind-html="verificacao.DescSituacao"></span>
                <span ng-show="verificacao.Situacao>2">
                    <br><br>
                    Para realizar o pagamento entre em contato com a Empresa do Software ou clique no botão a baixo para realizar o pagamento online.
                    <br>
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalPagamento">Pagar Online</button>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="10%">#</th>
                        <th class="text-center">Valor</th>
                        <th>Forma Pagamento</th>
                        <th class="text-center">Data Pagamento</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_pagamentos | filter:filtrar ).length <=0">
                        <td class="text-center" colspan="5">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_pagamentos| filter:filtrar | itemsPerPage:20">
                        <td class="text-center">{{$index+1}}</td>
                        <td class="text-center">{{l.Valor|currency:'R$ '}}</td>
                        <td>
                            {{l.FormaPagamentoDesc}}
                            <span ng-show="l.FormaPagamentoId==5">({{l.TipoCartao=='P'?'PIX':(TipoCartao=='C'?'Cartão de Crédito':'Cartão de Débito')}})</span>
                        </td>
                        <td class="text-center">{{l.DataPagamento}}</td>
                        <td class="text-center">
                            <button  
                                class="btn btn-xs {{l.ClassBtn}} cursor-auto"
                                tooltip>
                                {{l.StatusDesc}}
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
                    pagination-id="pg_lista">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>

    <div id="modalPagamento" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pagamento Competência {{verificacao.CompetenciaAtual}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row" ng-show="form_pagamento.$invalid && form_pagamento.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>

                    <form name="form_pagamento" id="form_pagamento" novalidate ng-submit="setPagamento()" autocomplete="off">
                    
                        <div class="row form-group">
                            <div class="col-sm-9" ng-class="form_pagamento.TipoCartao.$invalid && (form_pagamento.$submitted || form_pagamento.TipoCartao.$dirty)?'has-error':''">
                                <label for="TipoCartao">Forma de Pagamento:</label>
                                <select class="form-control" name="TipoCartao" id="TipoCartao" ng-model="objPagamento.TipoCartao" ng-required="true">
                                    <option value="">Selecione</option>
                                    <option value="C">Cartão de Crédito</option>
                                    <option value="D">Cartão de Débito</option>
                                    <option value="P">Pix</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="Valor">Valor:</label>
                                <input type="text" name="Valor" id="Valor" ng-value="25|currency:'R$ '" class="form-control" ng-disabled="true">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-9" ng-class="form_pagamento.NumeroCartao.$invalid && (form_pagamento.$submitted || form_pagamento.NumeroCartao.$dirty)?'has-error':''">
                                <label for="NumeroCartao">Número Cartão: </label>
                                <input type="text" class="form-control" id="NumeroCartao" name="NumeroCartao" ng-model="objPagamento.NumeroCartao" ui-mask="9999 9999 9999 9999" ng-required="objPagamento.TipoCartao!='P'">
                            </div>
                            <div class="col-sm-3" ng-class="form_pagamento.CodigoSegurancaoCartao.$invalid && (form_pagamento.$submitted || form_pagamento.CodigoSegurancaoCartao.$dirty)?'has-error':''">
                                <label for="CodigoSegurancaoCartao">CVV: </label>
                                <input type="text" class="form-control" id="CodigoSegurancaoCartao" name="CodigoSegurancaoCartao" ng-model="objPagamento.CodigoSegurancaoCartao" ui-mask="9999" ng-required="objPagamento.TipoCartao!='P'">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-7" ng-class="form_pagamento.NomeCartao.$invalid && (form_pagamento.$submitted || form_pagamento.NomeCartao.$dirty)?'has-error':''">
                                <label for="NomeCartao">Nome Cartão: </label>
                                <input type="text" class="form-control" id="NomeCartao" name="NomeCartao" ng-model="objPagamento.NomeCartao" ng-required="objPagamento.TipoCartao!='P'" maxlength="100">
                            </div>
                            <div class="col-sm-5" ng-class="form_pagamento.DataExpiracaoCartao.$invalid && (form_pagamento.$submitted || form_pagamento.DataExpiracaoCartao.$dirty)?'has-error':''">
                                <label for="DataExpiracaoCartao">Data Expiração:</label>
                                <input type="text" class="form-control" id="DataExpiracaoCartao" name="DataExpiracaoCartao" ng-model="objPagamento.DataExpiracaoCartao" data-provide="datepicker" data-date-format="mm/yyyy" ng-required="objPagamento.TipoCartao!='P'">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" form="form_pagamento" class="btn btn-success">Confirmar Pagar</button>
                </div>
            </div>
        </div>
    </div>
</div>

         
