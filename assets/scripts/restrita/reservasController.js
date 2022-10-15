var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('reservasController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.lista_estacionamentos = [];
    $scope.lista_reservas = [];

    $scope.filtros = {
        EstacionamentoId:""
        ,DataInicio: ""
        ,DataFim: ""
        ,StatusFluxo:'N'
        ,StatusPagamento:''
        ,FormaPagamentoId:''
        ,CadastroId:""
    };

    $scope.getFormasPagamento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getFormasPagamento',
            method: 'GET',
            params:{todos:1}
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

    $scope.getReservas = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getReservas',
            method: 'GET',
            params: {params:$scope.filtros}
        }).then(function (retorno) {
            $scope.lista_reservas = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.novaReserva = function(ReservaId=0){
        window.location = base_url+"/FluxoVaga/novaReserva"+(ReservaId?"?i="+btoa(ReservaId):"");
    }

    $scope.openRelatorio = function(){
        window.open(base_url+"/FluxoVaga/relatorioReserva?p="+btoa(JSON.stringify($scope.filtros)))
    }

    $scope.getFormasPagamento()/
    $scope.getEstacionamentos();
    $scope.getReservas();
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
