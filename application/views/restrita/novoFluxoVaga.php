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
    <div class="row form-group" ng-show="!disabled_">
        <div class="col-sm-12">
            <br>
            <div class="alert alert-info" role="alert">
                <div class="row form-group">
                    <div class="col-sm-12">
                        <span><b>Total de Vagas do Estacionamento: </b>{{NumeroVagas}}</span><br>
                        <span><b>Locações em Andamento: </b>{{QtdLocacoes}}</span><br>
                        <span><b>Reservas Próximas: </b>{{reservas_proximas.length}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2>{{FluxoVagaId?(disabled_?'Ver':'Editar'):'Cadastrar'}} Locação</h2><br>
    <form name="form_fluxo_vaga" id="form_fluxo_vaga"  ng-submit="setFluxoVaga()" novalidate autocomplete="off">
        <div class="row form-group" ng-show="form_fluxo_vaga.$invalid && form_fluxo_vaga.$submitted">
            <div class="col-sm-12">
                <div class="alert alert-danger" role="alert">
                    Preencha os campos destacados!
                </div>
            </div>
        </div>
        <div class="row form-group" ng-show="disabled_">
            <div class="col-sm-12">
                <div class="alert alert-warning" role="alert">
                    Locação <b>{{FluxoVaga.StatusFluxoDesc}}</b>, não é mais possivel editar os dados.
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-6" ng-class="form_fluxo_vaga.EstacionamentoId.$invalid && (form_fluxo_vaga.$submitted || EstacionamentoId.DataEntrada.$dirty)?'has-error':''">
                <label for="EstacionamentoId">Estacionamento: </label>
                <select class="form-control" name="EstacionamentoId" id="EstacionamentoId" ng-model="FluxoVaga.EstacionamentoId" ng-required="true" ng-disabled="disabled_" ng-change="getReservas()">
                    <option value="">Selecione</option>
                    <option value="{{l.EstacionamentoId}}" ng-repeat="l in  lista_estacionamentos">{{l.NomeEstacionamento}} - {{l.CpfCnpjFormatado}}</option>
                </select>
            </div>
            <div class="col-sm-6" ng-class="form_fluxo_vaga.CadastroId.$invalid && (form_fluxo_vaga.$submitted || form_fluxo_vaga.CadastroId.$dirty)?'has-error':''">
                <label for="CadastroId">Cliente:</label>
                <select class="form-control" name="CadastroId" id="CadastroId" ng-model="FluxoVaga.CadastroId" ng-disabled="disabled_" ng-change="getReservas()">
                    <option value="">-</option>
                    <option value="{{l.CadastroId}}" ng-repeat="l in  lista_clientes">{{l.Nome}} - {{l.CpfFormatado}}</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-12">
                <label for="ReservaId">Reseva:</label>
                <input type="text" class="form-control" ng-value="FluxoVaga.DataEntradaReserva+' '+FluxoVaga.HoraEntradaReserva+' - '+FluxoVaga.DataSaidaReserva+' '+FluxoVaga.HoraSaidaReserva" ng-show="FluxoVagaId && FluxoVaga.ReservaId" ng-disabled="true">
                <select class="form-control" name="ReservaId" id="ReservaId" ng-model="FluxoVaga.ReservaId" ng-disabled="disabled_" ng-hide="FluxoVagaId">
                    <option value="">-</option>
                    <option value="{{l.ReservaId}}" ng-repeat="l in lista_reservas">
                        {{l.NomeCliente}} ({{l.DataEntrada}} {{l.HoraEntrada}} - {{l.DataSaida}} {{l.HoraSaida}})
                    </option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-4" ng-class="(form_fluxo_vaga.PlacaVeiculo.$invalid) && (form_fluxo_vaga.$submitted || form_fluxo_vaga.PlacaVeiculo.$dirty)?'has-error':''">
                <label for="PlacaVeiculo">Placa Veículo:</label>
                <input type="text" class="form-control" id="PlacaVeiculo" name="PlacaVeiculo" ng-model="FluxoVaga.PlacaVeiculo" ng-required="true" ui-mask="AAA 9*99" uppercase ng-disabled="disabled_">
            </div>
            <div class="col-sm-4" ng-class="form_fluxo_vaga.DataEntrada.$invalid && (form_fluxo_vaga.$submitted || form_fluxo_vaga.DataEntrada.$dirty)?'has-error':''">
                <label for="DataEntrada">Data Entrada:</label>
                <input type="text" data-provide="datepicker" class="form-control" name="DataEntrada" data-date-format="dd/mm/yyyy" ng-model="FluxoVaga.DataEntrada" ng-required="true" ng-disabled="disabled_">
            </div>
            <div class="col-sm-4" ng-class="form_fluxo_vaga.HoraEntrada.$invalid && (form_fluxo_vaga.$submitted || form_fluxo_vaga.HoraEntrada.$dirty)?'has-error':''">
                <label for="HoraEntrada">Hora Entrada:</label>
                <input type="text" class="form-control" id="HoraEntrada" name="HoraEntrada" ng-model="FluxoVaga.HoraEntrada" ui-mask="99:99" placeholder="__:__" ng-change="validaHora('HoraEntrada')" ng-required="true" ng-disabled="disabled_">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-12">
                <label for="Observacao">Observação:</label>
                <textarea class="form-control" name="Observacao" id="Observacao" rows="4" ng-model="FluxoVaga.Observacao" maxlength="255" ng-disabled="disabled_"></textarea>
            </div>
        </div>

        <div class="row form-group" ng-show="disabled_">
            <div class="col-sm-3">
                <label for="DataSaida">Data Saída:</label>
                <input type="text" class="form-control" id="DataSaida" name="DataSaida" ng-model="FluxoVaga.DataSaida" data-provide="datepicker" data-date-format="dd/mm/yyyy" ng-disabled="disabled_">
            </div>
            <div class="col-sm-2">
                <label for="HoraSaida">Hora Saída:</label>
                <input type="text" class="form-control" id="HoraSaida" name="HoraSaida" ng-model="FluxoVaga.HoraSaida" ui-mask="99:99" placeholder="__:__" ng-disabled="disabled_">
            </div>
            <div class="col-sm-4">
                <label for="FormaPagamentoDesc">Forma de Pagamento:</label>
                <input type="text" class="form-control" id="FormaPagamentoDesc" name="FormaPagamentoDesc" ng-value="FluxoVaga.FormaPagamentoDesc"ng-disabled="disabled_">
            </div>
            <div class="col-sm-3">
                <label for="Valor">Valor:</label>
                <input type="text" class="form-control" id="Valor" name="Valor" ng-value="FluxoVaga.Valor|currency:'R$ '"ng-disabled="disabled_">
            </div>
        </div>
        
        <br>
        <div class="row form-group" ng-hide="disabled_">
            <div class="col-sm-2">
                <button type="submit" form="form_fluxo_vaga" class="btn btn-success form-control">Salvar</button>
            </div>
        </div>
    </form>

    <script>
        var FluxoVagaId = "<?php echo $FluxoVagaId; ?>";
    </script>
</div>