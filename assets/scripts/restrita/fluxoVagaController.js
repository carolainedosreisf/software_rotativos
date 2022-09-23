var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('fluxoVagaController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    
    
    $scope.lista_formas_pagamento = [];
    $scope.lista_estacionamentos = [];
    $scope.lista_fluxo = [];

    var dataAtual = function(hora=0) {
        var now = new Date;
        if(hora){
            var retorno = (now.getHours()+''+((now.getMinutes())<10?'0':'')+(now.getMinutes()));
        }else{
            var retorno = (now.getDate()+"/"+((now.getMonth()+1)<10?'0':'')+(now.getMonth()+1)+ "/" + now.getFullYear());
        }
        return retorno;
    }

    $scope.filtros = {
        Data: dataAtual()
        ,Status:'A'
    };

    $scope.validaHora = function(){
        if(typeof $scope.filtros.Hora != undefined){
            if($scope.filtros.Hora != ""){
                var hr = $scope.filtros.Hora.substr(0, 2);
                var min = $scope.filtros.Hora.substr(2, 2);
                if(hr > 23 || min > 59){
                    $scope.filtros.Hora = "";
                }
            }
        }
    }

    $scope.getFormasPagamento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FormaPagamento/getFormasPagamento',
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
            url: base_url+'/Estacionamento/getEstacionamentos',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_estacionamentos = retorno.data;
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
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_fluxo = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.openFinalizarLocacao = function(dados){
        $scope.objFinalizaLocacao = angular.copy(dados);
        $scope.objFinalizaLocacao.DataSaida = dataAtual();
        console.log(dataAtual(1))
        $scope.objFinalizaLocacao.HoraSaida = dataAtual(1);
        $('#finalizarLocacao').modal('show');
        $scope.calclulaValor();
    }

    $scope.calclulaValor = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/calclulaValor',
            method: 'GET',
            params:{
                EstacionamentoId:$scope.objFinalizaLocacao.EstacionamentoId,
                DataEntrada:$scope.objFinalizaLocacao.DataEntradaBr,
                HoraEntrada:$scope.objFinalizaLocacao.HoraEntradaBr,
                DataSaida:$scope.objFinalizaLocacao.DataSaida,
                HoraSaida:$scope.objFinalizaLocacao.HoraSaida,
            }
        }).then(function (retorno) {
            $scope.objFinalizaLocacao.Valor = retorno.data.valor;
            $scope.objFinalizaLocacao.Tempo = retorno.data.tempo;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.novoFluxoVaga = function(FluxoVagaId=0){
        window.location = base_url+"/FluxoVaga/novoFluxoVaga"+(FluxoVagaId?"?i="+btoa(FluxoVagaId):"");
    }

    $scope.getFormasPagamento();
    $scope.getEstacionamentos();
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
