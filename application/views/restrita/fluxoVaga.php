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
            <?php if($this->session->userdata('PermissaoId')==2){ ?>
            <button type="button" ng-click="openRelatorio()" class="btn btn-primary">
                <i class="glyphicon glyphicon-print"></i>
                Imprimir
            </button>
            <?php } ?>
        </div>
    </div>

    <h2>Locações de Vagas</h2><br>

    <div class="callout callout-default">
        <div class="row form-group">
            <div class="col-sm-5">
                <label for="EstacionamentoId">Estacionamento:</label>
                <select class="form-control" name="EstacionamentoId" id="EstacionamentoId" ng-model="filtros.EstacionamentoId">
                    <option value="" ng-hide="lista_estacionamentos.length==1">Todos</option>
                    <option value="{{l.EstacionamentoId}}" ng-repeat="l in  lista_estacionamentos">{{l.NomeEstacionamento}} - {{l.CpfCnpjFormatado}}</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="DataInicio">A partir De:</label>
                <input type="text" class="form-control" name="DataInicio" id="DataInicio" ng-model="filtros.DataInicio" data-provide="datepicker" data-date-format="dd/mm/yyyy">
            </div>
            <div class="col-sm-2">
                <label for="DataFim">Até:</label>
                <input type="text" class="form-control" name="DataFim" id="DataFim" ng-model="filtros.DataFim" data-provide="datepicker" data-date-format="dd/mm/yyyy">
            </div>
            <div class="col-sm-3">
                <label for="StatusFluxo">Status Locação:</label>
                <select class="form-control" name="StatusFluxo" id="StatusFluxo" ng-model="filtros.StatusFluxo">
                    <option value="">Todos</option>
                    <option value="E">Em Andamento</option>
                    <option value="F">Finalizada</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-4">
                <label for="CadastroId">Cliente:</label>
                <select class="form-control" name="CadastroId" id="CadastroId" ng-model="filtros.CadastroId">
                    <option value="">Todos</option>
                    <option value="{{l.CadastroId}}" ng-repeat="l in lista_cadastros">{{l.Nome}}</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="Reservado">Reservado:</label>
                <select class="form-control" name="Reserva" id="Reservado" ng-model="filtros.Reservado">
                    <option value="">Todos</option>
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="StatusPagamento">Status Pagamento:</label>
                <select class="form-control" name="StatusPagamento" id="StatusPagamento" ng-model="filtros.StatusPagamento">
                    <option value="">Todos</option>
                    <option value="B">Aberto</option>
                    <option value="A">Aguardando Pagamento</option>
                    <option value="P">Processando Pagamento</option>
                    <option value="F">Finalizado</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="FormaPagamentoId">Forma de Pagamento:</label>
                <select class="form-control" name="FormaPagamentoId" id="FormaPagamentoId" ng-model="filtros.FormaPagamentoId">
                    <option value="">Todos</option>
                    <option value="{{l.FormaPagamentoId}}" ng-repeat="l in lista_formas_pagamento">{{l.Descricao}}</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <!-- <label for="">&nbsp;</label> -->
                <button type="button" ng-click="getFluxoVagas()" class="btn btn-primary form-control">
                    <i class="glyphicon glyphicon-search"></i>
                    Filtrar
                </button>
            </div>
        </div>
    </div><br>
    <div class="row form-group">
        <div class="col-sm-9">
            <b>Total: </b> {{(lista_fluxo|filter:filtrar).length}}
        </div>
        <div class="col-sm-3 pull-right">
            <input type="text" class="form-control" name="filtrar" id="filtrar" ng-model="filtrar" placeholder="Busca Rápida...">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="20%">Estacionamento</th>
                        <th class="text-center">Entrada</th>
                        <th class="text-center">Saída</th>
                        <th>Cliente/Placa</th>
                        <th class="text-center">Reserva</th>
                        <th class="text-center">Valor</th>
                        <th>Forma de Pagamento</th>
                        <th class="text-center">Status<br>Pagamento</th>
                        <th class="text-center">Status<br>Locação</th>
                        <th class="text-center" width="10%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_fluxo|filter:filtrar).length<=0">
                        <td colspan="10" class="text-center">Nenhum registro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_fluxo|filter:filtrar | itemsPerPage:100">
                        <td>
                            {{l.NomeEstacionamento}} <br>
                            {{l.CpfCnpjFormatado}}
                        </td>
                        <td class="text-center">{{l.DataEntrada}}<br>às {{l.HoraEntrada}}</td>
                        <td class="text-center">
                            <span ng-show="l.DataSaida">
                                {{l.DataSaida}}<br>às {{l.HoraSaida}}
                            </span>
                        </td>
                        <td>
                            <span ng-show="l.NomeCliente">{{l.NomeCliente}}<br></span>
                            {{l.PlacaVeiculoFormatada}}
                        </td>
                        <td class="text-center">
                            <button 
                                class="btn btn-default btn-xs"
                                data-html="true" 
                                data-toggle="tooltip" 
                                data-placement="left"
                                data-original-title="{{
                                    l.IsReserva=='S'?
                                    '<b>Entrada: </b>'+l.DataEntradaReserva+' '+l.HoraEntradaReserva+'<br>'+
                                    '<b>Saída: </b>'+l.DataSaidaReserva+' '+l.HoraSaidaReserva+'<br>'
                                    :''
                                }}"
                                tooltip>
                                {{l.IsReserva=='S'?'Sim':'Não'}}
                            </button>
                        </td>
                        <td class="text-center">
                            {{l.Valor?(l.Valor|currency:''):'-'}}
                        </td>
                        <td>
                            {{l.FormaPagamentoDesc?l.FormaPagamentoDesc:'-'}}
                        </td>
                        <td class="text-center">
                            <button  
                                class="btn btn-xs {{l.ClassBtn}} cursor-auto"
                                tooltip>
                                {{l.StatusDesc}}
                            </button>
                            
                        </td>
                        <td class="text-center">
                            <button  
                                class="btn btn-xs {{l.ClassBtnFluxo}}"
                                ng-click="openFinalizarLocacao(l)"
                                data-html="true" 
                                data-toggle="tooltip" 
                                data-placement="left"
                                data-original-title="{{l.StatusFluxo=='E'?'Clique aqui para finalizar o período da locação.':''}}"
                                tooltip>
                                {{l.StatusFluxoDesc}}
                            </button>
                            
                        </td>
                        <td class="text-center">
                            <button ng-click="novoFluxoVaga(l.FluxoVagaId)" class="btn btn-default btn-sm">
                                <i class="glyphicon" ng-class="l.StatusFluxo=='E'?'glyphicon-pencil':'glyphicon-search'"></i>
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
                        <h4 class="modal-title">Finalizar o período da locação</h4>
                </div>
                <div class="modal-body">
                    <div class="row" ng-show="form_finaliza.$invalid && form_finaliza.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>
                    <div class="row" ng-show="erro_saida">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                A saída não pode ser menor que a entrada, preencha a Data e Hora de saída maior que a Data e Hora de entrada.
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-default">
                        <div class="row">
                            <div class="col-sm-12">
                                <span><b>Estacionamento: </b> {{objFinalizaLocacao.NomeEstacionamento}}</span>
                                <span ng-show="objFinalizaLocacao.NomeCliente"><b>Cliente: </b> {{objFinalizaLocacao.NomeCliente}}</span>
                                <span><b>Placa Veículo: </b> {{objFinalizaLocacao.PlacaVeiculoFormatada}}</span>
                                <span><b>Entrada: </b> {{objFinalizaLocacao.DataEntrada}} às {{objFinalizaLocacao.HoraEntrada}}</span>
                            </div>
                        </div>
                    </div>

                    <form name="form_finaliza" id="form_finaliza" autocomplete="off" novalidate ng-submit="setFinalizarLocacao()">
                        <div class="row form-group">
                            <div class="col-sm-6" ng-class="form_finaliza.DataSaida.$invalid && (form_finaliza.$submitted || form_estacionamento.DataSaida.$dirty)?'has-error':''">
                                <label for="DataSaida">Data Saída:</label>
                                <input type="text" class="form-control" id="DataSaida" name="DataSaida" ng-model="objFinalizaLocacao.DataSaida" data-provide="datepicker" data-date-format="dd/mm/yyyy" ng-change="calculaValor()" ng-required="true">
                            </div>
                            <div class="col-sm-6"  ng-class="form_finaliza.HoraSaida.$invalid && (form_finaliza.$submitted || form_estacionamento.HoraSaida.$dirty)?'has-error':''">
                                <label for="HoraSaida">Hora Saída:</label>
                                <input type="text" class="form-control" id="HoraSaida" name="HoraSaida" ng-model="objFinalizaLocacao.HoraSaida" ui-mask="99:99" placeholder="__:__" ng-change="calculaValor()" ng-required="true">
                            </div>
                        </div>
                        <div class="row form-group" ng-show="objFinalizaLocacao.JaPagou=='N'">
                            <div class="col-sm-12"  ng-class="form_finaliza.FormaPagamentoId.$invalid && (form_finaliza.$submitted || form_estacionamento.FormaPagamentoId.$dirty)?'has-error':''">
                                <label for="FormaPagamentoId">Forma de Pagamento:</label>
                                <select class="form-control" name="FormaPagamentoId" id="FormaPagamentoId" ng-model="objFinalizaLocacao.FormaPagamentoId" ng-required="objFinalizaLocacao.JaPagou=='N'">
                                    <option value="">Selecione</option>
                                    <option value="{{l.FormaPagamentoId}}" ng-repeat="l in lista_formas_pagamento" ng-show="l.FormaPagamentoId!=5">{{l.Descricao}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group" ng-show="objFinalizaLocacao.JaPagou=='N'">
                            <div class="col-sm-6">
                                <label for="Valor">Valor:</label>
                                <input type="text" class="form-control" id="Valor" name="Valor" ng-value="objFinalizaLocacao.Valor|currency:'R$ '" disabled>
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