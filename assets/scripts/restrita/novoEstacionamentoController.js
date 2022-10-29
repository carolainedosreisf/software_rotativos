var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('novoEstacionamentoController', ['$scope', '$http','$filter','$location','$anchorScroll', function($scope,$http,$filter,$location,$anchorScroll) {
    $scope.objEstacionamento = {};
    $scope.EstacionamentoId = EstacionamentoId;
    $scope.lista_cidades = [];
    $scope.erro_cep = false;
    $scope.lista_tipos_pix = lista_tipos_pix;

    if(!EstacionamentoId){
        $scope.objEstacionamento.TipoChavePix = '0';
    }

    $scope.getCidades = function(desc=''){
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getCidades',
            method: 'GET',
            params:{desc}
        }).then(function (retorno) {
            if(desc){
                if(retorno.data.length > 0){
                    $scope.objEstacionamento.CidadeId = retorno.data[0]['CidadeId'];
                }
            }else{
                $scope.lista_cidades = retorno.data;
            }
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getEstacionamento = function(){
        $scope.carregando = true;
        $http({
            url: 'getEstacionamento',
            method: 'GET',
            params: {EstacionamentoId}
        }).then(function (retorno) {
            $scope.objEstacionamento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getDiasAtendimento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Generico/getDiasAtendimento',
            method: 'GET',
            params: {EstacionamentoId}
        }).then(function (retorno) {
            $scope.lista_dias = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getEmpresa = function(){
        $scope.carregando = true;
        $http({
            url: 'getEmpresa',
            method: 'GET'
        }).then(function (retorno) {
            $scope.objEstacionamento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.buscaCep = function(){
        if ($scope.objEstacionamento.NumeroCep != undefined) {
            if ($scope.objEstacionamento.NumeroCep.length==8) {
                $scope.carregando = true;
                $http({
                    url: `https://viacep.com.br/ws/${$scope.objEstacionamento.NumeroCep}/json/`,
                    method: 'GET'
                }).then(function (retorno) {
                    if(!(retorno.data.erro)){
                        $scope.erro_cep = false;
                        $scope.objEstacionamento.Endereco = retorno.data.logradouro;
                        $scope.objEstacionamento.BairroEndereco = retorno.data.bairro;
                        if(retorno.data.localidade){
                            $scope.getCidades(retorno.data.localidade);
                        }
                        
                    }else{
                        zerarEndereco();
                        $scope.erro_cep = true;
                    }
                    $scope.carregando = false;
                },
                function (retorno) {
                    console.log('Erro ao carregar CEP.');
                    $scope.carregando = false;
                });
            }else{
                zerarEndereco();
            }
        }
    }

    var zerarEndereco = function(){
        $scope.objEstacionamento.CidadeId = "";
        $scope.objEstacionamento.Endereco = "";
        $scope.objEstacionamento.BairroEndereco = "";
    }

    $scope.setEstacionamento = function(){
        if(
            $scope.form_estacionamento.$valid && 
            $scope.erro_cep==false 
            && ($scope.objEstacionamento.PrecoHora>0 || $scope.objEstacionamento.PrecoLivre>0) 
            && $scope.objEstacionamento.NumeroVagas >= $scope.objEstacionamento.NumeroLimiteReserva
            ){
            $scope.carregando = true;
            $http({
                url: 'setEstacionamento',
                method: 'POST',
                data: $scope.objEstacionamento
            }).then(function (retorno) {
                $scope.carregando = false;
                if(!EstacionamentoId){
                    $scope.setDiasAtendimento(retorno.data,1)
                }else{
                    window.location = "index";
                }
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }else{
            $location.hash("mensagens");
            $anchorScroll();
        }
    }

    $scope.setDiasAtendimento = function(id,redirect=0){
        $('#modalDias').modal('hide');
        if(id){
            $scope.carregando = true;
            $http({
                url: base_url+'/DiasAtendimento/setDiasAtendimento',
                method: 'POST',
                data: {lista:$scope.lista_dias,EstacionamentoId:id}
            }).then(function (retorno) {
                $scope.carregando = false;
                if(redirect){
                    window.location = "index";
                }
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.validaHora = function(coluna,index){
        if(typeof $scope.lista_dias[index][coluna] != 'undefined'){
            if($scope.lista_dias[index][coluna]!= ""){
                var hr = $scope.lista_dias[index][coluna].substr(0, 2);
                var min = $scope.lista_dias[index][coluna].substr(2, 2);
                if(hr > 23 || min > 59){
                    $scope.lista_dias[index][coluna] = "";
                }
            }
        }
    }

    $scope.getCidades();
    $scope.getDiasAtendimento();
    
    if(EstacionamentoId){
        $scope.getEstacionamento();
    }else{
        $scope.getEmpresa();
    }
}]);

app.directive('somentenumeros', function () {
    return {
      require: 'ngModel',
      restrict: 'A',
      link: function (scope, element, attr, ctrl) {
        function inputValue(val) {
          if (val) {
            var numeros = val.replace(/[^0-9]/g, '');
            if (numeros !== val) {
              ctrl.$setViewValue(numeros);
              ctrl.$render();
            }
            return parseInt(numeros,10);
          }
          return '';
        }
        ctrl.$parsers.push(inputValue);
      }
    };
});

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

