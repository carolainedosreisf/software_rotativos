
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
                <div class="col-sm-4" ng-class="form_estacionamento.CpfCnpj.$invalid && (form_estacionamento.$submitted || form_estacionamento.CpfCnpj.$dirty)?'has-error':''">
                    <label for="CpfCnpj">{{objEstacionamento.TipoEmpresa=='J'?'CNPJ':'CPF'}}:</label>
                    <input type="text" name="CpfCnpj" id="CpfCnpj" class="form-control" ng-model="objEstacionamento.CpfCnpj" ui-br-cnpj-mask ng-disabled="EstacionamentoId" ng-if="objEstacionamento.TipoEmpresa=='J'" ng-required="true">
                    <input type="text" name="CpfCnpj" id="CpfCnpj" class="form-control" ng-model="objEstacionamento.CpfCnpj" ui-br-cpf-mask ng-disabled="EstacionamentoId" ng-if="objEstacionamento.TipoEmpresa=='F'" ng-required="true">
                </div>
                <div class="col-sm-3" ng-class="form_estacionamento.PrecoLivre.$error.required && (form_estacionamento.$submitted || form_estacionamento.PrecoLivre.$dirty)?'has-error':''">
                    <label for="PrecoLivre">Preço Livre</label>
                    <input type="text" name="PrecoLivre" id="PrecoLivre" class="form-control" ng-model="objEstacionamento.PrecoLivre" ng-required="true" ui-number-mask="2">
                </div>
                <div class="col-sm-3" ng-class="form_estacionamento.PrecoHora.$invalid && (form_estacionamento.$submitted || form_estacionamento.PrecoHora.$dirty)?'has-error':''">
                    <label for="PrecoHora">Preço Hora</label>
                    <input type="text" name="PrecoHora" id="PrecoHora" class="form-control" ng-model="objEstacionamento.PrecoHora" ng-required="true" ui-number-mask="2">
                </div>
                <div class="col-sm-2" ng-class="form_estacionamento.NumeroVagas.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroVagas.$dirty)?'has-error':''">
                    <label for="NumeroVagas">Qtd. Vagas</label>
                    <input type="text" name="NumeroVagas" id="NumeroVagas" class="form-control" ng-model="objEstacionamento.NumeroVagas" ng-required="true" somentenumeros>
                </div>
            </div>
        </div><br>
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
        </div><br>

        <div class="callout callout-default">
            <h4 class="text-center">Contato</h4>
            <div class="row form-group">
                <div class="col-sm-4" ng-class="form_estacionamento.NumeroTelefone1.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroTelefone1.$dirty)?'has-error':''">
                    <label for="NumeroTelefone1">Celular</label>
                    <input type="text" name="NumeroTelefone1" id="NumeroTelefone1" class="form-control" ng-model="objEstacionamento.NumeroTelefone1" ng-required="true" ui-br-phone-number-mask="areaCode">
                </div>
                <div class="col-sm-4" ng-class="form_estacionamento.NumeroTelefone2.$invalid && (form_estacionamento.$submitted || form_estacionamento.NumeroTelefone2.$dirty)?'has-error':''">
                    <label for="NumeroTelefone2">Telefone</label>
                    <input type="text" name="NumeroTelefone2" id="NumeroTelefone2" class="form-control" ng-model="objEstacionamento.NumeroTelefone2" ui-br-phone-number-mask="areaCode">
                </div>
                <div class="col-sm-4" ng-class="form_estacionamento.Email.$invalid && (form_estacionamento.$submitted || form_estacionamento.Email.$dirty)?'has-error':''">
                    <label for="Email">E-mail</label>
                    <input type="email" name="Email" id="Email" class="form-control" ng-model="objEstacionamento.Email" ng-required="true">
                </div>
            </div>
        </div> <br>

        <div class="row form-group text-center">
            <button type="submit" form="form_estacionamento" class="btn btn-success form-control" style="width:250px;">Salvar</button>
        </div>
    </form>
    
    <script>
        var base_url_externo = "<?php echo base_url().'index.php/'; ?>";
        var EstacionamentoId = "<?php echo $EstacionamentoId; ?>";
    </script>
</div>

         
