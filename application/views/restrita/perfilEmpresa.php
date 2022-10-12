
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
        </div>
    </div>
    <h2>Perfil Empresa</h2><br>
    <form name="form_empresa" id="form_empresa" novalidate autocomplete="off" ng-submit="setEmpresa()">
        <div id="mensagens">
            <div class="alert alert-danger" role="alert" ng-show="form_empresa.Email.$invalid && !(form_empresa.Email.$error.required) && (form_empresa.$submitted || form_empresa.Email.$dirty)">
                E-mail Inválido!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="(form_empresa.NumeroTelefone1.$invalid && !(form_empresa.NumeroTelefone1.$error.required) && (form_empresa.$submitted || form_empresa.NumeroTelefone1.$dirty)) || (form_empresa.NumeroTelefone2.$invalid && !(form_empresa.NumeroTelefone2.$error.required) && (form_empresa.$submitted || form_empresa.NumeroTelefone2.$dirty))">
                Telefone Inválido!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="form_empresa.$error.required && form_empresa.$submitted">
                Preencha os campos destacados!
            </div>
            <div class="alert alert-danger" role="alert" ng-show="erro_cep">
                CEP Inválido!
            </div>
            
        </div>
        <div class="callout callout-default">
            <h4 class="text-center">Empresa</h4>
            <div class="row form-group">
                <div class="col-sm-3">
                    <label for="EmpresaId">Código:</label>
                    <input type="text" class="form-control" ng-value="objEmpresa.EmpresaId" ng-disabled="true">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-4">
                    <label for="Nome">Nome Empresa:</label>
                    <input type="text" name="Nome" id="Nome" class="form-control" ng-value="objEmpresa.Nome" ng-required="true">
                </div>
                <div class="col-sm-3" ng-class="form_empresa.RazaoSocial.$invalid && (form_empresa.$submitted || form_empresa.RazaoSocial.$dirty)?'has-error':''">
                    <label for="RazaoSocial">Razão Social:</label>
                    <input type="text" name="RazaoSocial" id="RazaoSocial" class="form-control" ng-model="objEmpresa.RazaoSocial" maxlength="100" ng-required="true">
                </div>
                <div class="col-sm-2" ng-class="form_empresa.TipoEmpresa.$invalid && (form_empresa.$submitted || form_empresa.TipoEmpresa.$dirty)?'has-error':''">
                    <label for="TipoEmpresa">Tipo:</label>
                    <select name="" id="TipoEmpresa" id="TipoEmpresa" class="form-control" ng-model="objEmpresa.TipoEmpresa" ng-disabled="true">
                        <option value="J">Jurídica</option>
                        <option value="F">Física</option>
                    </select>
                </div>
                <div class="col-sm-3" ng-class="form_empresa.CpfCnpj.$invalid && (form_empresa.$submitted || form_empresa.CpfCnpj.$dirty)?'has-error':''">
                    <label for="CpfCnpj">{{objEmpresa.TipoEmpresa=='J'?'CNPJ':'CPF'}}:</label>
                    <input type="text" name="CpfCnpj" id="CpfCnpj" class="form-control" ng-model="objEmpresa.CpfCnpj" ui-br-cnpj-mask ng-if="objEmpresa.TipoEmpresa=='J'" ng-disabled="true">
                    <input type="text" name="CpfCnpj" id="CpfCnpj" class="form-control" ng-model="objEmpresa.CpfCnpj" ui-br-cpf-mask ng-if="objEmpresa.TipoEmpresa=='F'" ng-disabled="true">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12" ng-class="form_empresa.Sobre.$invalid && (form_empresa.$submitted || form_empresa.Sobre.$dirty)?'has-error':''">
                    <label for="Sobre">Sobre:</label>
                    <textarea name="Sobre" id="Sobre" class="form-control" rows="5" class="formcontrol" ng-model="objEmpresa.Sobre" ng-required="true"></textarea>
                </div>
            </div>
        </div><br>

        <div class="callout callout-default">
            <h4 class="text-center">Endereço</h4>
            <div class="row form-group">
                <div class="col-sm-4" ng-class="erro_cep || form_empresa.NumeroCep.$invalid && (form_empresa.$submitted || form_empresa.NumeroCep.$dirty)?'has-error':''">
                    <label for="NumeroCep">CEP:</label>
                    <input type="text" name="NumeroCep" id="NumeroCep" class="form-control" ng-model="objEmpresa.NumeroCep" ui-mask="99999-999" ngrequired="true" ng-change="buscaCep()" ng-required="true">
                </div>
                <div class="col-sm-4" ng-class="form_empresa.BairroEndereco.$invalid && (form_empresa.$submitted || form_empresa.BairroEndereco.$dirty)?'has-error':''">
                    <label for="BairroEndereco">Bairro:</label>
                    <input type="text" name="BairroEndereco" id="BairroEndereco" class="form-control" ng-model="objEmpresa.BairroEndereco" maxlength="80" ng-required="true">
                </div>
                <div class="col-sm-4" ng-class="form_empresa.CidadeId.$invalid && (form_empresa.$submitted || form_empresa.CidadeId.$dirty)?'has-error':''">
                    <label for="CidadeId">Cidade:</label>
                    <select type="text" name="CidadeId" id="CidadeId" class="form-control" ng-model="objEmpresa.CidadeId" ng-required="true">
                        <option value="">Selecione</option>
                        <option value="{{l.CidadeId}}" ng-repeat="l in lista_cidades">{{l.NomeCidade}} ({{l.Estado}})</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-2" ng-class="form_empresa.NumeroEndereco.$invalid && (form_empresa.$submitted || form_empresa.NumeroEndereco.$dirty)?'has-error':''">
                    <label for="NumeroEndereco">Número:</label>
                    <input type="text" name="NumeroEndereco" id="NumeroEndereco" class="form-control" ng-model="objEmpresa.NumeroEndereco" maxlength="5" somentenumeros ng-required="true">
                </div>
                <div class="col-sm-6" ng-class="form_empresa.Endereco.$invalid && (form_empresa.$submitted || form_empresa.Endereco.$dirty)?'has-error':''">
                    <label for="Endereco">Endereço:</label>
                    <input type="text" name="Endereco" id="Endereco" class="form-control" ng-model="objEmpresa.Endereco" maxlength="80" ng-required="true">
                </div>
                <div class="col-sm-4">
                    <label for="Complemento">Complemento:</label>
                    <input type="text" name="Complemento" id="Complemento" class="form-control" ng-model="objEmpresa.Complemento" maxlength="45">
                </div>
            </div>
        </div><br>

        <div class="callout callout-default">
            <h4 class="text-center">Contato</h4>
            <div class="row form-group">
                <div class="col-sm-4" ng-class="form_empresa.NumeroTelefone1.$invalid && (form_empresa.$submitted || form_empresa.NumeroTelefone1.$dirty)?'has-error':''">
                    <label for="NumeroTelefone1">Telefone 1</label>
                    <input type="text" name="NumeroTelefone1" id="NumeroTelefone1" class="form-control" ng-model="objEmpresa.NumeroTelefone1" ng-required="true" ui-br-phone-number-mask="areaCode">
                </div>
                <div class="col-sm-4" ng-class="form_empresa.NumeroTelefone2.$invalid && (form_empresa.$submitted || form_empresa.NumeroTelefone2.$dirty)?'has-error':''">
                    <label for="NumeroTelefone2">Telefone 2</label>
                    <input type="text" name="NumeroTelefone2" id="NumeroTelefone2" class="form-control" ng-model="objEmpresa.NumeroTelefone2" ui-br-phone-number-mask="areaCode">
                </div>
                <div class="col-sm-4" ng-class="form_empresa.Email.$invalid && (form_empresa.$submitted || form_empresa.Email.$dirty)?'has-error':''">
                    <label for="Email">E-mail</label>
                    <input type="email" name="Email" id="Email" class="form-control" ng-model="objEmpresa.Email" ng-required="true">
                </div>
            </div>
        </div> <br>

        <div class="row form-group text-center">
            <button type="submit" form="form_empresa" class="btn btn-success form-control" style="width:250px;">Salvar</button>
        </div>
    </form>
</div>

         
