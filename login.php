<?php 
    $controller = "loginController";
    include 'header.php';
?>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" id="form" name="form_login" ng-submit="setSessao()" novalidate autocomplete="off">
                    <span class="login100-form-title p-b-26">Login</span>
                    <div class="row form-group">
                        <div class="alert alert-danger" role="alert" ng-show="form_login.ed_email.$invalid && !(form_login.ed_email.$error.required) && form_login.$submitted">
                            Preencha um e-mail válido.
                        </div>
                        <div class="alert alert-danger" role="alert" ng-show="form_login.ed_email.$error.required && form_login.$submitted">
                            Preencha o campo e-mail.
                        </div>
                        <div class="alert alert-danger" role="alert" ng-show="form_login.senha.$error.required && form_login.$submitted">
                            Preencha o campo senha.
                        </div>
                    </div>
                    <div class="row form-group" ng-class="form_login.ed_email.$invalid && (form_login.$submitted || form_login.ed_email.$dirty)?'has-error':''">
                        <label for="ed_email">E-mail:</label><br>
                        <input type="email" name="ed_email" ng-model="login.ed_email" ng-required="true">
                    </div>
                    <div class="row form-group" ng-class="form_login.senha.$invalid && (form_login.$submitted || form_login.senha.$dirty)?'has-error':''">
                        <label for="senha">Senha:</label><br>
                        <input type="password" name="senha" ng-model="login.senha" ng-required="true">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="main_bt">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>
