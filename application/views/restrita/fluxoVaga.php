<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button type="button" ng-click="novoFluxoVaga()" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Novo
            </button>
            <button type="button" ng-click="" class="btn btn-primary">
                <i class="glyphicon glyphicon-print"></i>
                Imprimir
            </button>
        </div>
    </div>

    <h2>Fluxo de Vagas</h2><br>

    <div class="callout callout-default">
        <div class="row form-group">
            <div class="col-sm-6">
                <label for="EstacionamentoId">Estacionamento:</label>
                <select class="form-control" name="EstacionamentoId" id="EstacionamentoId" ng-model="filtros.EstacionamentoId">
                    <option value="" style="display:none;"></option>
                    <option value="{{l.EstacionamentoId}}" ng-repeat="l in  lista_estacionamentos" selected="{{$index==0}}">{{l.NomeEstacionamento}} - {{l.CpfCnpjFormatado}}</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="Data">Data:</label>
                <input type="text" class="form-control" name="Data" id="Data" ng-model="filtros.Data" data-provide="datepicker" data-date-format="dd/mm/yyyy">
            </div>
            <div class="col-sm-2">
                <label for="Hora">Hora:</label>
                <input type="text" class="form-control" name="Hora" id="Hora" ng-model="filtros.Hora" ui-mask="99:99" placeholder="__:__" ng-change="validaHora()">
            </div>
            <div class="col-sm-2">
                <label for="Status">Status:</label>
                <select class="form-control" name="Status" id="Status" ng-model="filtros.Status">
                    <option value="">Todos</option>
                    <option value="A">Aberto</option>
                    <option value="F">Fechado</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-3">
                <label for="TipoPagamento">Tipo de Pagamento:</label>
                <select class="form-control" name="TipoPagamento" id="TipoPagamento" ng-model="filtros.TipoPagamento">
                    <option value="">Todos</option>
                    <option value="O">Online</option>
                    <option value="F">Físico</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="FormaPagamentoId">Forma de Pagamento:</label>
                <select class="form-control" name="FormaPagamentoId" id="FormaPagamentoId" ng-model="filtros.FormaPagamentoId">
                    <option value="">Todos</option>
                    <option value="{{l.FormaPagamentoId}}" ng-repeat="l in lista_formas_pagamento">{{l.Descricao}}</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="">&nbsp;</label>
                <button type="button" ng-click="" class="btn btn-primary form-control">
                    <i class="glyphicon glyphicon-search"></i>
                    Filtrar
                </button>
            </div>
        </div>
    </div><br>
    <div class="row form-group">
        <div class="col-sm-3 pull-right">
            <input type="text" class="form-control" name="filtrar" id="filtrar" ng-model="filtrar" placeholder="Busca Rápida...">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Estacionamento</th>
                        <th class="text-center">Entrada</th>
                        <th class="text-center">Saída</th>
                        <th>Cliente/Placa</th>
                        <th class="text-center">Valor</th>
                        <th>Forma de Pagamento</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="10%">Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_fluxo|filter:filtrar).length<=0">
                        <td colspan="7" class="text-center">Nenhum registro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_fluxo|filter:filtrar | itemsPerPage:100">
                        <td>
                            {{l.NomeEstacionamento}} <br>
                            {{l.CpfCnpjFormatado}}
                        </td>
                        <td class="text-center">{{l.DataEntradaBr}} às {{l.HoraEntradaBr}}</td>
                        <td class="text-center">{{l.DataSaidaBr?(l.DataSaidaBr+' às '+l.HoraSaidaBr):'-'}}</td>
                        <td>
                            <span ng-show="l.NomeCliente">{{l.NomeCliente}}<br></span>
                            {{l.PlacaVeiculoFormatada}}
                        </td>
                        <td class="text-center">
                            {{l.Valor?(l.valor|currency:''):'-'}}
                        </td>
                        <td>
                            {{l.FormaPagamentoDesc?l.FormaPagamentoDesc:'-'}}
                        </td>
                        <td class="text-center">
                        <button  
                            class="btn btn-sm"
                            ng-class="l.Status=='A'?'btn-warning':'btn-success'"
                            ng-click="openFinalizarLocacao(l)"
                            data-html="true" 
                            data-toggle="tooltip" 
                            data-placement="left"
                            data-original-title="{{l.Status=='A'?'Clique aqui para finalizar o periódo da locação.':''}}"
                            tooltip>
                            {{l.Status=='A'?'Aberto':'Fechado'}}
                        </button>
                            
                        </td>
                        <td class="text-center">
                            <button ng-click="" class="btn btn-default btn-sm">
                                <i class="glyphicon glyphicon-search"></i>
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
    <div id="finalizarLocacao" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Finalizar o periódo da locação</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-group" ng-show="form_finaliza.$invalid && form_finaliza.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-default">
                        <div class="row">
                            <div class="col-sm-12">
                                <span><b>Estacionamento: </b> {{objFinalizaLocacao.NomeEstacionamento}}</span>
                                <span ng-show="objFinalizaLocacao.NomeCliente"><b>Cliente: </b> {{objFinalizaLocacao.NomeCliente}}</span>
                                <span><b>Placa Veículo: </b> {{objFinalizaLocacao.PlacaVeiculoFormatada}}</span>
                                <span><b>Entrada: </b> {{objFinalizaLocacao.DataEntradaBr}} às {{objFinalizaLocacao.HoraEntradaBr}}</span>
                            </div>
                        </div>
                    </div>

                    <form name="form_finaliza" id="form_finaliza" ng-submit="setFinalizaLocacao()" autocomplete="off" novalidate >
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label for="DataSaida">Data Saída:</label>
                                <input type="text" class="form-control" id="DataSaida" name="DataSaida" ng-model="objFinalizaLocacao.DataSaida" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                            </div>
                            <div class="col-sm-6">
                                <label for="HoraSaida">Hora Saída:</label>
                                <input type="text" class="form-control" id="HoraSaida" name="HoraSaida" ng-model="objFinalizaLocacao.HoraSaida" ui-mask="99:99" placeholder="__:__" ng-change="validaHora('HoraSaida')">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12">
                                <label for="FormaPagamentoId">Forma de Pagamento:</label>
                                <select class="form-control" name="FormaPagamentoId" id="FormaPagamentoId" ng-model="objFinalizaLocacao.FormaPagamentoId">
                                    <option value="">Selecione</option>
                                    <option value="{{l.FormaPagamentoId}}" ng-repeat="l in lista_formas_pagamento">{{l.Descricao}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label for="Valor">Valor:</label>
                                <input type="text" class="form-control" id="Valor" name="Valor" ng-model="objFinalizaLocacao.Valor|currency:'R$ '" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="Tempo">Tempo:</label>
                                <input type="text" class="form-control" id="Tempo" name="Tempo" ng-model="objFinalizaLocacao.Tempo" disabled>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="form_finaliza" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>