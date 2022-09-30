var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('diasAtendimentoController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.cad = {};
    $scope.lista_dias_atendimento = [];

    $scope.getDiasAtendimento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getDiasAtendimento',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_dias_atendimento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.openModalCad = function(dados = {}){
        $scope.cad = angular.copy(dados);

        $scope.txt_modal = (typeof $scope.cad.DiasAtendimentoId != 'undefined'?" Editar":"Cadastrar")+" Dias de Atedimento";
        $('#cadDiasAtendimento').modal('show');
    }

    $scope.setDiasAtendimento = function(){
        if($scope.form_dias_arendimento.$valid){
            $scope.carregando = true;
            $http({
                url: base_url+'/DiasAtendimento/setDiasAtendimento',
                method: 'POST',
                data: $scope.cad
            }).then(function (retorno) {
                $('#cadDiasAtendimento').modal('hide');
                $scope.cad = {};
                $scope.getDiasAtendimento();
                $scope.form_dias_arendimento.$submitted = false;
                $scope.form_dias_arendimento.$setPristine();
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getDiasAtendimento();
}]);
