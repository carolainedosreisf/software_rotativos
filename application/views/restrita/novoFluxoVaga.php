<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <a type="button" href="index" class="btn btn-default">
                <i class="glyphicon glyphicon-arrow-left"></i>
                Voltar
            </a>
        </div>
    </div>
    <h2>{{FluxoVagaId?'Editar':'Cadastrar'}} Fluxo Vaga</h2><br>
    <form name="form_fluxo_vaga" id="form_fluxo_vaga" novalidate autocomplete="off" ng-submit="setFluxoVaga()">
        <div class="row form-group">
            <div class="col-sm-5">
                <label for="EstacionamentoId">Estacionamento: </label>
                <select class="form-control" name="EstacionamentoId" id="EstacionamentoId" ng-model="FluxoVaga.EstacionamentoId" ng-required="true">
                    <option value="" style="display:none;"></option>
                    <option value="{{l.EstacionamentoId}}" ng-repeat="l in  lista_estacionamentos" selected="{{$index==0}}">{{l.NomeEstacionamento}} - {{l.CpfCnpjFormatado}}</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="CadastroId">Cliente:</label>
                <select class="form-control" name="CadastroId" id="CadastroId" ng-model="FluxoVaga.CadastroId">
                    <option value="">-</option>
                    <option value="{{l.CadastroId}}" ng-repeat="l in  lista_clientes">{{l.Nome}} - {{l.CpfFormatado}}</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="PlacaVeiculo">Placa Veículo:</label>
                <input type="text" class="form-control" id="PlacaVeiculo" mame="PlacaVeiculo" ng-model="FluxoVaga.PlacaVeiculo" placeholder="___-____" ng-required="true">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-3">
                <label for="DataEntrada">Data Entrada:</label>
                <input type="text" class="form-control" id="DataEntrada" mame="DataEntrada" ng-model="FluxoVaga.DataEntrada" ng-required="true" data-provide="datepicker" data-date-format="dd/mm/yyyy">
            </div>
            <div class="col-sm-3">
                <label for="HoraEntrada">Hora Entrada:</label>
                <input type="text" class="form-control" id="HoraEntrada" mame="HoraEntrada" ng-model="FluxoVaga.HoraEntrada" ng-required="true" ui-mask="99:99" placeholder="__:__" ng-change="validaHora()">
            </div>
            <div class="col-sm-3">
                <label for="DataSaida">Data Saída:</label>
                <input type="text" class="form-control" id="DataEntrada" mame="DataSaida" ng-model="FluxoVaga.DataSaida" data-provide="datepicker" data-date-format="dd/mm/yyyy">
            </div>
            <div class="col-sm-3">
                <label for="HoraSaida">Hora Saída:</label>
                <input type="text" class="form-control" id="HoraSaida" mame="HoraSaida" ng-model="FluxoVaga.HoraSaida" ui-mask="99:99" placeholder="__:__" ng-change="validaHora()">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-12">
                <label for="Observacao">Observação:</label>
                <textarea class="form-control" name="Observacao" id="Observacao" rows="4" ng-model="FluxoVaga.Observacao" maxlength="255"></textarea>
            </div>
        </div><br>
        <div class="row form-group">
            <div class="col-sm-2">
                <button type="submit" form="form_fluxo_vaga" class="btn btn-success form-control">Salvar</button>
            </div>
        </div>
    </form>

    <script>
        var FluxoVagaId = "<?php echo $FluxoVagaId; ?>";
    </script>
</div>