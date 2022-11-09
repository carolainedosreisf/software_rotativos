<section class="item content" style="margin-top:50px;margin-bottom:50px;">
    <div class="container toparea">
        <div class="underlined-title">
            <div class="editContent">
                <h1 class="text-center latestitems">Cadastro</h1>
            </div>
            <div class="wow-hr type_short">
                <span class="wow-hr-h">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div id="mensagens">
                    <div class="alert alert-danger" role="alert" ng-show="cad.TipoEmpresa == 'J' && form_cadastro.Cnpj.$invalid && !(form_cadastro.Cnpj.$error.required) && (form_cadastro.$submitted || form_cadastro.Cnpj.$dirty)">
                        CNPJ Inválido!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="cad.TipoEmpresa == 'F' && form_cadastro.Cpf.$invalid && !(form_cadastro.Cpf.$error.required) && (form_cadastro.$submitted || form_cadastro.Cpf.$dirty)">
                        CPF Inválido!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="form_cadastro.Email.$invalid && !(form_cadastro.Email.$error.required) && (form_cadastro.$submitted || form_cadastro.Email.$dirty)">
                        E-mail Inválido!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="cad.Senha.length < 8 && !(form_cadastro.Senha.$error.required) && !(form_cadastro.confirm_senha.$error.required) && (form_cadastro.$submitted || form_cadastro.Senha.$dirty)">
                        A senha deve conter no mínimo 8 caracteres!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="cad.Senha != cad.confirm_senha && !(form_cadastro.Senha.$error.required) && !(form_cadastro.confirm_senha.$error.required) && (form_cadastro.$submitted || form_cadastro.confirm_senha.$dirty)">
                        As senhas não correspondem!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="form_cadastro.$error.required && form_cadastro.$submitted">
                        Preencha os campos destacados!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="erro_cep">
                        CEP Inválido!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-repeat="erro in lista_erros">
                        {{erro}}
                    </div>
                    
                </div>
                
                <form id="contactform" name="form_cadastro" novalidate ng-submit="setCadastro()">
                    <div class="form">
                        <div class="painel">
                            <div class="titulo-painel">Dados Cadastrais</div>
                            <div class="corpo-painel">
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.Nome.$invalid && (form_cadastro.$submitted || form_cadastro.Nome.$dirty)?'has-error':''">
                                        <label for="Nome">Nome:</label>
                                        <input type="text" name="Nome" id="Nome" ng-model="cad.Nome" autocomplete="off" ng-required="true" maxlength="80">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.RazaoSocial.$invalid && (form_cadastro.$submitted || form_cadastro.RazaoSocial.$dirty)?'has-error':''">
                                        <label for="RazaoSocial">Razão Social:</label>
                                        <input type="text" name="RazaoSocial" id="RazaoSocial" ng-model="cad.RazaoSocial" autocomplete="off" ng-required="true" maxlength="80">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.TipoEmpresa.$invalid && (form_cadastro.$submitted || form_cadastro.TipoEmpresa.$dirty)?'has-error':''">
                                        <label for="TipoEmpresa">Tipo:</label>
                                        <select name="" id="TipoEmpresa" id="TipoEmpresa" ng-model="cad.TipoEmpresa" ng-required="true" ng-change="changeTipo()">
                                            <option value="J">Jurídica</option>
                                            <option value="F">Física</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6" ng-show="cad.TipoEmpresa=='J'" ng-class="form_cadastro.Cnpj.$invalid && (form_cadastro.$submitted || form_cadastro.Cnpj.$dirty)?'has-error':''">
                                        <label for="Cnpj">CNPJ:</label>
                                        <input type="text" name="Cnpj" id="Cnpj" ng-model="cad.Cnpj" ui-br-cnpj-mask autocomplete="off" ng-required="cad.TipoEmpresa=='J'">
                                    </div>
                                    <div class="col-sm-6" ng-show="cad.TipoEmpresa=='F'" ng-class="form_cadastro.Cpf.$invalid && (form_cadastro.$submitted || form_cadastro.Cpf.$dirty)?'has-error':''">
                                        <label for="Cpf">CPF:</label>
                                        <input type="text" name="Cpf" id="Cpf" ng-model="cad.Cpf" ui-br-cpf-mask autocomplete="off" ng-required="cad.TipoEmpresa=='F'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.NumeroTelefone1.$invalid && (form_cadastro.$submitted || form_cadastro.NumeroTelefone1.$dirty)?'has-error':''">
                                        <label for="NumeroTelefone1">Celular:</label>
                                        <input type="text" name="NumeroTelefone1" id="NumeroTelefone1" ng-model="cad.NumeroTelefone1" autocomplete="off" ui-br-phone-number-mask="areaCode" ng-required="true">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.NumeroTelefone2.$invalid && (form_cadastro.$submitted || form_cadastro.NumeroTelefone2.$dirty)?'has-error':''">
                                        <label for="NumeroTelefone2">Telefone:</label>
                                        <input type="text" id="NumeroTelefone2" name="NumeroTelefone2" ng-model="cad.NumeroTelefone2" autocomplete="off" ui-br-phone-number-mask="areaCode">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="painel">
                            <div class="titulo-painel">
                                Dados Endereço
                            </div>
                            <div class="corpo-painel">
                                <div class="row">
                                    <div class="col-sm-6" ng-class="erro_cep || form_cadastro.NumeroCep.$invalid && (form_cadastro.$submitted || form_cadastro.NumeroCep.$dirty)?'has-error':''">
                                        <label for="NumeroCep">CEP:</label>
                                        <input type="text" ui-mask="99999-999" name="NumeroCep" id="NumeroCep" autocomplete="off" ng-model="cad.NumeroCep" required="required" ng-change="buscaCep()">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.CidadeId.$invalid && (form_cadastro.$submitted || form_cadastro.CidadeId.$dirty)?'has-error':''">
                                        <label for="CidadeId">Cidade:</label>
                                        <select name="CidadeId" id="CidadeId" autocomplete="off" ng-model="cad.CidadeId" ng-required="true">
                                            <option value="">Selecione...</option>
                                            <option value="{{l.CidadeId}}" ng-repeat="l in lista_cidades">{{l.NomeCidade}} ({{l.Estado}})</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3" ng-class="form_cadastro.NumeroEndereco.$invalid && (form_cadastro.$submitted || form_cadastro.NumeroEndereco.$dirty)?'has-error':''">
                                        <label for="NumeroEndereco">Número:</label>
                                        <input type="text" name="NumeroEndereco" id="NumeroEndereco" autocomplete="off" ng-model="cad.NumeroEndereco" required="required" maxlength="5" somentenumeros>
                                    </div>
                                    <div class="col-sm-9" ng-class="form_cadastro.Endereco.$invalid && (form_cadastro.$submitted || form_cadastro.Endereco.$dirty)?'has-error':''">
                                        <label for="Endereco">Endereço:</label>
                                        <input type="text" name="Endereco" id="Endereco" autocomplete="off" ng-model="cad.Endereco" required="required" maxlength="80">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.BairroEndereco.$invalid && (form_cadastro.$submitted || form_cadastro.BairroEndereco.$dirty)?'has-error':''">
                                        <label for="BairroEndereco">Bairro:</label>
                                        <input type="text" name="BairroEndereco" id="BairroEndereco" autocomplete="off" ng-model="cad.BairroEndereco" required="required" maxlength="50">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="painel">
                            <div class="titulo-painel">
                                Dados Login
                            </div>
                            <div class="corpo-painel">
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.Email.$invalid && (form_cadastro.$submitted || form_cadastro.Email.$dirty)?'has-error':''">
                                        <label for="Email">E-mail:</label>
                                        <input type="email" name="Email" id="Email" autocomplete="off" ng-model="cad.Email" required="required" maxlength="80">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.NomeUsuario.$invalid && (form_cadastro.$submitted || form_cadastro.NomeUsuario.$dirty)?'has-error':''">
                                        <label for="NomeUsuario">Nome Usuário:</label>
                                        <input type="text" name="NomeUsuario" id="NomeUsuario" autocomplete="off" ng-model="cad.NomeUsuario" required="required" maxlength="50">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.Senha.$invalid && (form_cadastro.$submitted || form_cadastro.Senha.$dirty)?'has-error':''">
                                        <label for="Senha">Senha:</label>
                                        <input type="password" name="Senha" id="Senha" autocomplete="off" ng-model="cad.Senha" required="required" maxlength="20">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.confirm_senha.$invalid && (form_cadastro.$submitted || form_cadastro.confirm_senha.$dirty)?'has-error':''">
                                        <label for="confirm_senha">Confirmar Senha:</label>
                                        <input type="password" name="confirm_senha" id="confirm_senha" autocomplete="off" ng-model="cad.confirm_senha" required="required" maxlength="20">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-large-black">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
