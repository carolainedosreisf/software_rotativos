var app = angular.module('app', ['ngSanitize']);
app.controller('loginController', ['$scope', '$http','$filter','$location','$anchorScroll','$timeout','$window', function($scope,$http,$filter,$location,$anchorScroll,$timeout,$window) {
    $scope.login = {};
    $scope.mensagem = "";
    
    $scope.getValidaAcesso = function(){ 
        $scope.mensagem = "";
        $scope.carregando = true;
        $http({
            url: base_url+'index.php/Login/getValidaAcesso',
            method: 'POST',
            data: $scope.login
        }).then(function (retorno) {
            if(retorno.data==1){
                console.log("logou");
                //window.location = "../restrita/index.php";
            }else{
                $scope.mensagem = "Usuário ou senha inválida.";
            }
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }
}]);
