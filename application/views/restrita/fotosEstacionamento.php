
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <a type="button" href="index" class="btn btn-default">
                <i class="glyphicon glyphicon-arrow-left"></i>
                Voltar
            </a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadFoto">
                <i class="glyphicon glyphicon-plus"></i>
                Nova
            </button>
        </div>
    </div>

    <h2>Fotos >> {{objEstacionamento.NomeEstacionamento}}</h2><br>

    <div class="row">
        <div class="col-sm-6">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th width="60%" class="text-center">Imagem</th>
                        <th class="text-center">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="lista_fotos.length<=0">
                        <td colspan="3" class="text-center">Nenhuma foto cadastrada ainda.</td>
                    </tr>
                    <tr ng-repeat="l in lista_fotos">
                         <td class="text-center">
                            {{$index+1}}
                        </td>
                        <td class="text-center">
                            <img src="<?= URL_ARQUIVOS ?>{{l.UrlFoto}}" style="width:50%">
                        </td>
                        <td class="text-center">
                            <button ng-click="excluirFoto(l)" class="btn btn-danger btn-sm">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="modalCadFoto" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cadastrar Foto</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert" ng-show="mensagem">
                        {{mensagem}}
                    </div>
                    <input type="file" file-input="files" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default">Fechar</button>
                    <button type="button" class="btn btn-success" ng-click="setFoto()">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var EstacionamentoId = "<?php echo $EstacionamentoId; ?>";
    </script>
</div>

         
