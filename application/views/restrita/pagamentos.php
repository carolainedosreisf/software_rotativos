
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
                    Para realizar o pagamento entre em contato com a setor financeiro da empresa do software.
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
                        <th class="text-center">Data Vencimento</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_pagamentos | filter:filtrar ).length <=0">
                        <td class="text-center" colspan="6">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_pagamentos| filter:filtrar | itemsPerPage:20">
                        <td class="text-center">{{$index+1}}</td>
                        <td class="text-center">{{l.Valor|currency:'R$ '}}</td>
                        <td>
                            {{l.FormaPagamentoDesc}}
                            <span ng-show="l.FormaPagamentoId==5">({{l.TipoCartao=='P'?'PIX':(TipoCartao=='C'?'Cartão de Crédito':'Cartão de Débito')}})</span>
                        </td>
                        <td class="text-center">{{l.DataPagamento}}</td>
                        <td class="text-center">{{l.DataVencimento}}</td>
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
</div>

         
