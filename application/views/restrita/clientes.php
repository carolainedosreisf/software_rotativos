
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
    <div class="callout callout-default">
        <div class="row form-group">
            <div class="col-sm-4">
                <label for="situacao_pagamento">Situação Pagamento</label>
                <select name="situacao_pagamento" id="situacao_pagamento" class="form-control" ng-model="situacao_pagamento">
                    <option value="">Todas</option>
                    <option value="1">Dentro do Período Experimental</option>
                    <option value="2">Em dia</option>
                    <option value="3">Período Experimental Expirado</option>
                    <option value="4">Último pagamento Vencido</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="situacao_software">Situação Software</label>
                <select name="situacao" id="situacao_software" class="form-control" ng-model="situacao_software">
                    <option value="">Todas</option>
                    <option value="B">Bloqueado</option>
                    <option value="L">Liberado</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="">&nbsp;</label>
                <button class="btn btn-primary form-control" ng-click="getClientes()">
                    <i class="glyphicon glyphicon-search"></i> Filtrar
                </button>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-sm-4"></div>
        <div class="col-sm-4"></div>
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
                        <td class="text-center" width="10%">Situação Software</td>
                        <td class="text-center">Estacionamentos</td>
                        <td class="text-center">Mensalidades</td>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_clientes | filter:filtrar ).length <=0">
                        <td class="text-center" colspan="7">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_clientes| filter:filtrar | itemsPerPage:20">
                        <td>
                            {{l.Nome}} <br>
                            <button class="btn btn-xs btn-default cursor-auto">
                                {{l.DescSituacao}}
                            </button>
                        </td>
                        <td>{{l.CpfCnpjFormatado}}</td>
                        <td class="text-center">{{l.TipoEmpresa=='J'?'Jurídica':'Física'}}</td>
                        <td class="text-center">{{l.DataCadastroBr}}</td>
                        <td class="text-center">
                            <button 
                                ng-click="openBaixaPagamento(l)"
                                class="btn btn-sm"
                                ng-class="l.Situacao>2?'btn-warning':'btn-success'"
                                data-html="true" 
                                data-toggle="tooltip" 
                                data-placement="left"
                                data-original-title="Cliente aqui para efetuar a baixa do pagamento mensal da empresa {{l.Nome}}."
                                tooltip>
                                <b>{{l.Situacao>2?'Bloqueado':'Liberado'}}</b>
                            </button>
                        </td>
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
                                    <th class="text-center">Data Vencimento</th>
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
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="baixaPagamento" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Efetuar baixa no pagamento mensal empresa: {{objEmpresa.Nome}}</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert {{objEmpresaPagamento.alert}}" role="alert">
                                <span ng-bind-html="objEmpresaPagamento.DescSituacao"></span>
                            </div>
                        </div>
                    </div>
                    <form name="form_baixa_pagamento" id="form_baixa_pagamento" ng-submit="setPagamento()" novalidate autocomplete="off">
                        <div class="row form-group">
                            <div class="col-sm-9"  ng-class="form_baixa_pagamento.FormaPagamentoId.$invalid && (form_baixa_pagamento.$submitted || form_baixa_pagamento.FormaPagamentoId.$dirty)?'has-error':''">
                                <label for="FormaPagamentoId">Forma de Pagamento:</label>
                                <select class="form-control" name="FormaPagamentoId" id="FormaPagamentoId" ng-model="objEmpresaPagamento.FormaPagamentoId" ng-required="true">
                                    <option value="">Selecione</option>
                                    <option value="{{l.FormaPagamentoId}}" ng-repeat="l in lista_formas_pagamento">{{l.Descricao}}</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="DataPagamento">Valor:</label>
                                <input type="text" class="form-control" name="DataPagamento" id="DataPagamento" value="<?='R$'.number_format(VALOR_SOFTWARE,2,",",".")?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="DataPagamento">Data Pagamento:</label>
                                <input type="text" class="form-control" name="DataPagamento" id="DataPagamento" ng-value="objEmpresaPagamento.AgoraBr" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="DataPagamento">Próximo Vencimento:</label>
                                <input type="text" class="form-control" name="DataPagamento" id="DataPagamento" ng-value="objEmpresaPagamento.ProxVencimentoBr" readonly>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="form_baixa_pagamento" class="btn btn-success">Efetuar baixa no pagamento</button>
                </div>
            </div>
        </div>
    </div>
</div>

         
