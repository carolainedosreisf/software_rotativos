var app = angular.module('app', ['ngSanitize']);
app.controller('loginController', ['$scope', '$http','$filter','$location','$anchorScroll','$timeout','$window', function($scope,$http,$filter,$location,$anchorScroll,$timeout,$window) {
    $scope.login = {};
    $scope.mensagem = "";
    $scope.esqueci = false;

    $scope.getValidaAcesso = function(){ 
        if($scope.form_login.$valid){
            $scope.mensagem = "";
            $scope.carregando = true;
            $http({
                url: base_url+'index.php/Login/getValidaAcesso',
                method: 'POST',
                data: $scope.login
            }).then(function (retorno) {
                if(retorno.data==1){
                    window.location = base_url+"index.php/restrita/Home";
                }else{
                    $scope.mensagem = "Usuário ou senha inválida.";
                }
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.gerarToken = function(){
        if($scope.form_senha.$valid){
            $scope.carregando = true;
            $http({
                url: base_url+'index.php/Login/gerarToken',
                method: 'GET',
                params:{Email:$scope.EsqueciSenha.Email}
            }).then(function (retorno) {
                $scope.carregando = false;
                if(retorno.data.erro==0){
                    var data = {
                        a:'R',
                        s:retorno.data.NomeEstacionamento,
                        i:retorno.data.LoginId,
                        //e:retorno.data.Email,
                        e:'caroldosreis97@gmail.com',
                        t:retorno.data.token_code,
                        p:retorno.data.PermissaoId
                    };
                    $scope.EsqueciSenha = {};
                    $scope.form_senha.$submitted = false;
                    $scope.form_senha.$setPristine();
                    $scope.enviaToken(data);
                }else{
                    var text = retorno.data.erro==1?"E-mail não ecnontrado em nossa base de dados.":"Usuário desativado."
                    swal({
                        title: "Atenção!",
                        text,
                        type: "warning",
                        timer: 2000,
                        confirmButtonText: "Ok",
                    },function () {});
                    
                }
                
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
        
        
    }

    $scope.enviaToken = function(data){
        $http({
            url: 'https://aggravated-hoods.000webhostapp.com/envia_email.php',
            method: 'GET',
            params: data
        }).then(function (retorno) {
            swal({
                title: "Sucesso!",
                text: "E-mail de recuperação de senha enviado com sucesso!",
                type: "success",
                timer: 2000,
                showConfirmButton: true
            },function () {
            });
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

}]);
