
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
    <h2>{{EstacionamentoId?'Editar':'Cadastrar'}} Estacionamento</h2><br>
    <form name="form_estacionamento" id="form_estacionamento" novalidate autocomplete="off" ng-submit="setEstacionamento()">
        <div id="mensagens">
            <div class="alert alert-danger" role="alert" ng-show="objEstacionamento.TipoEmpresa == 'J' && form_estacionamento.CpfCnpj.$invalid && !(form_estacionamento.CpfCnpj.$error.required) && (form_estacionamento.$submitted || form_estacionamento.CpfCnpj.$dirty)">
                CNPJ Inválido!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="objEstacionamentoTipoEmpresa == 'F' && form_estacionamento.CpfCnpj.$invalid && !(form_estacionamento.Cpf.$error.required) && (form_estacionamento.$submitted || form_estacionamento.CpfCnpj.$dirty)">
                CPF Inválido!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="form_estacionamento.Email.$invalid && !(form_estacionamento.Email.$error.required) && (form_estacionamento.$submitted || form_estacionamento.Email.$dirty)">
                E-mail Inválido!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="form_estacionamento.NumeroTelefone1.$invalid && !(form_estacionamento.NumeroTelefone1.$error.required) && (form_estacionamento.$submitted || form_estacionamento.NumeroTelefone1.$dirty)">
                Celular Inválido!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="form_estacionamento.NumeroTelefone2.$invalid && !(form_estacionamento.NumeroTelefone2.$error.required) && (form_estacionamento.$submitted || form_estacionamento.NumeroTelefone2.$dirty)">
                Telefone Inválido!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="form_estacionamento.$error.required && form_estacionamento.$submitted">
                Preencha os campos destacados!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="objEstacionamento.PrecoHora<=0 && objEstacionamento.PrecoLivre <=0 && form_estacionamento.$submitted">
                Preencha pelo menos um dos dois campos de preço (Preço Hora,Preço Livre).
            </div>
            <div class="alert alert-danger" role="alert" ng-show="erro_cep">
                CEP Inválido!
            </div>
            <div class="alert alert-danger" ng-show="objEstacionamento.NumeroVagas < objEstacionamento.NumeroLimiteReserva">
                Limite de vagas para reservar não pode ser maior que Total de Vagas.
            </div>
            <div class="alert alert-danger" role="alert" ng-repeat="erro in lista_erros">
                {{erro}}
            </div>
            
        </div>
        <div class="callout callout-default">
            <h4 class="text-center">Estacionamento</h4>
            <div class="row form-group" ng-show="EstacionamentoId">
                <div class="col-sm-3">
                    <label for="EstacionamentoId">Código:</label>
                    <input type="text" class="form-control" ng-value="EstacionamentoId" ng-disabled="true">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <label for="Nome">Nome Empresa:</label>
                    <input type="text" name="Nome" id="Nome" class="form-control" ng-value="objEstacionamento.Nome" ng-disabled="true">
                </div>
                <div class="col-sm-6" ng-class="form_estacionamento.NomeEstacionamento.$invalid && (form_estacionamento.$submitted || form_estacionamento.NomeEstacionamento.$dirty)?'has-error':''">
                    <label for="NomeEstacionamento">Nome Estacionamento:</label>
                    <input type="text" name="NomeEstacionamento" id="NomeEstacionamento" class="form-control" ng-model="objEstacionamento.NomeEstacionamento" maxlength="100" ng-required="true">
                </div>

            </div>

            <div class="row form-group">
                <div class="col-sm-5" ng-class="form_estacionamento.CpfCnpj.$invalid && (form_estacionamento.$submitted || form_estacionamento.CpfCnpj.$dirty)?'has-error':''">
                    <label for="CpfCnpj">{{objEstacionamento.TipoEmpresa=='J'?'CNPJ':'CPF'}}:</label>
                    <input type="text" name="CpfCnpj" id="CpfCnpj" class="form-control" ng-model="objEstacionamento.CpfCnpj" ui-br-cnpj-mask ng-disabled="EstacionamentoId" ng-if="objEstacionamento.TipoEmpresa=='J'" ng-required="true">
                    <input type="text" name="CpfCnpj" id="CpfCnpj" class="form-control" ng-model="objEstacionamento.CpfCnpj" ui-br-cpf-mask ng-disabled="EstacionamentoId" ng-if="objEstacionamento.TipoEmpresa=='F'" ng-required="true">
                </div>
                <div class="col-sm-2" ng-class="form_estacionamento.PrecoLivre.$error.required && (form_estacionamento.$submitted || form_estacionamento.PrecoLivre.$dirty)?'has-error':''">
                    <label for="PrecoLivre">Preço Livre:</label>
                    <input type="text" name="PrecoLivre" id="PrecoLivre" class="form-control" ng-model="objEstacionamento.PrecoLivre" ng-required="true" ui-number-mask="2">
                </div>
                <div class="col-sm-2" ng-class="form_estacionamento.PrecoHora.$invalid && (form_estacionamento.$submitted || form_estacionamento.PrecoHora.$dirty)?'has-error':''">
                    <label for="PrecoHora">Preço Hora:</label>
                    <input type="text" name="PrecoHora" id="PrecoHora" class="form-control" ng-model="objEstacionamento.PrecoHora" ng-required="true" ui-number-mask="2">
                </div>
                <div class="col-sm-3" ng-class="form_estacionamento.NumeroVagas.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroVagas.$dirty)?'has-error':''">
                    <label for="NumeroVagas">Total de Vagas:</label>
                    <input type="text" name="NumeroVagas" id="NumeroVagas" class="form-control" ng-model="objEstacionamento.NumeroVagas" ng-required="true" somentenumeros>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-4" ng-class="form_estacionamento.NumeroLimiteReserva.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroLimiteReserva.$dirty)?'has-error':''">
                    <label for="NumeroLimiteReserva">
                        Limite de vagas para reservar:
                        <i 
                            style="color:#31708f" 
                            class="glyphicon glyphicon-question-sign"
                            data-html="true" 
                            data-toggle="tooltip" 
                            data-placement="top"
                            data-original-title="Informe aqui o limite de vagas do Total de Vagas do estacionamento que poderão ser utilizadas para rerservas. <br><br> Recomenda-se não ultrapassar 70% do Total de Vagas.<br><br> Deixe o campo com valor 0 caso o estacionamento não permita realizar reservar."
                            tooltip
                        ></i>
                    </label>
                    <input type="text" name="NumeroLimiteReserva" id="NumeroLimiteReserva" class="form-control" ng-model="objEstacionamento.NumeroLimiteReserva" ng-required="true" somentenumeros>
                </div>
                <div class="col-sm-3">
                    <label for="TipoChavePix">Tipo Chave Pix:</label>
                    <select name="TipoChavePix" id="TipoChavePix" ng-model="objEstacionamento.TipoChavePix" class="form-control" ng-change="objEstacionamento.ChavePix=''">
                        <option value="{{key}}" ng-repeat="(key,tipo) in lista_tipos_pix">{{tipo}}</option>
                    </select>
                </div>
                <div class="col-sm-5" ng-show="objEstacionamento.TipoChavePix>0" ng-class="form_estacionamento.ChavePix.$invalid && (form_estacionamento.$submitted || form_estacionamento.ChavePix.$dirty)?'has-error':''">
                    <label for="ChavePix">Chave Pix:</label>
                    <input type="text" ng-if="objEstacionamento.TipoChavePix==1" name="ChavePix" id="ChavePix" class="form-control" ng-model="objEstacionamento.ChavePix" ui-br-cnpj-mask ng-required="objEstacionamento.TipoChavePix==1">

                    <input type="text" ng-if="objEstacionamento.TipoChavePix==2" name="ChavePix" id="ChavePix" class="form-control" ng-model="objEstacionamento.ChavePix" ui-br-cpf-mask ng-required="objEstacionamento.TipoChavePix==2">

                    <input type="email" ng-if="objEstacionamento.TipoChavePix==3" name="ChavePix" id="ChavePix" class="form-control" ng-model="objEstacionamento.ChavePix" ng-required="objEstacionamento.TipoChavePix==3">

                    <input type="text" ng-if="objEstacionamento.TipoChavePix==4" name="ChavePix" id="ChavePix" class="form-control" ng-model="objEstacionamento.ChavePix" ng-required="objEstacionamento.TipoChavePix==4" ui-br-phone-number-mask="areaCode">

                    <input type="text" ng-if="objEstacionamento.TipoChavePix==5" name="ChavePix" id="ChavePix" class="form-control" ng-model="objEstacionamento.ChavePix" ng-required="objEstacionamento.TipoChavePix==5">

                </div>
                <div class="col-sm-3">
                    <label for="" style="display:block">&ensp;</label>
                    <button type="button" class="btn-sm btn btn-warning" data-toggle="modal" data-target="#modalDias">
                        <i class="glyphicon glyphicon-pencil"></i>
                        Dias e Horários de Atendimento
                    </button>
                </div>
            </div>
        </div>
        <br>
        <div class="callout callout-default">
            <h4 class="text-center">Endereço</h4>
            <div class="row form-group">
                <div class="col-sm-4" ng-class="erro_cep || form_estacionamento.NumeroCep.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroCep.$dirty)?'has-error':''">
                    <label for="NumeroCep">CEP:</label>
                    <input type="text" name="NumeroCep" id="NumeroCep" class="form-control" ng-model="objEstacionamento.NumeroCep" ui-mask="99999-999" ngrequired="true" ng-change="buscaCep()" ng-required="true">
                </div>
                <div class="col-sm-4" ng-class="form_estacionamento.BairroEndereco.$invalid && (form_estacionamento.$submitted || form_estacionamento.BairroEndereco.$dirty)?'has-error':''">
                    <label for="BairroEndereco">Bairro:</label>
                    <input type="text" name="BairroEndereco" id="BairroEndereco" class="form-control" ng-model="objEstacionamento.BairroEndereco" maxlength="80" ng-required="true">
                </div>
                <div class="col-sm-4" ng-class="form_estacionamento.CidadeId.$invalid && (form_estacionamento.$submitted || form_estacionamento.CidadeId.$dirty)?'has-error':''">
                    <label for="CidadeId">Cidade:</label>
                    <select type="text" name="CidadeId" id="CidadeId" class="form-control" ng-model="objEstacionamento.CidadeId" ng-required="true">
                        <option value="">Selecione</option>
                        <option value="{{l.CidadeId}}" ng-repeat="l in lista_cidades">{{l.NomeCidade}} ({{l.Estado}})</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-2" ng-class="form_estacionamento.NumeroEndereco.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroEndereco.$dirty)?'has-error':''">
                    <label for="NumeroEndereco">Número:</label>
                    <input type="text" name="NumeroEndereco" id="NumeroEndereco" class="form-control" ng-model="objEstacionamento.NumeroEndereco" maxlength="5" somentenumeros ng-required="true">
                </div>
                <div class="col-sm-6" ng-class="form_estacionamento.Endereco.$invalid && (form_estacionamento.$submitted || form_estacionamento.Endereco.$dirty)?'has-error':''">
                    <label for="Endereco">Endereço:</label>
                    <input type="text" name="Endereco" id="Endereco" class="form-control" ng-model="objEstacionamento.Endereco" maxlength="80" ng-required="true">
                </div>
                <div class="col-sm-4">
                    <label for="Complemento">Complemento:</label>
                    <input type="text" name="Complemento" id="Complemento" class="form-control" ng-model="objEstacionamento.Complemento" maxlength="45">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12">
                    <label for="LinkMaps">
                    Link de Compatilhamento do Google Maps:
                    <i 
                        style="color:#31708f" 
                        class="glyphicon glyphicon-question-sign"
                        data-html="true" 
                        data-toggle="tooltip" 
                        data-placement="top"
                        data-original-title="Esse link é importante para redirecionar seus clientes para a localização do seu estacionemento.<br><br>Para obter o link acesse no aplicativo Google Maps com o endereço da sua empresa, clique em compartilhar, copie o link e cole nesse campo."
                        tooltip
                    ></i>
                    </label>
                    <input type="text" name="LinkMaps" id="LinkMaps" class="form-control" ng-model="objEstacionamento.LinkMaps" maxlength="255">
                </div>
            </div>
        </div><br>

        <div class="callout callout-default">
            <h4 class="text-center">Contato</h4>
            <div class="row form-group">
                <div class="col-sm-4" ng-class="form_estacionamento.NumeroTelefone1.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroTelefone1.$dirty)?'has-error':''">
                    <label for="NumeroTelefone1">Celular:</label>
                    <input type="text" name="NumeroTelefone1" id="NumeroTelefone1" class="form-control" ng-model="objEstacionamento.NumeroTelefone1" ng-required="true" ui-br-phone-number-mask="areaCode">
                </div>
                <div class="col-sm-4" ng-class="form_estacionamento.NumeroTelefone2.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroTelefone2.$dirty)?'has-error':''">
                    <label for="NumeroTelefone2">Telefone:</label>
                    <input type="text" name="NumeroTelefone2" id="NumeroTelefone2" class="form-control" ng-model="objEstacionamento.NumeroTelefone2" ui-br-phone-number-mask="areaCode">
                </div>
                <div class="col-sm-4" ng-class="form_estacionamento.Email.$invalid && (form_estacionamento.$submitted || form_estacionamento.Email.$dirty)?'has-error':''">
                    <label for="Email">E-mail:</label>
                    <input type="email" name="Email" id="Email" class="form-control" ng-model="objEstacionamento.Email" ng-required="true">
                </div>
            </div>
        </div> <br>

        <div class="row form-group text-center">
            <button type="submit" form="form_estacionamento" class="btn btn-success form-control" style="width:250px;">Salvar</button>
        </div>
    </form>

    <div id="modalDias" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Dias e Horários de Atendimento</h4>
                </div>
                <div class="modal-body">
                    
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="30%">Dia</th>
                                    <th class="text-center">Aberto</th>
                                    <th class="text-center">Horário Abertura</th>
                                    <th class="text-center">Horário Fechamento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="(key,l) in lista_dias">
                                    <td>{{l.DiaDesc}}</td>
                                    <td class="text-center">
                                        <label class="switch">
                                            <input type="checkbox" name="Aberto_{{key}}" id="Aberto_{{key}}" ng-model="lista_dias[key].Aberto" ng-true-value="'S'" ng-false-value="'N'" ng-change="lista_dias[key].HoraEntrada='';lista_dias[key].HoraSaida='';">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="HoraEntrada_{{key}}"  id="HoraEntrada_{{key}}" class="form-control text-center" ui-mask="99:99" ng-model="lista_dias[key].HoraEntrada" placeholder="__:__" autocomplete="off" ng-disabled="lista_dias[key].Aberto=='N'" ng-change="validaHora('HoraEntrada',key)">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" name="HoraSaida_{{key}}"  id="HoraSaida_{{key}}" class="form-control text-center" ui-mask="99:99" ng-model="lista_dias[key].HoraSaida" placeholder="__:__" autocomplete="off" ng-disabled="lista_dias[key].Aberto=='N'" ng-change="validaHora('HoraEntrada',key)">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" ng-click="setDiasAtendimento(EstacionamentoId)">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        var base_url_externo = "<?php echo base_url().'index.php/'; ?>";
        var EstacionamentoId = "<?php echo $EstacionamentoId; ?>";
        var lista_tipos_pix = <?php echo json_encode($lista_tipos_pix); ?>;
    </script>
</div>

         
