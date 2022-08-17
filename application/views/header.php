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
	<link rel="stylesheet"  type="text/css" href="<?php echo base_url('assets/css/owl.carousel.css'); ?>"/>
	<link rel="stylesheet"  type="text/css" href="<?php echo base_url('assets/css/owl.theme.default.css'); ?>"/>
	<link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css'); ?>"/>

	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.inputmask.bundle.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/angular-br-filters.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/angular-sanitize.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/masks.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/ui-mask.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/angular-locale_pt-br.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>

	<script src="<?php echo base_url("assets/scripts/{$controller}"); ?>"></script>
	<script src="<?php echo base_url('assets/js/angular-input-masks-standalone.min.js'); ?>"></script>
	
</head>
<body ng-app="app" ng-controller="<?php echo $controller; ?>">
<div class="loading ng-hide" ng-show="carregando">
	<img class="loading-img" src="<?php echo base_url('assets/images/load.gif'); ?>">
</div>
<header class="margin-top-0">
	<div class="barra-topo">
		<div class="text-homeimage text-center">
			<div class="maintext-image" data-scrollreveal="enter top over 1.5s after 0.1s">
				[NOME DA EMPRESA]
			</div>
		</div>
	</div>
	<div class="wrapper">
		<nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg bg-light">
		<div class="">
			<div class="navbar-header">
				<button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
					<i class="fa fa-bars"></i>
					<span class="sr-only"></span>
				</button>
			</div>
			<div id="navbar-collapse-02" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="propClone"><a href="<?php echo base_url('index.php');?>">Sobre</a></li>
					<li class="propClone"><a href="<?php echo base_url('index.php/Contato'); ?>">Contato</a></li>
					<li class="propClone"><a href="<?php echo base_url('index.php/Login'); ?>">Login</a></li>
					<li class="propClone"><a href="<?php echo base_url('index.php/Cadastro');?>">Cadastro</a></li>
				</ul>
			</div>
		</div>
		</nav>
	</div>
</header>
