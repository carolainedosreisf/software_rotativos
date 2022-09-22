var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('novoFluxoVagaController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    var now = new Date;
    $scope.fluxoVaga = {};
    $scope.lista_estacionamentos = [];
    $scope.lista_clientes = [];
    $scope.FluxoVagaId = FluxoVagaId;
    $scope.data_atual = now.getDate()+"/"+((now.getMonth()+1)<10?'0':'')+(now.getMonth()+1)+ "/" + now.getFullYear();

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

    $scope.getEstacionamentos();
}]);


$(document).ready(function(){
    $("#PlacaVeiculo").inputmask({mask: 'AAA-9999'});
 });
