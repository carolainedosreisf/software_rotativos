<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button type="button" ng-click="novaReserva()" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Nova
            </button>
        </div>
    </div>

    <h2>Reservas de Vagas</h2><br>

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
                    <option value="N">Não Iniciada</option>
                    <option value="E">Em Andamento</option>
                    <option value="F">Finalizada</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
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
            <div class="col-sm-2">
                <label for="">&nbsp;</label>
                <button type="button" ng-click="getReservas()" class="btn btn-primary form-control">
                    <i class="glyphicon glyphicon-search"></i>
                    Filtrar
                </button>
            </div>
        </div>
    </div><br>
    <div class="row form-group">
        <div class="col-sm-9">
            <b>Total: </b> {{(lista_reservas|filter:filtrar).length}}
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
                        <th>Estacionamento</th>
                        <th>Período Reserva</th>
                        <th>Cliente</th>
                        <th>Locação</th>
                        <th class="text-center">Valor</th>
                        <th>Forma de Pagamento</th>
                        <th class="text-center">Status <br> Pagamento</th>
                        <th class="text-center" width="10%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_reservas|filter:filtrar).length<=0">
                        <td colspan="8" class="text-center">Nenhum registro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_reservas|filter:filtrar | itemsPerPage:100">
                        <td>
                            {{l.NomeEstacionamento}} <br>
                            {{l.CpfCnpjFormatado}}
                        </td>
                        <td>
                            {{l.DataEntrada}} {{l.HoraEntrada}} <br>
                            {{l.DataSaida}} {{l.HoraSaida}}
                        </td>
                        <td>
                            {{l.NomeCliente}} <br>
                            {{l.CpfClienteFormatado}}
                        </td>
                        <td>
                            <span ng-show="l.StatusFluxo!='N'">
                                Início: {{l.DataEntradaFluxo}} {{l.HoraEntradaFluxo}} <br>
                                Fim: {{l.DataSaidaFluxo?(l.DataSaidaFluxo+' '+l.HoraSaidaFluxo):'-'}}<br>
                            </span>
                            <button class="btn {{l.ClassBtnFluxo}} btn-xs cursor-auto">
                                {{l.StatusFluxoDesc}}
                            </button>
                        </td>
                        <td class="text-center">
                            {{l.Valor?(l.Valor|currency:''):'-'}}
                        </td>
                        <td>
                            {{l.FormaPagamentoDesc?l.FormaPagamentoDesc:'-'}}
                        </td>
                        <td class="text-center">
                            <button class="btn {{l.ClassBtn}} btn-xs cursor-auto">
                                {{l.StatusDesc}}
                            </button>
                        </td>
                        <td class="text-center">
                            <button ng-click="novaReserva(l.ReservaId)" class="btn btn-default btn-sm">
                                <i class="glyphicon" ng-class="l.Status=='B' && l.StatusFluxo=='N'?'glyphicon-pencil':'glyphicon-search'"></i>
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