var app = angular.module('app', ['ngSanitize']);
app.controller('loginController', ['$scope', '$http','$filter','$location','$anchorScroll','$timeout','$window', function($scope,$http,$filter,$location,$anchorScroll,$timeout,$window) {
    $scope.login = {};
    $scope.mensagem = "";
    
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
        
        $scope.carregando = true;
        $http({
            url: base_url+'index.php/Login/gerarToken',
            method: 'GET',
            params:{LoginId:1}
        }).then(function (retorno) {
            $scope.carregando = false;
            if(retorno.data.erro==1){
                swal({
                    title: "Atenção!",
                    text: "E-mail não ecnontrado em nossa base de dados.",
                    type: "warning",
                    timer: 2000,
                    confirmButtonText: "Ok",
                },function () {});
            }else{
                var data = {
                    a:'R',
                    s:retorno.data.NomeEstacionamento,
                    i:retorno.data.LoginId,
                    //e:retorno.data.Email,
                    e:'caroldosreis97@gmail.com',
                    t:retorno.data.token_code,
                    p:retorno.data.PermissaoId
                };
                $scope.enviaToken(data);
            }
            
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
        
    }

    $scope.enviaToken = function(data,reload=0){
        $http({
            url: 'https://aggravated-hoods.000webhostapp.com/envia_email.php',
            method: 'GET',
            params: data
        }).then(function (retorno) {
            swal({
                title: "Sucesso!",
                text: "E-mail enviado com sucesso!",
                type: "success",
                timer: 2000,
                showConfirmButton: false
            },function () {
                window.location.reload();
            });
        },
        function (retorno) {
        
            console.log('Error: '+retorno.status);
        });
    }

}]);
