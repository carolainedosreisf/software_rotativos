var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('reservasController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.lista_estacionamentos = [];
    $scope.lista_reservas = [];

    $scope.filtros = {
        EstacionamentoId:""
        ,DataInicio: ""
        ,DataFim: ""
        ,StatusPagamento:''
        ,StatusFluxo:''
        ,CadastroId:""
    };

    $scope.getEstacionamentos = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Estacionamento/getEstacionamentos',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_estacionamentos = retorno.data.lista;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getReservas = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getReservas',
            method: 'GET',
            params: {params:$scope.filtros}
        }).then(function (retorno) {
            $scope.lista_reservas = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.calculaValor = function(){
        if(typeof $scope.objFinalizaLocacao.HoraSaida != 'undefined'){
            if($scope.objFinalizaLocacao.HoraSaida.length == 4){
                var hr = $scope.objFinalizaLocacao.HoraSaida.substr(0, 2);
                var min = $scope.objFinalizaLocacao.HoraSaida.substr(2, 2);
                if(hr > 23 || min > 59){
                    $scope.objFinalizaLocacao.HoraSaida = "";
                    return;
                }
                $scope.carregando = true;
                $http({
                    url: base_url+'/FluxoVaga/calculaValor',
                    method: 'GET',
                    params:{
                        EstacionamentoId:$scope.objFinalizaLocacao.EstacionamentoId,
                        DataEntrada:$scope.objFinalizaLocacao.DataEntrada,
                        HoraEntrada:$scope.objFinalizaLocacao.HoraEntrada,
                        DataSaida:$scope.objFinalizaLocacao.DataSaida,
                        HoraSaida:$scope.objFinalizaLocacao.HoraSaida,
                    }
                }).then(function (retorno) {
                    if(retorno.data.erro==1){
                        $scope.erro_saida = 1;
                    }else{
                        $scope.erro_saida = 0;
                        $scope.objFinalizaLocacao.Valor = retorno.data.valor;
                        $scope.objFinalizaLocacao.Tempo = retorno.data.tempo;
                    }
                    
                    $scope.carregando = false;
                },
                function (retorno) {
                    console.log('Error: '+retorno.status);
                });
            }
        }
        
    }

    $scope.novaReserva = function(ReservaId=0){
        window.location = base_url+"/FluxoVaga/novaReserva"+(ReservaId?"?i="+btoa(ReservaId):"");
    }

    $scope.openRelatorio = function(){
        window.open(base_url+"/FluxoVaga/relatorioReserva?p="+btoa(JSON.stringify($scope.filtros)))
    }

    $scope.getEstacionamentos();
    $scope.getReservas();
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
