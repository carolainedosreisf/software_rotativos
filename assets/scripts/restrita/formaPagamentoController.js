var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('formaPagamentoController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.cad = {};
    $scope.lista_formas_pagamento = [];

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

    $scope.openModalCad = function(dados = {}){
        $scope.cad = angular.copy(dados);

        $scope.txt_modal = (typeof $scope.cad.FormaPagamentoId != 'undefined'?" Editar":"Cadastrar")+" Forma de Pagamento";
        $('#cadFormaPagamento').modal('show');
    }

    $scope.setFormaPagamento = function(){
        if($scope.form_forma_pagamento.$valid){
            $scope.carregando = true;
            $http({
                url: base_url+'/FormaPagamento/setFormaPagamento',
                method: 'POST',
                data: $scope.cad
            }).then(function (retorno) {
                $('#cadFormaPagamento').modal('hide');
                $scope.cad = {};
                $scope.getFormasPagamento();
                $scope.form_forma_pagamento.$submitted = false;
                $scope.form_forma_pagamento.$setPristine();
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getFormasPagamento();
}]);
