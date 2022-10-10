var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination','ngSanitize']);
app.controller('pagamentosController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.lista_pagamentos = [];
    $scope.objPagamento = {};

    $scope.getVerificaPagamento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Pagamentos/getVerificaPagamento',
            method: 'GET'
        }).then(function (retorno) {
            $scope.verificacao = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getPagamentos = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getPagamentos',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_pagamentos = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getVerificaPagamento();
    $scope.getPagamentos();
}]);
