var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('novaReservaController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.Reserva = {
        Tipo:'R'
        ,PagarAgora:'N'
    };
    $scope.lista_estacionamentos = [];
    $scope.lista_clientes = [];
    $scope.ReservaId = ReservaId;
    $scope.disabled_ = 0;
    $scope.erro = 0;
    
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

    $scope.getFormasPagamento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FormaPagamento/getFormasPagamento',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_formas_pagamento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getReserva = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getReserva',
            method: 'GET',
            params:{ReservaId}
        }).then(function (retorno) {
            $scope.Reserva = retorno.data;
            $scope.carregando = false;
            if($scope.Reserva.Status!='B'){
                $scope.disabled_ = 1;
            }
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.validaHora = function(coluna){
        if(typeof $scope.Reserva[coluna] != undefined){
            if($scope.Reserva[coluna] != ""){
                var hr = $scope.Reserva[coluna].substr(0, 2);
                var min = $scope.Reserva[coluna].substr(2, 2);
                if(hr > 23 || min > 59){
                    $scope.Reserva[coluna] = "";
                }
            }
        }
    }

    $scope.calculaValor = function(){
        setTimeout(() => {
            console.log($scope.form_reserva.$valid)
            if($scope.form_reserva.$valid){
                $scope.carregando = true;
                $http({
                    url: base_url+'/FluxoVaga/calculaValor',
                    method: 'GET',
                    params:{
                        EstacionamentoId:$scope.Reserva.EstacionamentoId,
                        DataEntrada:$scope.Reserva.DataEntrada,
                        HoraEntrada:$scope.Reserva.HoraEntrada,
                        DataSaida:$scope.Reserva.DataSaida,
                        HoraSaida:$scope.Reserva.HoraSaida,
                    }
                }).then(function (retorno) {
                    if(retorno.data.erro==1){
                        $scope.liberaPagamento = 'N';
                        $scope.erro = 2;
                    }else{
                        $scope.erro = 0;
                        $scope.liberaPagamento = retorno.data.liberaPagamento;
                        if(retorno.data.liberaPagamento=='S'){
                            $scope.Reserva.Valor = retorno.data.valor;
                            $scope.Reserva.Tempo = retorno.data.tempo;
                            $scope.Reserva.NomeEstacionamento = retorno.data.NomeEstacionamento;
                        }
                    }
                    
                    $scope.carregando = false;
                },
                function (retorno) {
                    console.log('Error: '+retorno.status);
                });
            }
        }, 777);
        
        
    }

    $scope.setReserva= function(){
        if($scope.form_reserva.$valid){
            $scope.carregando = true;
            $http({
                url: base_url+'/FluxoVaga/setFluxoVaga',
                method: 'POST',
                data: $scope.Reserva
            }).then(function (retorno) {
                $scope.carregando = false;
                if(retorno.data==1){
                    window.location = base_url+"/FluxoVaga/reservas";
                }else{
                    $scope.erro = retorno.data;
                }
                
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.setCliente = function() {
        if($scope.form_cliente.$valid){
            $scope.carregando = true;
            $http({
                url: base_url+'/FluxoVaga/setCliente',
                method: 'POST',
                data: $scope.objCliente
            }).then(function (retorno) {
                $scope.carregando = false;
                $('#modalCliente').modal('hide');
                $scope.objCliente = {};
                $scope.form_cliente.$submitted = false;
                $scope.form_cliente.$setPristine();
                $scope.getClientes();
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getEstacionamentos();
    $scope.getClientes();
    $scope.getFormasPagamento();

    if(ReservaId){
        $scope.getReserva();
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
