
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button type="button" ng-click="novoEstacionamento()" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Novo
            </button>
        </div>
    </div>

    <h2>Estacionamentos >> <?php echo $this->session->userdata('nome'); ?></h2><br>

    <div class="row form-group">
        <div class="col-sm-8" ng-show="tem_sem_preco">
            <span class="legenda-sem-preco">
                <span class="glyphicon glyphicon-exclamation-sign icone"></span>
            </span>
            <span 
                data-html="true" 
                data-toggle="tooltip" 
                data-placement="right"
                data-original-title="Favor preencher o preço para que o estacionamento possa ser usado nos demais processos do sistema, como Locações e Reservas"
                tooltip>
                &nbsp;- Estacionamento sem preço.
            </span>
            
        </div>
        <div class="col-sm-4 pull-right">
            <input type="text" class="form-control" placeholder="Pesquisar..." ng-model="filtrar">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Estacionamento</th>
                        <th>Endereço</th>
                        <th>Contato</th>
                        <th>Preço</th>
                        <th class="text-center" width="5%">Fotos</th>
                        <th class="text-center" width="5%">Atendentes</th>
                        <th class="text-center" width="5%">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr pagination-id="pg_lista" dir-paginate="l in lista_estacionamentos| filter:filtrar | itemsPerPage:20">
                        <td >
                            {{l.NomeEstacionamento}}<br>
                            {{l.CpfCnpjFormatado}}
                        </td>
                        <td >
                            {{l.Endereco}}, N° {{l.NumeroEndereco}} - {{l.BairroEndereco}},<br>{{l.NomeCidade}} - {{l.Estado}}, {{l.NumeroCep}}
                        </td>
                        <td >
                            {{l.NumeroTelefone1Formatado}} <br>
                            {{l.NumeroTelefone2Formatado}} <br ng-show="l.NumeroTelefone2">
                            {{l.Email}}
                        </td>
                        <td ng-class="l.PrecoLivre<=0 && l.PrecoHora<=0?'sem-preco text-center':''">
                            <span ng-show="l.PrecoLivre<=0 && l.PrecoHora<=0" class="glyphicon glyphicon-exclamation-sign icone"></span>
                            <span ng-show="l.PrecoLivre>0">{{l.PrecoLivre|currency:'R$ '}} (Livre)<br></span>
                            <span ng-show="l.PrecoHora>0">{{l.PrecoHora|currency:'R$ '}} (Hora)</span>
                        </td>
                        <td class="text-center">
                            <button ng-click="listaFotos(l.EstacionamentoId)" class="btn btn-default btn-sm">
                                <i class="glyphicon glyphicon-file"></i> {{l.QtdFotos}}
                            </button>
                        </td>
                        <td class="text-center">
                            <button ng-click="listaAtendentes(l.EstacionamentoId)" class="btn btn-default btn-sm">
                                <i class="glyphicon glyphicon-user"></i> {{l.QtdAtendentes}}
                            </button>
                        </td>
                        <td class="text-center">
                            <button ng-click="novoEstacionamento(l.EstacionamentoId)" class="btn btn-success btn-sm">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="pull-right">
                <dir-pagination-controls 
                    max-size="7" 
                    direction-links="true" 
                    boundary-links="true" 
                    pagination-id="pg_lista">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>
</div>

         
