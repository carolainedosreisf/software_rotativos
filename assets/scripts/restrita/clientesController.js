var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('clientesController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.lista_clientes = [];
    $scope.lista_estacionamentos = [];

    $scope.getClientes = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Clientes/getClientes',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_clientes = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getEstacionamentos = function(dados){
        $scope.objEmpresa = angular.copy(dados);
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getEstacionamentos',
            method: 'GET',
            params:{EmpresaId:dados.EmpresaId}
        }).then(function (retorno) {
            $scope.lista_estacionamentos = retorno.data.lista;
            $('#modalEstacionamentos').modal('show');
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getEstacionamentos = function(dados){
        $scope.objEmpresa = angular.copy(dados);
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getEstacionamentos',
            method: 'GET',
            params:{EmpresaId:dados.EmpresaId}
        }).then(function (retorno) {
            $scope.lista_estacionamentos = retorno.data.lista;
            $('#modalEstacionamentos').modal('show');
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getPagamentos = function(dados){
        $scope.objEmpresa = angular.copy(dados);
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getPagamentos',
            method: 'GET',
            params:{EmpresaId:dados.EmpresaId}
        }).then(function (retorno) {
            $scope.lista_pagamentos = retorno.data;
            $('#modalPagamentos').modal('show');
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.openRelatorio = function(){
        window.open(base_url+"/Clientes/relatorio")
    }

    $scope.getClientes();
}]);


