var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('fluxoVagaController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    
    
    $scope.lista_formas_pagamento = [];
    $scope.lista_estacionamentos = [];
    $scope.lista_fluxo = [];
    $scope.lista_cadastros = [];

    var dataAtual = function(hora=0) {
        var now = new Date;
        if(hora){
            var retorno = (((now.getHours() )<10?'0':'') +now.getHours())+''+(((now.getMinutes())<10?'0':'')+now.getMinutes());
        }else{
            var retorno = (now.getDate()+"/"+((now.getMonth()+1)<10?'0':'')+(now.getMonth()+1)+ "/" + now.getFullYear());
        }
        return retorno;
    }

    $scope.filtros = {
        EstacionamentoId:""
        ,DataInicio: ""
        ,DataFim: ""
        ,CadastroId:""
        ,Reservado:""
        ,StatusFluxo:'E'
        ,FormaPagamentoId:""
        ,StatusPagamento:''
    };

    $scope.getFormasPagamento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getFormasPagamento',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_formas_pagamento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getEstacionamentos = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getEstacionamentos',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_estacionamentos = retorno.data.lista;
            if($scope.lista_estacionamentos.length==1){
                $scope.filtros.EstacionamentoId = $scope.lista_estacionamentos[0].EstacionamentoId;
            }
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getCadastros = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getCadastros',
            method: 'GET',
            params: {Ativos:1}
        }).then(function (retorno) {
            $scope.lista_cadastros = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getFluxoVagas = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getFluxoVagas',
            method: 'GET',
            params: {params:$scope.filtros}
        }).then(function (retorno) {
            $scope.lista_fluxo = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.openFinalizarLocacao = function(dados){
        if(dados.StatusFluxo=='E'){
            $scope.objFinalizaLocacao = angular.copy(dados);
            $scope.objFinalizaLocacao.DataSaida = dataAtual();
            $scope.objFinalizaLocacao.HoraSaida = dataAtual(1);
            $('#finalizarLocacao').modal('show');
            $scope.calculaValor();
        }
    }

    $scope.calculaValor = function(){
        if(typeof $scope.objFinalizaLocacao.HoraSaida != 'undefined'){
            if($scope.objFinalizaLocacao.HoraSaida.length == 4){
                var hr = $scope.objFinalizaLocacao.HoraSaida.substr(0, 2);
                var min = $scope.objFinalizaLocacao.HoraSaida.substr(2, 2);
                if(hr > 23 || min > 59){
                    $scope.objFinalizaLocacao.HoraSaida = "";
                    return;
                }
                $scope.carregando = true;
                $http({
                    url: base_url+'/FluxoVaga/calculaValor',
                    method: 'GET',
                    params:{
                        FluxoVagaId:$scope.objFinalizaLocacao.FluxoVagaId,
                        DataEntrada:$scope.objFinalizaLocacao.DataEntrada,
                        HoraEntrada:$scope.objFinalizaLocacao.HoraEntrada,
                        DataSaida:$scope.objFinalizaLocacao.DataSaida,
                        HoraSaida:$scope.objFinalizaLocacao.HoraSaida,
                    }
                }).then(function (retorno) {
                    if(retorno.data.erro==1){
                        $scope.erro_saida = 1;
                    }else{
                        $scope.erro_saida = 0;
                        $scope.objFinalizaLocacao.Valor = retorno.data.valor;
                        $scope.objFinalizaLocacao.Tempo = retorno.data.tempo;
                        $scope.objFinalizaLocacao.JaPagou = retorno.data.JaPagou;
                    }
                    
                    $scope.carregando = false;
                },
                function (retorno) {
                    console.log('Error: '+retorno.status);
                });
            }
        }
        
    }

    $scope.setFinalizarLocacao = function() {
        if($scope.form_finaliza.$valid && $scope.erro_saida==0){
            $scope.carregando = true;
            $http({
                url: base_url+'/FluxoVaga/setFinalizarLocacao',
                method: 'POST',
                data: $scope.objFinalizaLocacao
            }).then(function (retorno) {
                $('#finalizarLocacao').modal('hide');
                $scope.objFinalizaLocacao = {};
                $scope.form_finaliza.$submitted = false;
                $scope.form_finaliza.$setPristine();
                $scope.getFluxoVagas();
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });   
        }
    }

    $scope.novoFluxoVaga = function(FluxoVagaId=0){
        window.location = base_url+"/FluxoVaga/novoFluxoVaga"+(FluxoVagaId?"?i="+btoa(FluxoVagaId):"");
    }

    $scope.openRelatorio = function(){
        window.open(base_url+"/FluxoVaga/relatorio?p="+btoa(JSON.stringify($scope.filtros)))
    }

    $scope.getFormasPagamento();
    $scope.getEstacionamentos();
    $scope.getCadastros();
    $scope.getFluxoVagas();
}]);

app.directive('tooltip', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attrs){
            element.hover(function(){
                // on mouseenter
                element.tooltip('show');
            }, function(){
                // on mouseleave
                element.tooltip('hide');
            });
        }
    };
});
