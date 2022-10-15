<div id="content" class="container" style="width:100%;">
    <h2>Bem vindo(a) <?php echo $this->session->userdata('nome'); ?></h2><br>
    <?php if($PermissaoId==2||$PermissaoId==3){ ?>
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="alert {{verificacao.alert}}" role="alert">
                <span ng-bind-html="verificacao.DescSituacao"></span>
                <span ng-show="verificacao.Situacao>2">
                    <br><br>
                    Para realizar o pagamento entre em contato com a setor financeiro da empresa do software.
                </span>
                <?php if($PermissaoId==2){ ?>
                <br>
                <a href="<?php echo base_url('index.php/Restrita/Pagamentos'); ?>"class="btn btn-default" style="margin-top:10px;">
                    <i class="glyphicon glyphicon-search"></i>
                    Ver Pagamentos Efetuados
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if($PermissaoId==2||$PermissaoId==1){ ?>
    <form name="form_filtrar" id="form_filtrar" ng-submit="getDadosGrafico()" novalidate>

        <div class="row form-group">
            <div class="col-sm-3" ng-class="form_filtrar.Ano.$invalid && (form_filtrar.$submitted || form_filtrar.Ano.$dirty)?'has-error':''">
                <label for="Ano">Ano:</label>
                <input type="text" class="form-control" id="Ano" name="Ano" ui-mask="9999" ng-model="Ano" ng-required="true">
            </div>
            
            <?php if($PermissaoId==2){ ?>
            <div class="col-sm-3">
                <label for="Mes">Mês:</label>
                <select name="Mes" id="Mes" class="form-control" ng-model="Mes">
                        <option value="">Selecione</option>
                        <option value="{{key}}" ng-repeat="(key,mes) in lista_meses">{{mes}}</option>
                </select>
            </div>
            <?php } ?>

            <div class="col-sm-2">
                <label for="">&nbsp;</label>
                <button type="submit" form="form_filtrar" class="btn btn-primary form-control">
                    <i class="glyphicon glyphicon-search"></i>
                    Filtrar
                </button>
            </div>
        </div>
    </form>
    <div class="row form-group" style="margin-top:40px">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-center">{{title}}</h5>
                </div>
                <div class="panel-body">
                    <div id="myChart" style="width:90%; height:400px" ng-show="lista.length>1"></div>
                    <div class="alert alert-info" role="alert" ng-show="lista.length<=1">
                        Nenhum registro encontrado para o perído selecionado.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script>
    var PermissaoId = <?php echo $PermissaoId; ?>;
    var lista_meses = <?php echo json_encode($lista_meses); ?>;
</script>
