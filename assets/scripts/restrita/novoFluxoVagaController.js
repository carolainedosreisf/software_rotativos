var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('novoFluxoVagaController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    var now = new Date;
    $scope.FluxoVaga = {};
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

    $scope.validaHora = function(coluna){
        if(typeof $scope.FluxoVaga[coluna] != undefined){
            if($scope.FluxoVaga[coluna] != ""){
                var hr = $scope.FluxoVaga[coluna].substr(0, 2);
                var min = $scope.FluxoVaga[coluna].substr(2, 2);
                if(hr > 23 || min > 59){
                    $scope.FluxoVaga[coluna] = "";
                }
            }
        }
    }

    $scope.setFluxoVaga = function(){
        if($scope.form_fluxo_vaga.$valid){
            $scope.carregando = true;
            $http({
                url: base_url+'/FluxoVaga/setFluxoVaga',
                method: 'POST',
                data: $scope.FluxoVaga
            }).then(function (retorno) {
               
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getEstacionamentos();

    if(FluxoVagaId){

    }else{
        $scope.FluxoVaga.DataEntrada = $scope.data_atual;
    }
}]);

app.directive('uppercase', function() {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, modelCtrl) {
            modelCtrl.$parsers.push(function(input) {
                return input ? input.toUpperCase() : "";
            });
            element.css("text-transform","uppercase");
        }
    };
})

$(document).ready(function(){
    //$("#PlacaVeiculo").inputmask({mask: 'aaa-9*99'});
});
