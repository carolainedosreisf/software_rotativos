<div class="limiter" style="background: #f2f2f2;">
    <div class="underlined-title" style="padding-top:50px;">
        <div class="editContent">
            <h1 class="text-center latestitems">{{esqueci?'Esqueci a senha':'Login'}}</h1>
        </div>
        <div class="wow-hr type_short">
            <span class="wow-hr-h">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </span>
        </div>
    </div>
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" id="form" name="form_login" ng-submit="getValidaAcesso()" novalidate autocomplete="off" ng-show="!esqueci">
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
                <div class="row" ng-class="form_login.Senha.$invalid && (form_login.$submitted || form_login.Senha.$dirty)?'has-error':''">
                    <label for="Senha">Senha:</label><br>
                    <input type="password" name="Senha" id="Senha" ng-model="login.Senha" ng-required="true">
                </div>
                <div class="row form-group text-right">
                    <a htef="#" ng-click="esqueci=!esqueci" class="cursor-pointer" style="text-decoration: underline;">Esqueceu a senha?</a>
                </div>
                <div class="row text-center">
                    <button type="submit" style="width:100%" class="main_btn">Entrar</button>
                </div>
            </form>

            <form class="login100-form validate-form" id="form" name="form_senha" ng-submit="gerarToken()" novalidate autocomplete="off" ng-show="esqueci">
                <div class="row form-group">
                    <div class="alert alert-danger" role="alert" ng-show="form_senha.Email.$invalid && !(form_senha.Email.$error.required) && (form_senha.$submitted || form_senha.Email.$dirty)">
                        E-mail Inválido.
                    </div>
                </div>
                <div class="row form-group">
                    <div class="alert alert-danger" role="alert" ng-show="form_senha.Email.$error.required && form_senha.$submitted">
                        Preencha o campo E-mail.
                    </div>
                </div>
                <div class="row form-group" ng-class="form_senha.Email.$invalid && (form_senha.$submitted || form_senha.Email.$dirty)?'has-error':''">
                    <label for="Email">E-mail:</label><br>
                    <input type="email" name="Email" id="Email" ng-model="EsqueciSenha.Email" ng-required="true">
                </div>
                <div class="row form-group text-right">
                    <a htef="#" ng-click="esqueci=!esqueci" class="cursor-pointer" style="text-decoration: underline;">Voltar ao Login</a>
                </div>
                <div class="row text-center">
                    <button type="submit" style="width:100%" class="main_btn">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
