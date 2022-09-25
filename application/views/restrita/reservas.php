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
            <button type="button" ng-click="openRelatorio()" class="btn btn-primary">
                <i class="glyphicon glyphicon-print"></i>
                Imprimir
            </button>
        </div>
    </div>

    <h2>Reservas</h2><br>

    <div class="callout callout-default">
        <div class="row form-group">
            <div class="col-sm-5">
                <label for="EstacionamentoId">Estacionamento:</label>
                <select class="form-control" name="EstacionamentoId" id="EstacionamentoId" ng-model="filtros.EstacionamentoId">
                    <option value="">Todos</option>
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
                <label for="Status">Status:</label>
                <select class="form-control" name="Status" id="Status" ng-model="filtros.Status">
                    <option value="">Todos</option>
                    <option value="B">Aberto</option>
                    <option value="A">Aguardando Pagamento</option>
                    <option value="P">Processando Pagamento</option>
                    <option value="F">Finalizado</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <label for="">&nbsp;</label>
                <button type="button" ng-click="getFluxoVagas()" class="btn btn-primary form-control">
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
                        <th>Periódo Reserva</th>
                        <th>Cliente</th>
                        <th class="text-center">Valor Reserva</th>
                        <th>Forma de Pagamento</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="10%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_reservas|filter:filtrar).length<=0">
                        <td colspan="8" class="text-center">Nenhum registro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_reservas|filter:filtrar | itemsPerPage:100">
                        <td>
                            {{l.DataEntradaBr}} {{l.HoraEntradaBr}} <br>
                            {{l.DataSaidaBr}} {{l.HoraSaidaBr}}
                        </td>
                        <td>
                            {{l.NomeCliente}} <br>
                            {{l.CpfClienteFormatado}}
                        </td>
                        <td class="text-center">
                            {{l.Valor?(l.Valor|currency:''):'-'}}
                        </td>
                        <td>
                            {{l.FormaPagamentoDesc?l.FormaPagamentoDesc:'-'}}
                        </td>
                        <td class="text-center">
                        <button  
                            class="btn btn-sm {{l.ClassBtn}}"
                            ng-click="openFinalizarLocacao(l)"
                            data-html="true" 
                            data-toggle="tooltip" 
                            data-placement="left"
                            data-original-title="{{l.Status=='B'?'Clique aqui para finalizar o periódo da locação.':''}}"
                            tooltip>
                            {{l.StatusDesc}}
                        </button>
                            
                        </td>
                        <td class="text-center">
                            <button ng-click="novoFluxoVaga(l.FluxoVagaId)" class="btn btn-default btn-sm">
                                <i class="glyphicon" ng-class="l.Status=='B'?'glyphicon-pencil':'glyphicon-search'"></i>
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