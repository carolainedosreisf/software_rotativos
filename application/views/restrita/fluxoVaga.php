<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button type="button" ng-click="" class="btn btn-success">
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
            <div class="col-sm-2">
                <label for="Data">Data:</label>
                <input type="text" class="form-control" name="Data" id="Data" ng-model="filtros.Data">
            </div>
            <div class="col-sm-2">
                <label for="Hora">Hora:</label>
                <input type="text" class="form-control" name="Hora" id="Hora" ng-model="filtros.Hora">
            </div>
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
                    <option value="O">Online</option>
                    <option value="F">Físico</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="Status">Status:</label>
                <select class="form-control" name="Status" id="Status" ng-model="filtros.Status">
                    <option value="">Todos</option>
                    <option value="A">Aberto</option>
                    <option value="F">Fechado</option>
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="text-center">
                <button type="button" ng-click="" class="btn btn-primary">
                    <i class="glyphicon glyphicon-search"></i>
                    Filtrar
                </button>
            </div>
            
        </div>
    </div>
    
</div>
