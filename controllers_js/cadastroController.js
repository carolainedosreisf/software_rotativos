var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask']);
app.controller('cadastroController', ['$scope', '$http','$filter','$timeout','$location','$anchorScroll', function($scope,$http,$filter,$timeout,$location,$anchorScroll) {
    $scope.erro_cep = false;
    $scope.cad = {
        name_3: 'J'
    };

    $scope.changeTipo = function(){
        $scope.cad.name_4 = '';
        $scope.cad.name_5 = '';
    }

    $scope.buscaCep = function(){
        if ($scope.cad.name_8 != undefined) {
            if ($scope.cad.name_8.length==8) {
                $scope.carregando = true;
                $http({
                    url: `https://viacep.com.br/ws/${$scope.cad.name_8}/json/`,
                    method: 'GET'
                }).then(function (retorno) {
                    if(!(retorno.data.erro)){
                        $scope.erro_cep = false;
                        $scope.cad.name_9 = retorno.data.localidade;
                        $scope.cad.name_11 = retorno.data.logradouro;
                        $scope.cad.name_12 = retorno.data.bairro;
                        
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
        $scope.cad.cd_cidade = "";
        $scope.cad.ed_cadastro = "";
        $scope.cad.ba_cadastro = "";
    }
    
    $scope.setCadastro = function(){
        if($scope.form_cadastro.$valid && $scope.cad.senha == $scope.cad.confirm_senha && !($scope.erro_cep)){
            $http({
                url: '',
                method: 'POST',
                data: $scope.cad
            }).then(function (retorno) {
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }else{
            $location.hash("mensagens");
            $anchorScroll();
        }
    }

}]);
