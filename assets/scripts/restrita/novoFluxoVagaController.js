var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('novoFluxoVagaController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.FluxoVaga = {Tipo:'F'};
    $scope.lista_estacionamentos = [];
    $scope.lista_clientes = [];
    $scope.FluxoVagaId = FluxoVagaId;
    $scope.disabled_ = 0;

    $scope.filtros = {
        DataInicio: ""
        ,DataFim: ""
        ,StatusFluxo:'N'
        ,StatusPagamento:''
        ,FormaPagamentoId:''
    }

    var dataAtual = function(hora=0) {
        var now = new Date;
        if(hora){
            var retorno = (((now.getHours() )<10?'0':'') +now.getHours())+''+(((now.getMinutes())<10?'0':'')+now.getMinutes());
        }else{
            var retorno = (((now.getDate()<10?'0':'')+now.getDate())+"/"+((now.getMonth()+1)<10?'0':'')+(now.getMonth()+1)+ "/" + now.getFullYear());
        }
        return retorno;
    }

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

    $scope.getFluxoVaga = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/FluxoVaga/getFluxoVaga',
            method: 'GET',
            params:{FluxoVagaId}
        }).then(function (retorno) {
            $scope.FluxoVaga = retorno.data;
            $scope.FluxoVaga.Tipo = 'F';
            $scope.carregando = false;
            if($scope.FluxoVaga.CadastroId){
                setTimeout(() => {
                    var cadastro = $scope.lista_clientes[getIndexCadastro()];
                    var newOption = new Option(cadastro.Nome+" - "+cadastro.CpfFormatado, cadastro.CadastroId, false, false);
                    $('#CadastroId').append(newOption).trigger('change');
                }, 777);
            }
            if($scope.FluxoVaga.StatusFluxo!='E'){
                $scope.disabled_ = 1;
            }
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.$watchGroup([
        'FluxoVaga.EstacionamentoId'
        ,'FluxoVaga.DataEntrada'
        ,'FluxoVaga.HoraEntrada'
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
                    }else if(i==2){
                        var hr = $scope.FluxoVaga['HoraEntrada'].substr(0, 2);
                        var min = $scope.FluxoVaga['HoraEntrada'].substr(2, 2);
                        if(hr > 23 || min > 59){
                            $scope.FluxoVaga['HoraEntrada'] = "";
                            invalido = 1;
                        }
                    }
                }
            });

            setTimeout(() => {
                if(invalido==0&&$scope.disabled_==0){
                    $scope.carregando = true;
                    $http({
                        url: base_url+'/FluxoVaga/getInfoLotacao',
                        method: 'GET',
                        params: {
                            EstacionamentoId:$scope.FluxoVaga.EstacionamentoId
                            ,DataEntrada:$scope.FluxoVaga.DataEntrada
                            ,HoraEntrada:$scope.FluxoVaga.HoraEntrada
                        } 
                    }).then(function (retorno) {
                        $scope.carregando = false;
                        $scope.QtdLocacoes = retorno.data.QtdLocacoes;
                        $scope.reservas_proximas = retorno.data.reservas_proximas;
                        if(($scope.reservas_proximas.length+$scope.QtdLocacoes)>=$scope.NumeroVagas){
                            $scope.mensagemLotacao();
                        }
                    },
                    function (retorno) {
                        console.log('Error: '+retorno.status);
                    });
                }
            }, 777);
    });

    $scope.validaHora = function(coluna){
        if(typeof $scope.FluxoVaga[coluna] != 'undefined'){
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
        if($scope.form_fluxo_vaga.$valid && ($scope.reservas_proximas.length+$scope.QtdLocacoes)<$scope.NumeroVagas){
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
        }else if($scope.form_fluxo_vaga.$valid && ($scope.reservas_proximas.length+$scope.QtdLocacoes)>=$scope.NumeroVagas){
            $scope.mensagemLotacao();
        }
    }

    $scope.getReservas = function(){
        if($scope.FluxoVaga.EstacionamentoId && $scope.FluxoVaga.CadastroId){
            $scope.carregando = true;
            $scope.filtros.EstacionamentoId = $scope.FluxoVaga.EstacionamentoId;
            $scope.filtros.CadastroId = $scope.FluxoVaga.CadastroId;
            $http({
                url: base_url+'/FluxoVaga/getReservas',
                method: 'GET',
                params: {params:$scope.filtros}
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

    $scope.mensagemLotacao = function() {
        swal({
            title: "",
            text:'Não é possivel cadastrar a locação, o estacionamento já  esta lotado nesse período.',
            type: "warning",
            showCancelButton: false,
            confirmButtonText: "Ok",
            },
            function(){
            
        });
    }

    var getIndexEstacionamento = function() {
        return $scope.lista_estacionamentos.map((el) => el.EstacionamentoId).indexOf($scope.FluxoVaga.EstacionamentoId);
    }

    var getIndexCadastro = function() {
        return $scope.lista_clientes.map((el) => el.CadastroId).indexOf($scope.FluxoVaga.CadastroId);
    }


    $scope.getEstacionamentos();
    $scope.getCadastros();

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

$(document).ready(function() {
    $('#CadastroId').select2();
});
