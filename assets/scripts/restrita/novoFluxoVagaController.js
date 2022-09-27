var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('novoFluxoVagaController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.FluxoVaga = {Tipo:'F'};
    $scope.lista_estacionamentos = [];
    $scope.lista_clientes = [];
    $scope.FluxoVagaId = FluxoVagaId;
    $scope.disabled_ = 0;

    var dataAtual = function(hora=0) {
        var now = new Date;
        if(hora){
            var retorno = (((now.getHours() )<10?'0':'') +now.getHours())+''+(((now.getMinutes())<10?'0':'')+now.getMinutes());
        }else{
            var retorno = (now.getDate()+"/"+((now.getMonth()+1)<10?'0':'')+(now.getMonth()+1)+ "/" + now.getFullYear());
        }
        return retorno;
    }

    $scope.getEstacionamentos = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Estacionamento/getEstacionamentos',
            method: 'GET',
            params:{ComPreco:1}
        }).then(function (retorno) {
            $scope.lista_estacionamentos = retorno.data.lista;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getClientes = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getClientes',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista_clientes = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getFluxoVaga = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getFluxoVaga',
            method: 'GET',
            params:{FluxoVagaId}
        }).then(function (retorno) {
            $scope.FluxoVaga = retorno.data;
            $scope.carregando = false;
            if($scope.FluxoVaga.StatusFluxo!='E'){
                $scope.disabled_ = 1;
            }
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
                window.location = base_url+"/FluxoVaga/";
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getReservas = function(){
        if($scope.FluxoVaga.EstacionamentoId && $scope.FluxoVaga.CadastroId){
            $scope.carregando = true;
            $http({
                url: base_url+'/FluxoVaga/getReservas',
                method: 'GET',
                params: {params:
                    {
                        EstacionamentoId:$scope.FluxoVaga.EstacionamentoId
                        ,CadastroId:$scope.FluxoVaga.CadastroId
                        ,StatusFluxo:'N'
                    }
                }
            }).then(function (retorno) {
                $scope.lista_reservas = retorno.data;
                $scope.FluxoVaga.ReservaId = "";
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
        
    }


    $scope.getEstacionamentos();
    $scope.getClientes();

    if(FluxoVagaId){
        $scope.getFluxoVaga();
    }else{
        $scope.FluxoVaga.DataEntrada = dataAtual();
        $scope.FluxoVaga.HoraEntrada = dataAtual(1);
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
