var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('fluxoVagaController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    var now = new Date;
    
    $scope.lista_formas_pagamento = [];
    $scope.lista_estacionamentos = [];
    $scope.lista_fluxo = [];
    $scope.data_atual = now.getDate()+"/"+((now.getMonth()+1)<10?'0':'')+(now.getMonth()+1)+ "/" + now.getFullYear();
    $scope.filtros = {
        Data: $scope.data_atual
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

    $scope.novoFluxoVaga = function(FluxoVagaId=0){
        window.location = base_url+"/FluxoVaga/novoFluxoVaga"+(FluxoVagaId?"?i="+btoa(FluxoVagaId):"");
    }

    $scope.getFormasPagamento();
    $scope.getEstacionamentos();
}]);
