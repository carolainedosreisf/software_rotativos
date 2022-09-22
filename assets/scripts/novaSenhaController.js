var app = angular.module('app', ['ngSanitize']);
app.controller('novaSenhaController', ['$scope', '$http','$location','$window', function($scope,$http,$location,$window) {
    $scope.cadSenha = {
        LoginId
    };

    $scope.setNovaSenha = function(){
        if($scope.form_senha.$valid && $scope.cadSenha.Senha == $scope.cadSenha.ConfirmSenha){
            $http({
                url: base_url+'index.php/Login/setNovaSenha',
                method: 'POST',
                data: $scope.cadSenha
            }).then(function (retorno) {
                $scope.carregando = false;
                swal({
                    title: "Sucesso!",
                    text: "Senha adastrada com sucesso..",
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
        }
    }
}]);
