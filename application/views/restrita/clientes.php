
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button type="button" ng-click="openRelatorio()" class="btn btn-primary">
                <i class="glyphicon glyphicon-print"></i>
                Imprimir
            </button>
        </div>
    </div>

    <h2>Clientes</h2><br>

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
                        <td>Nome</td>
                        <td>CPF/CNPJ</td>
                        <td class="text-center">Tipo</td>
                        <td class="text-center">Cadastro</td>
                        <td class="text-center">Estacionamentos</td>
                        <td class="text-center">Mensalidades</td>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_clientes | filter:filtrar ).length <=0">
                        <td class="text-center" colspan="6">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_clientes| filter:filtrar | itemsPerPage:20">
                        <td>{{l.Nome}}</td>
                        <td>{{l.CpfCnpjFormatado}}</td>
                        <td class="text-center">{{l.TipoEmpresa=='J'?'Jurídica':'Física'}}</td>
                        <td class="text-center">{{l.DataCadastroBr}}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-default" ng-click="getEstacionamentos(l)">
                                <span class="glyphicon glyphicon-search"></span>
                                {{l.QtdEstacionamentos}}
                            </button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-default" ng-click="getPagamentos(l)">
                                <span class="glyphicon glyphicon-search"></span>
                                {{l.Valor|currency:'R$ '}} ({{l.QtdMensalidades}})
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

    <div id="modalEstacionamentos" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog" style="width: 60%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Estacionamentos >> {{objEmpresa.Nome}}</h4>
                </div>
                <div class="modal-body">
                    
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Estacionamento</th>
                                    <th>Endereço</th>
                                    <th>Contato</th>
                                    <th>Preço</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-show="(lista_estacionamentos).length <=0">
                                    <td class="text-center" colspan="4">Nenhum resgistro encontrado.</td>
                                </tr>
                                <tr ng-repeat="l in lista_estacionamentos">
                                    <td >
                                        {{l.NomeEstacionamento}}<br>
                                        {{l.CpfCnpjFormatado}}
                                    </td>
                                    <td >
                                        {{l.Endereco}}, N° {{l.NumeroEndereco}} - {{l.BairroEndereco}},<br>{{l.NomeCidade}} - {{l.Estado}}, {{l.NumeroCep}}
                                    </td>
                                    <td >
                                        {{l.NumeroTelefone1Formatado}} <br>
                                        {{l.NumeroTelefone2Formatado}} <br ng-show="l.NumeroTelefone2">
                                        {{l.Email}}
                                    </td>
                                    <td>
                                        <span ng-show="l.PrecoLivre>0">{{l.PrecoLivre|currency:'R$ '}} (Livre)<br></span>
                                        <span ng-show="l.PrecoHora>0">{{l.PrecoHora|currency:'R$ '}} (Hora)</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalPagamentos" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog" style="width: 60%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Mensalidades >> {{objEmpresa.Nome}}</h4>
                </div>
                <div class="modal-body">
                    
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
                                <tr ng-show="(lista_pagamentos).length <=0">
                                    <td class="text-center" colspan="5">Nenhum resgistro encontrado.</td>
                                </tr>
                                <tr ng-repeat="l in lista_pagamentos">
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
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

         
