var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('estacionamentosController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.lista_estacionamentos = [];

    $scope.getEstacionamentos = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getEstacionamentos',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_estacionamentos = retorno.data.lista;
            $scope.tem_sem_preco = retorno.data.tem_sem_preco;
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
