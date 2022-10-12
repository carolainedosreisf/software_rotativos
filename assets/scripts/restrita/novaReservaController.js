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
            url: base_url+'/Generico/getEstacionamentos',
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

    $scope.getCadastros = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getCadastros',
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

    $scope.getReserva = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getReserva',
            method: 'GET',
            params:{ReservaId}
        }).then(function (retorno) {
            $scope.Reserva = retorno.data;
            $scope.carregando = false;
            if($scope.Reserva.Status!='B' || $scope.Reserva.StatusFluxo!='N'){
                $scope.disabled_ = 1;
            }
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.$watchGroup([
        'Reserva.EstacionamentoId'
        ,'Reserva.DataEntrada'
        ,'Reserva.HoraEntrada'
        ,'Reserva.DataSaida'
        ,'Reserva.HoraSaida'
        ], function(newValues, oldValues, scope) {
            
            var invalido = 0;
            newValues.map(function(e, i) {
                if(!e){
                    invalido = 1;
                    if(i==0){
                        $scope.NumeroVagas = '';
                    }
                }else{
                    if(i==0){
                        var index = getIndexEstacionamento();
                        $scope.NumeroVagas = $scope.lista_estacionamentos[index].NumeroVagas;
                    }else if(i==2||i==4){
                        var coluna = i==2?'HoraEntrada':'HoraSaida';
                        var hr = $scope.Reserva[coluna].substr(0, 2);
                        var min = $scope.Reserva[coluna].substr(2, 2);
                        if(hr > 23 || min > 59){
                            $scope.Reserva[coluna] = "";
                            invalido = 1;
                        }
                    }
                }
            });

            setTimeout(() => {
                if(invalido==0 && !$scope.disabled_){

                    $scope.carregando = true;
                    $http({
                        url: base_url+'/FluxoVaga/getInfoLotacao',
                        method: 'GET',
                        params: {
                            EstacionamentoId:$scope.Reserva.EstacionamentoId
                            ,DataEntrada:$scope.Reserva.DataEntrada
                            ,HoraEntrada:$scope.Reserva.HoraEntrada
                            ,HoraSaida:$scope.Reserva.HoraSaida
                        } 
                    }).then(function (retorno) {
                        $scope.carregando = false;
                        $scope.reservas_periodo = retorno.data.reservas_proximas;
                        if($scope.reservas_periodo.length>=$scope.NumeroVagas){
                            $scope.erro = 0;
                            $scope.mensagemLotacao();
                        }else{
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
                                    $scope.Reserva.PagarAgora = 'N';
                                    $scope.Reserva.FormaPagamentoId = '';
        
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
                    },
                    function (retorno) {
                        console.log('Error: '+retorno.status);
                    });
                }
            }, 777);
    });

    $scope.setReserva= function(){
        if($scope.form_reserva.$valid && $scope.reservas_periodo.length<$scope.NumeroVagas){
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
        }else if($scope.reservas_periodo.length>=$scope.NumeroVagas){
            $scope.mensagemLotacao();
        }
    }

    $scope.mensagemLotacao = function() {
        swal({
            title: "",
            text: "Estacionamento lotado no período selecionado.",
            type: "warning",
            showCancelButton: false,
            confirmButtonText: "Ok",
            },
            function(){
            
        });
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
                $scope.getCadastros();
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    var getIndexEstacionamento = function() {
         return $scope.lista_estacionamentos.map((el) => el.EstacionamentoId).indexOf($scope.Reserva.EstacionamentoId);
    }

    $scope.getEstacionamentos();
    $scope.getCadastros();
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
