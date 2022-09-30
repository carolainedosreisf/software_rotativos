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

    $scope.setPagamento = function(){
        if($scope.form_pagamento.$valid){
            $scope.carregando = true;
            $http({
                url: base_url+'/Pagamentos/setPagamento',
                method: 'POST',
                data:$scope.objPagamento
            }).then(function (retorno) {
                $scope.carregando = false;
                $('#modalPagamento').modal('hide');
                $scope.objPagamento = {};
                $scope.form_pagamento.$submitted = false;
                $scope.form_pagamento.$setPristine();
                $scope.getVerificaPagamento();
                $scope.getPagamentos();
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }


    $scope.getVerificaPagamento();
    $scope.getPagamentos();
}]);
