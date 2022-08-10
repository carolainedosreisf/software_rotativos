<?php 
    $controller = "cadastroController";
    include 'header.php' 
?>

<section class="item content" style="margin-top:50px;margin-bottom:50px;">
    <script>var cadastro = 1;</script>

    <div class="container toparea">
        <div class="underlined-title">
            <div class="editContent">
                <h1 class="text-center latestitems">Casdastro</h1>
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
                    <div class="alert alert-danger" role="alert" ng-show="form_cadastro.name_4.$invalid && !(form_cadastro.name_4.$error.required) && (form_cadastro.$submitted || form_cadastro.nr_cpf.$dirty)">
                        CNPJ Inválido!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="form_cadastro.name_5.$invalid && !(form_cadastro.name_5.$error.required) && (form_cadastro.$submitted || form_cadastro.nr_cpf.$dirty)">
                        CPF Inválido!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="form_cadastro.name_13.$invalid && !(form_cadastro.name_13.$error.required) && (form_cadastro.$submitted || form_cadastro.nr_cpf.$dirty)">
                        E-mail Inválido!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="cad.senha != cad.confirm_senha && !(form_cadastro.senha.$error.required) && !(form_cadastro.confirm_senha.$error.required) && (form_cadastro.$submitted || form_cadastro.nr_cpf.$dirty)">
                        As senhas não correspondem!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="form_cadastro.$error.required && form_cadastro.$submitted">
                        Preencha os campos destacados!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="erro_cep">
                        CEP Inválido!
                    </div>
                </div>
                
                <form id="contactform" name="form_cadastro" novalidate ng-submit="setCadastro()">
                    <div class="form">
                        <div class="painel">
                            <div class="titulo-painel">Dados Cadastrais</div>
                            <div class="corpo-painel">
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.name_1.$invalid && (form_cadastro.$submitted || form_cadastro.name_1.$dirty)?'has-error':''">
                                        <label for="name_1">Nome:</label>
                                        <input type="text" name="name_1" ng-model="cad.name_1" autocomplete="off" ng-required="true" maxlength="50">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.name_2.$invalid && (form_cadastro.$submitted || form_cadastro.name_2.$dirty)?'has-error':''">
                                        <label for="name_2">Razão Social:</label>
                                        <input type="text" name="name_2" ng-model="cad.name_2" autocomplete="off" ng-required="true" maxlength="50">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.name_3.$invalid && (form_cadastro.$submitted || form_cadastro.name_3.$dirty)?'has-error':''">
                                        <label for="name_3">Tipo:</label>
                                        <select name="" id="name_3" ng-model="cad.name_3" ng-required="true" ng-change="changeTipo()">
                                            <option value="J">Jurídica</option>
                                            <option value="F">Física</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6" ng-show="cad.name_3=='J'" ng-class="form_cadastro.name_4.$invalid && (form_cadastro.$submitted || form_cadastro.name_4.$dirty)?'has-error':''">
                                        <label for="name_4">CNPJ:</label>
                                        <input type="text" name="name_4" ng-model="cad.name_4" ui-br-cnpj-mask autocomplete="off" ng-required="cad.name_3=='J'">
                                    </div>
                                    <div class="col-sm-6" ng-show="cad.name_3=='F'" ng-class="form_cadastro.name_5.$invalid && (form_cadastro.$submitted || form_cadastro.name_5.$dirty)?'has-error':''">
                                        <label for="name_5">CPF:</label>
                                        <input type="text" name="name_5" ng-model="cad.name_5" ui-br-cpf-mask autocomplete="off" ng-required="cad.name_3=='F'">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.name_6.$invalid && (form_cadastro.$submitted || form_cadastro.name_6.$dirty)?'has-error':''">
                                        <label for="name_6">Telefone:</label>
                                        <input type="text" id="name_6" name="name_6" ng-model="cad.name_6" autocomplete="off" ui-br-phone-number-mask="areaCode">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.name_7.$invalid && (form_cadastro.$submitted || form_cadastro.name_7.$dirty)?'has-error':''">
                                        <label for="name_7">Celular:</label>
                                        <input type="text" id="name_7" name="name_7" ng-model="cad.name_7" autocomplete="off" ui-br-phone-number-mask="areaCode" ng-required="true">
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
                                    <div class="col-sm-6" ng-class="erro_cep || form_cadastro.name_8.$invalid && (form_cadastro.$submitted || form_cadastro.name_8.$dirty)?'has-error':''">
                                        <label for="name_8">CEP:</label>
                                        <input type="text" ui-mask="99999-999" name="name_8" autocomplete="off" ng-model="cad.name_8" required="required" ng-change="buscaCep()">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.name_9.$invalid && (form_cadastro.$submitted || form_cadastro.name_9.$dirty)?'has-error':''">
                                        <label for="cidade">Cidade:</label>
                                        <input type="text" name="name_9" autocomplete="off" ng-model="cad.name_9" required="required" maxlength="80">
                                        <!-- <select name="name_9" id="name_9" autocomplete="off" ng-model="cad.name_9">
                                            <option value="">Selecione...</option>
                                            <option value="{{l.name_9}}" ng-repeat="l in lista_cidades">{{l.nm_cidade}}</option>
                                        </select> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3" ng-class="form_cadastro.name_10.$invalid && (form_cadastro.$submitted || form_cadastro.name_10.$dirty)?'has-error':''">
                                        <label for="name_10">Número:</label>
                                        <input type="text" name="name_10" autocomplete="off" ng-model="cad.name_10" required="required" maxlength="5">
                                    </div>
                                    <div class="col-sm-9" ng-class="form_cadastro.name_11.$invalid && (form_cadastro.$submitted || form_cadastro.name_11.$dirty)?'has-error':''">
                                        <label for="name_11">Endereço:</label>
                                        <input type="text" name="name_11" autocomplete="off" ng-model="cad.name_11" required="required" maxlength="80">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.name_12.$invalid && (form_cadastro.$submitted || form_cadastro.name_12.$dirty)?'has-error':''">
                                        <label for="name_12">Bairro:</label>
                                        <input type="text" name="name_12" autocomplete="off" ng-model="cad.name_12" required="required" maxlength="50">
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
                                    <div class="col-sm-12" ng-class="form_cadastro.name_13.$invalid && (form_cadastro.$submitted || form_cadastro.name_13.$dirty)?'has-error':''">
                                        <label for="name_13">E-mail:</label>
                                        <input type="email" name="name_13" autocomplete="off" ng-model="cad.name_13" required="required" maxlength="80">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.senha.$invalid && (form_cadastro.$submitted || form_cadastro.senha.$dirty)?'has-error':''">
                                        <label for="senha">Senha:</label>
                                        <input type="password" name="senha" autocomplete="off" ng-model="cad.senha" required="required" maxlength="20">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.confirm_senha.$invalid && (form_cadastro.$submitted || form_cadastro.confirm_senha.$dirty)?'has-error':''">
                                        <label for="confirm_senha">Confirmar Senha:</label>
                                        <input type="password" name="confirm_senha" autocomplete="off" ng-model="cad.confirm_senha" required="required" maxlength="20">
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
<?php include 'footer.php' ?>
