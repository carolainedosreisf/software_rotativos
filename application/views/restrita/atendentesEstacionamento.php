
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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCadAtendente">
                <i class="glyphicon glyphicon-plus"></i>
                Novo
            </button>
        </div>
    </div>

    <h2>Atendentes >> {{objEstacionamento.NomeEstacionamento}}</h2><br>

    <div class="row form-group">
        <div class="col-sm-6"></div>
        <div class="col-sm-2">
            <select name="Status" id="Status" class="form-control" ng-model="filtro.Status" ng-change="getAtendentes()">
                <option value="">Status: Todos</option>
                <option value="A">Status: Ativos</option>
                <option value="I">Status: Desativados</option>
            </select>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Pesquisar..." ng-model="filtrar">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nome Usuário</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Senha já cadastrada?</th>
                        <th class="text-center" width="10%">Status</th>
                        <th class="text-center" width="10%">Renviar Token Senha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_atendentes|filter:filtrar).length<=0">
                        <td colspan="6" class="text-center">Nenhum registro encontrado.</td>
                    </tr>
                    <tr ng-repeat="l in lista_atendentes|filter:filtrar">
                         <td class="text-center">
                            {{$index+1}}
                        </td>
                        <td class="text-center">
                            {{l.NomeUsuario}}
                        </td>
                        <td class="text-center">
                            {{l.Email}}
                        </td>
                        <td class="text-center">
                            {{l.SenhaCadastrada}}
                        </td>
                        <td class="text-center">
                            <button 
                                class="btn btn-sm" 
                                ng-class="l.Status=='A'?'btn-success':'btn-warning'"
                                ng-click="acaoUsuario(l)"
                                data-html="true" 
                                data-toggle="tooltip" 
                                data-placement="left"
                                data-original-title="Clique aqui para {{l.Status=='A'?'desativar':'ativar'}} o atendente."
                                tooltip>
                                    {{l.Status=='A'?'Ativo':'Desativado'}}
                            </button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-success btn-sm" ng-click="gerarToken(l)" ng-disabled="l.Status=='I'">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="modalCadAtendente" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cadastrar Atendente</h4>
                </div>
                <div class="modal-body">
                    <form name="form_atendente" id="form_atendente" ng-submit="setAtendente()" novalidate autocomplete="off">
                        <div class="row" ng-show="form_atendente.$error.required && form_atendente.$submitted">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    Preencha os campos destacados!
                                </div>
                            </div>
                        </div>
                        <div class="row" ng-show="form_atendente.Email.$invalid && !(form_atendente.Email.$error.required) && (form_atendente.$submitted || form_atendente.Email.$dirty)">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    E-mail Inválido!
                                </div>
                            </div>
                        </div>
                        <div class="row" ng-repeat="erro in lista_erros">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    {{erro}}
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_atendente.NomeUsuario.$error.required && (form_atendente.$submitted || form_atendente.NomeUsuario.$dirty)?'has-error':''">
                                <label for="NomeUsuario">Nome Usuário:</label>
                                <input type="text" class="form-control" name="NomeUsuario" id="NomeUsuario" ng-model="objAtendente.NomeUsuario" ng-required="true">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_atendente.Email.$invalid && (form_atendente.$submitted || form_atendente.email.$dirty)?'has-error':''">
                                <label for="Email">E-mail:</label>
                                <input type="email" class="form-control" name="Email" id="Email" ng-model="objAtendente.Email" ng-required="true">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" class="close" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="form_atendente" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var EstacionamentoId = "<?php echo $EstacionamentoId; ?>";
    </script>
</div>

         
