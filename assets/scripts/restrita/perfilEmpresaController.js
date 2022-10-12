var app = angular.module('app', ['ui.utils.masks','ui.mask']);
app.controller('perfilEmpresaController', ['$scope', '$http','$filter','$location','$anchorScroll', function($scope,$http,$filter,$location,$anchorScroll) {
    $scope.objEmpresa = {};
    $scope.lista_cidades = [];
    $scope.erro_cep = false;

    $scope.getEmpresa = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/PerfilEmpresa/getEmpresa',
            method: 'GET',
        }).then(function (retorno) {
            $scope.objEmpresa = retorno.data;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
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
                    $scope.objEmpresa.CidadeId = retorno.data[0]['CidadeId'];
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

    $scope.buscaCep = function(){
        if ($scope.objEmpresa.NumeroCep != undefined) {
            if ($scope.objEmpresa.NumeroCep.length==8) {
                $scope.carregando = true;
                $http({
                    url: `https://viacep.com.br/ws/${$scope.objEmpresa.NumeroCep}/json/`,
                    method: 'GET'
                }).then(function (retorno) {
                    if(!(retorno.data.erro)){
                        $scope.erro_cep = false;
                        $scope.objEmpresa.Endereco = retorno.data.logradouro;
                        $scope.objEmpresa.BairroEndereco = retorno.data.bairro;
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
        $scope.objEmpresa.CidadeId = "";
        $scope.objEmpresa.Endereco = "";
        $scope.objEmpresa.BairroEndereco = "";
    }

    $scope.setEmpresa = function(){
        console.log($scope.form_empresa.$error)
        if($scope.form_empresa.$valid && $scope.erro_cep==false){
            $scope.carregando = true;
            $http({
                url: base_url+'/PerfilEmpresa/setEmpresa',
                method: 'POST',
                data: $scope.objEmpresa
            }).then(function (retorno) {
                $scope.carregando = false;
                swal({
                    title: "Sucesso!",
                    text: "Salvo com sucesso..",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                },function () {
                    window.location = base_url+'/PerfilEmpresa';
                });
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }else{
            $location.hash("mensagens");
            $anchorScroll();
        }
    }

    $scope.getEmpresa();
    $scope.getCidades();

}]);
