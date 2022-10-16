<div class="limiter" style="background: #f2f2f2;">
    <div class="underlined-title" style="padding-top:50px;">
        <div class="editContent">
            <h1 class="text-center latestitems">Login</h1>
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
            <form class="login100-form validate-form" id="form" name="form_login" ng-submit="getValidaAcesso()" novalidate autocomplete="off">
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
                <div class="row text-center">
                    <button type="submit" style="width:100%" class="main_btn">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
