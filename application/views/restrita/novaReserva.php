<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <a type="button" href="reservas" class="btn btn-default">
                <i class="glyphicon glyphicon-arrow-left"></i>
                Voltar
            </a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCliente">
                <i class="glyphicon glyphicon-plus"></i> Novo Cliente
            </button>
        </div>
    </div>
    <h2>{{ReservaId?(disabled_?'Ver':'Editar'):'Cadastrar'}} Reserva</h2><br>
    <form name="form_reserva" id="form_reserva"  ng-submit="setReserva()" novalidate autocomplete="off">
        <div class="row form-group" ng-show="form_reserva.$invalid && form_reserva.$submitted">
            <div class="col-sm-12">
                <div class="alert alert-danger" role="alert">
                    Preencha os campos destacados!
                </div>
            </div>
        </div>
        <div class="row form-group" ng-show="erro>1">
            <div class="col-sm-12">
                <div class="alert alert-danger" role="alert">
                    {{
                        erro==2?
                        'A saída não pode ser menor que a entrada, preencha a Data e Hora de saída maior que a Data e Hora de entrada.':
                        'Data Entrada e Hora Entrada devem ser maiores que a Data e Hora atual.'
                    }}
                </div>
            </div>
        </div>
        <div class="row form-group" ng-show="disabled_">
            <div class="col-sm-12">
                <div class="alert alert-warning" role="alert">
                    Fluxo de vaga <b>{{Reserva.StatusDesc}}</b>, não é mais possivel editar os dados.
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-6" ng-class="form_reserva.EstacionamentoId.$invalid && (form_reserva.$submitted || EstacionamentoId.DataEntrada.$dirty)?'has-error':''">
                <label for="EstacionamentoId">Estacionamento: </label>
                <select class="form-control" name="EstacionamentoId" id="EstacionamentoId" ng-model="Reserva.EstacionamentoId" ng-required="true" ng-disabled="disabled_">
                    <option value="">Selecione</option>
                    <option value="{{l.EstacionamentoId}}" ng-repeat="l in  lista_estacionamentos">{{l.NomeEstacionamento}} - {{l.CpfCnpjFormatado}}</option>
                </select>
            </div>
            <div class="col-sm-6" ng-class="form_reserva.CadastroId.$invalid && (form_reserva.$submitted || form_reserva.CadastroId.$dirty)?'has-error':''">
                <label for="CadastroId">Cliente:</label>
                <select class="form-control" name="CadastroId" id="CadastroId" ng-model="Reserva.CadastroId" ng-required="true" ng-disabled="disabled_">
                    <option value="">Selecione</option>
                    <option value="{{l.CadastroId}}" ng-repeat="l in lista_clientes">{{l.Nome}} - {{l.CpfFormatado}}</option>
                </select>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-3" ng-class="form_reserva.DataEntrada.$invalid && (form_reserva.$submitted || form_reserva.DataEntrada.$dirty)?'has-error':''">
                <label for="DataEntrada">Data Entrada:</label>
                <input type="text" data-provide="datepicker" class="form-control" name="DataEntrada" data-date-format="dd/mm/yyyy" ng-model="Reserva.DataEntrada" ng-required="true" ng-disabled="disabled_">
            </div>
            <div class="col-sm-3" ng-class="form_reserva.HoraEntrada.$invalid && (form_reserva.$submitted || form_reserva.HoraEntrada.$dirty)?'has-error':''">
                <label for="HoraEntrada">Hora Entrada:</label>
                <input type="text" class="form-control" id="HoraEntrada" name="HoraEntrada" ng-model="Reserva.HoraEntrada" ui-mask="99:99" placeholder="__:__" ng-change="validaHora('HoraEntrada')" ng-required="true" ng-disabled="disabled_">
            </div>
            <div class="col-sm-3" ng-class="form_reserva.DataSaida.$invalid && (form_reserva.$submitted || form_reserva.DataSaida.$dirty)?'has-error':''">
                <label for="DataSaida">Data Saída:</label>
                <input type="text" class="form-control" id="DataSaida" name="DataSaida" ng-model="Reserva.DataSaida" data-provide="datepicker" data-date-format="dd/mm/yyyy" ng-required="true" ng-disabled="disabled_">
            </div>
            <div class="col-sm-3"  ng-class="form_reserva.HoraSaida.$invalid && (form_reserva.$submitted || form_reserva.HoraSaida.$dirty)?'has-error':''">
                <label for="HoraSaida">Hora Saída:</label>
                <input type="text" class="form-control" id="HoraSaida" name="HoraSaida" ng-model="Reserva.HoraSaida" ui-mask="99:99" placeholder="__:__" ng-change="validaHora('HoraSaida')" ng-required="true" ng-disabled="disabled_">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-12">
                <label for="Observacao">Observação:</label>
                <textarea class="form-control" name="Observacao" id="Observacao" rows="4" ng-model="Reserva.Observacao" maxlength="255" ng-disabled="disabled_"></textarea>
            </div>
        </div>
        
        <br>
        <div class="row form-group" ng-hide="disabled_">
            <div class="col-sm-2">
                <button type="submit" form="form_reserva" class="btn btn-success form-control">Salvar</button>
            </div>
        </div>
    </form>

    <div id="modalCliente" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cadastrar Cliente</h4>
                </div>
                <div class="modal-body">

                    <div class="row" ng-show="form_cliente.$error.required && form_cliente.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>
                    <div class="row" ng-show="form_cliente.Cpf.$invalid && !(form_cliente.Cpf.$error.required) && (form_cliente.$submitted || form_cliente.Cpf.$dirty)">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                CPF Inválido!
                            </div>
                        </div>
                    </div>
                    <div class="row" ng-show="form_cliente.NumeroTelefone.$invalid && !(form_cliente.NumeroTelefone.$error.required) && (form_cliente.$submitted || form_cliente.NumeroTelefone.$dirty)">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Telefone Inválido!
                            </div>
                        </div>
                    </div>

                    <form name="form_cliente" id="form_cliente" autocomplete="off" novalidate ng-submit="setCliente()" autocomplete="off">
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_cliente.Nome.$invalid && (form_cliente.$submitted || form_cliente.Nome.$dirty)?'has-error':''">
                                <label for="Nome">Nome:</label>
                                <input type="text" class="form-control" name="Nome" id="Nome" ng-model="objCliente.Nome" ng-required="true" maxlength="80">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_cliente.Cpf.$invalid && (form_cliente.$submitted || form_cliente.Cpf.$dirty)?'has-error':''">
                                <label for="Cpf">CPF:</label>
                                <input type="text" class="form-control" name="Cpf" id="Cpf" ng-model="objCliente.Cpf" ng-required="true" ui-br-cpf-mask>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_cliente.NumeroTelefone.$invalid && (form_cliente.$submitted || form_cliente.NumeroTelefone.$dirty)?'has-error':''">
                                <label for="NumeroTelefone">Telfone:</label>
                                <input type="text" class="form-control" name="NumeroTelefone" id="NumeroTelefone" ng-model="objCliente.NumeroTelefone" ng-required="true" ui-br-phone-number-mask="areaCode">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="form_cliente" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ReservaId = "<?php echo $ReservaId; ?>";
    </script>
</div>