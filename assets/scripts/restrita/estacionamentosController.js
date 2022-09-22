var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('estacionamentosController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.lista_estacionamentos = [];

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
    
    $scope.novoEstacionamento = function(EstacionamentoId=0){
        window.location = base_url+"/Estacionamento/novoEstacionamento"+(EstacionamentoId?"?i="+btoa(EstacionamentoId):"");
    }

    $scope.listaFotos = function(EstacionamentoId){
        window.location = base_url+"/Estacionamento/listaFotos?i="+btoa(EstacionamentoId);
    }

    $scope.listaAtendentes = function(EstacionamentoId){
        window.location = base_url+"/Estacionamento/listaAtendentes?i="+btoa(EstacionamentoId);
    }

    $scope.getEstacionamentos();
}]);
