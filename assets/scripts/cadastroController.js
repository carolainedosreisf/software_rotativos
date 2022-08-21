var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask']);
app.controller('cadastroController', ['$scope', '$http','$filter','$timeout','$location','$anchorScroll', function($scope,$http,$filter,$timeout,$location,$anchorScroll) {
    $scope.lista_cidades = [];
    $scope.erro_cep = false;
    $scope.cad = {
        TipoEmpresa : 'J'
    };

    $scope.changeTipo = function(){
        $scope.cad.Cpf = '';
        $scope.cad.Cnpj = '';
    }

    $scope.buscaCep = function(){
        if ($scope.cad.NumeroCep != undefined) {
            if ($scope.cad.NumeroCep.length==8) {
                $scope.carregando = true;
                $http({
                    url: `https://viacep.com.br/ws/${$scope.cad.NumeroCep}/json/`,
                    method: 'GET'
                }).then(function (retorno) {
                    if(!(retorno.data.erro)){
                        $scope.erro_cep = false;
                        $scope.cad.Endereco = retorno.data.logradouro;
                        $scope.cad.BairroEndereco = retorno.data.bairro;
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
        $scope.cad.CidadeId = "";
        $scope.cad.Endereco = "";
        $scope.cad.BairroEndereco = "";
    }

    $scope.getCidades = function(desc=''){
        $scope.carregando = true;
        $http({
            url: base_url+'index.php/Cadastro/getCidades',
            method: 'GET',
            params:{desc}
        }).then(function (retorno) {
            if(desc){
                if(retorno.data.length > 0){
                    $scope.cad.CidadeId = retorno.data[0]['CidadeId'];
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
    
    $scope.setCadastro = function(){
        if($scope.form_cadastro.$valid && $scope.cad.Senha == $scope.cad.confirm_senha  && ($scope.cad.Senha).length >=8 && !($scope.erro_cep)){
            $http({
                url: base_url+'index.php/Cadastro/getValidaDados',
                method: 'GET',
                params: {
                    NomeUsuario:$scope.cad.NomeUsuario
                    ,Email:$scope.cad.Email
                    ,CpfCnpj: ($scope.cad.TipoEmpresa=='J'?$scope.cad.Cnpj:$scope.cad.Cpf)
                    ,TipoEmpresa:$scope.cad.TipoEmpresa
                }
            }).then(function (retorno) {
                if((retorno.data).length==0){
                    $scope.carregando = true;
                    $scope.lista_erros = [];
                    $http({
                        url: base_url+'index.php/Cadastro/setCadastro',
                        method: 'POST',
                        data: $scope.cad
                    }).then(function (retorno) {
                        $scope.carregando = false;
                        swal({
                            title: "Sucesso!",
                            text: "Cadastro realizado com sucesso..",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                        },function () {
                            window.location = base_url+"index.php/Login";
                        });
                    },
                    function (retorno) {
                        console.log('Error: '+retorno.status);
                    });
                }else{
                    $scope.lista_erros = retorno.data;;
                    $location.hash("mensagens");
                    $anchorScroll();
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

    $scope.getCidades();

}]);
