var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination','ngSanitize']);
app.controller('clientesController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.lista_clientes = [];
    $scope.lista_estacionamentos = [];
    $scope.situacao_pagamento = "";
    $scope.situacao_software = "";

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

    $scope.getClientes = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Clientes/getClientes',
            method: 'GET',
            params :{
                situacao_pagamento:$scope.situacao_pagamento,
                situacao_software:$scope.situacao_software
            }
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
        window.open(base_url+"/Clientes/relatorio?p="+btoa($scope.situacao_pagamento)+"&s="+btoa($scope.situacao_software))
    }

    $scope.openBaixaPagamento = function(dados) {
        $scope.objEmpresa = angular.copy(dados);
        $http({
            url: base_url+'/Pagamentos/getVerificaPagamento',
            method: 'GET',
            params:{EmpresaId:dados.EmpresaId}
        }).then(function (retorno) {
            $scope.objEmpresaPagamento = retorno.data;
            $('#baixaPagamento').modal('show');
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setPagamento = function(){
        if($scope.form_baixa_pagamento.$valid){
            $scope.carregando = true;
            $scope.objEmpresaPagamento.EmpresaId = $scope.objEmpresa.EmpresaId;
            $http({
                url: base_url+'/Clientes/setPagamento',
                method: 'POST',
                data :$scope.objEmpresaPagamento
            }).then(function (retorno) {
                $scope.carregando = false;
                swal({
                    title: "Sucesso!",
                    text: "Baixa no pagamento efetuada com sucesso.",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                },function () {
                    window.location.reload();
                });
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getFormasPagamento();
    $scope.getClientes();
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


