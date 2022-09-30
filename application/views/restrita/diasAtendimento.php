
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button type="button" ng-click="openModalCad()" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Novo
            </button>
        </div>
    </div>

    <h2>Dias de Atendimento</h2><br>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="10%">#</th>
                        <th>Descrição</th>
                        <th class="text-center" width="10%">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_dias_atendimento).length <=0">
                        <td class="text-center" colspan="3">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr ng-repeat="l in lista_dias_atendimento">
                        <td class="text-center">{{l.DiasAtendimentoId}}</td>
                        <td>{{l.Descricao}}</td>
                        <td class="text-center">
                            <button ng-click="openModalCad(l)" class="btn btn-primary btn-sm">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="cadDiasAtendimento" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{txt_modal}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-group" ng-show="form_dias_arendimento.$invalid && form_dias_arendimento.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>
                    <form name="form_dias_arendimento" id="form_dias_arendimento" novalidate ng-submit="setDiasAtendimento()">
                        <div class="row form-group" ng-show="cad.DiasAtendimentoId">
                            <div class="col-sm-3">
                                <label for="DiasAtendimentoId">Código:</label>
                                <input type="text" class="form-control" name="DiasAtendimentoId" id="DiasAtendimentoId" autocomplete="off" ng-model="cad.DiasAtendimentoId" ng-disabled="true">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_dias_arendimento.Descricao.$invalid && (form_dias_arendimento.$submitted || form_dias_arendimento.Descricao.$dirty)?'has-error':''">
                                <label for="Descricao">Descrição:</label>
                                <input type="text" name="Descricao" autocomplete="off" class="form-control" maxlength="50" ng-model="cad.Descricao" ng-required="true">
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="form_dias_arendimento" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>

         
