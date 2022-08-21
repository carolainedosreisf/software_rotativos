<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" id="form" name="form_login" ng-submit="getValidaAcesso()" novalidate autocomplete="off">
                <span class="login100-form-title p-b-26">Login</span>
                <div class="row form-group">
                    <div class="alert alert-danger" role="alert" ng-show="form_login.NomeUsuario.$error.required && form_login.$submitted">
                        Preencha o campo nome usuário.
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="form_login.Senha.$error.required && form_login.$submitted">
                        Preencha o campo senha.
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="mensagem">
                        {{mensagem}}
                    </div>
                </div>
                <div class="row form-group" ng-class="form_login.NomeUsuario.$invalid && (form_login.$submitted || form_login.NomeUsuario.$dirty)?'has-error':''">
                    <label for="NomeUsuario">Nome Usuário:</label><br>
                    <input type="text" name="NomeUsuario" id="NomeUsuario" ng-model="login.NomeUsuario" ng-required="true">
                </div>
                <div class="row form-group" ng-class="form_login.Senha.$invalid && (form_login.$submitted || form_login.Senha.$dirty)?'has-error':''">
                    <label for="Senha">Senha:</label><br>
                    <input type="password" name="Senha" id="Senha" ng-model="login.Senha" ng-required="true">
                </div>
                <div class="text-center">
                    <button type="submit" class="main_bt">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
