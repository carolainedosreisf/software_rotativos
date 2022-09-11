<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="generator" content="">
	<title>Software para Rotativos</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css'); ?>"/>

	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/angular-sanitize.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>
	<script src="<?php echo base_url("assets/scripts/{$controller}"); ?>"></script>
	<style>
        #notfound {
            position: relative;
            height: 90vh;
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 45%;
            -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);
        }

        .notfound {
            max-width: 767px;
            width: 100%;
            line-height: 1.4;
            padding: 0px 15px;
        }

        .notfound .notfound-404 {
            position: relative;
            height: 150px;
            line-height: 150px;
            margin-bottom: 25px;
        }

        .notfound .notfound-404 h1 {
            font-family: 'Titillium Web', sans-serif;
            font-size: 186px;
            font-weight: 900;
            margin: 0px;
            text-transform: uppercase;
        }

        .notfound h2 {
            font-family: 'Titillium Web', sans-serif;
            font-size: 26px;
            font-weight: 700;
            padding-top:10px;
            margin: 0px;
        }

        .notfound p {
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
            margin-top: 5px;
        }

        .notfound a:hover {
            opacity: 0.8;
        }

        @media only screen and (max-width: 767px) {
            .notfound .notfound-404 {
                height: 110px;
                line-height: 110px;
            }
            .notfound .notfound-404 h1 {
                font-size: 120px;
            }
        }
    </style>
</head>
<body ng-app="app" ng-controller="<?php echo $controller; ?>">
    <div class="limiter" >
        <div ng-hide="retorno==1" id="notfound" style="<?php echo 'background: #f4f4f4 url('.base_url('assets/images/bg.gif').') repeat top left;color: #333;overflow-y: scroll;'?>">
            <div class="notfound">
                <div class="notfound-404">
                    <h1 style="<?php echo 'background: url('.base_url('assets/images/text.png').');-webkit-background-clip: text;-webkit-text-fill-color: #ccc;background-size: cover;background-position: center;'; ?>">404</h1>
                </div>
                <h2>Oops! Parece que este token expirou ou não é mais válido.</h2>
                <p>Para voltar para o login click no botão abaixo.</p>
                <a class="main_btn" href="<?php echo base_url('index.php/Login'); ?>">Login</a>
            </div>
        </div>
        <div class="container-login100" ng-show="retorno==1" style="padding: 100px 0px;">
            <div class="wrap-login100">
                <form class="login100-form validate-form" id="form" name="form_senha" ng-submit="setNovaSenha()" novalidate autocomplete="off">
                    <span class="login100-form-title p-b-26">Cadastrar Senha</span>
                    <div class="row form-group">
                        <div class="alert alert-danger" role="alert" ng-show="form_senha.$error.required && form_senha.$submitted">
                            Preencha os campos destacados.
                        </div>
                        <div class="alert alert-danger" role="alert" ng-show="!(form_senha.$error.required) && form_senha.$submitted && cadSenha.ConfirmSenha!=cadSenha.Senha">
                            As senhas não correspondem.
                        </div>
                    </div>
                    <div ng-show="retorno==1">
                        <div class="row form-group" ng-class="form_senha.Senha.$invalid && (form_senha.$submitted || form_senha.Senha.$dirty)?'has-error':''">
                            <label for="Senha">Senha:</label><br>
                            <input type="password" name="Senha" id="Senha" ng-model="cadSenha.Senha" ng-required="true">
                        </div>
                        <div class="row form-group" ng-class="form_senha.ConfirmSenha.$invalid && (form_senha.$submitted || form_senha.ConfirmSenha.$dirty)?'has-error':''">
                            <label for="ConfirmSenha">Confirmar Senha:</label><br>
                            <input type="password" name="ConfirmSenha" id="ConfirmSenha" ng-model="cadSenha.ConfirmSenha" ng-required="true">
                        </div>
                        <div class="row text-center">
                            <button type="submit" style="width:100%" class="main_btn">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            var LoginId = "<?php echo $LoginId; ?>";
            var retorno = "<?php echo $retorno; ?>";
            var base_url = "<?php echo base_url(); ?>";
        </script>
    </div>
