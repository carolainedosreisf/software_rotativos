<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Administração</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
        
        <link href="<?php echo base_url('assets/css/style_restrita.css'); ?>" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css'); ?>"/>


        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>

	    <script src="<?php echo base_url('assets/js/jquery.inputmask.bundle.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/masks.js'); ?>"></script>
	    <script src="<?php echo base_url('assets/js/ui-mask.js'); ?>"></script>
	    <script src="<?php echo base_url('assets/js/angular-locale_pt-br.js'); ?>"></script>
	    <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
	    <script src="<?php echo base_url('assets/js/sweetalert.min.js'); ?>"></script>

        <script src="<?php echo base_url('assets/js/dirPagination.js'); ?>" language="javascript" type="text/javascript"></script>
	    <!-- <script src="<?php //echo base_url('assets/js/jquery.mask.js'); ?>"></script> -->
        <script src="<?php echo base_url('assets/js/angular-sanitize.min.js'); ?>"></script>

	    <script src="<?php echo base_url('assets/js/angular-input-masks-standalone.min.js'); ?>"></script>
        <script src="<?php echo base_url("assets/scripts/restrita/{$controller}"); ?>"></script>

    </head>
    <body ng-app="app" ng-controller="<?php echo $controller; ?>">
	    <script> var base_url = "<?php echo base_url();?>index.php/restrita";</script>
        <?php $EmpresaSoftware = $this->funcoes->getEmpresaSoftware();?>

        <div class="loading ng-hide" ng-show="carregando">
            <img class="loading-img" src="<?php echo base_url('assets/images/load.gif'); ?>">
        </div>
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>
                        <?php echo $EmpresaSoftware['Nome']; ?>
                    </h3>
                </div>

                <ul class="list-unstyled components">
                    <li><a href="<?php echo base_url('index.php/restrita/Home'); ?>">Home</a></li>

                    <?php if($this->session->userdata('PermissaoId')==2 && $this->funcoes->verificaSituacaoEmpresa()<=2){ ?>
                    <li><a href="<?php echo base_url('index.php/restrita/Estacionamento'); ?>">Perfil Empresa</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('PermissaoId')==2){ ?>
                    <li><a href="<?php echo base_url('index.php/restrita/Pagamentos'); ?>">Pagamento</a></li>
                    <?php } ?>


                    <?php if($this->session->userdata('PermissaoId')==1){ ?>
                    <li><a href="<?php echo base_url('index.php/restrita/PerfilEmpresa'); ?>">Perfil Empresa</a></li>
                    <li><a href="<?php echo base_url('index.php/restrita/FormaPagamento'); ?>">Formas de Pagamento</a></li>
                    <li><a href="<?php echo base_url('index.php/restrita/DiasAtendimento'); ?>">Dias de Atendimento</a></li>
                    <li><a href="<?php echo base_url('index.php/restrita/Clientes'); ?>">Clientes</a></li>
                    <?php } ?>

                    <?php if(($this->session->userdata('PermissaoId')==2||$this->session->userdata('PermissaoId')==3)&&$this->funcoes->verificaSituacaoEmpresa()<=2){ ?>
                    <li><a href="<?php echo base_url('index.php/restrita/FluxoVaga'); ?>">Locações de Vagas</a></li>
                    <li><a href="<?php echo base_url('index.php/restrita/FluxoVaga/reservas'); ?>">Reservas de Vagas</a></li>
                    <?php } ?>

                    <li><a href="<?php echo base_url('index.php/Login/sair'); ?>">Sair</a></li>
                </ul>
            </nav>