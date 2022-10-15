var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask']);
app.controller('contatoController', ['$scope', '$http','$filter','$window','$location','$anchorScroll', function($scope,$http,$filter,$window,$location,$anchorScroll) {
    
    $scope.setContato = function(){
        if($scope.form_contato.$valid){
            $http({
                url: 'https://aggravated-hoods.000webhostapp.com/envia_email_contato.php',
                method: 'GET',
                params: {
                    nome: btoa($scope.contato.nome),
                    email: btoa($scope.contato.email),
                    assunto: btoa($scope.contato.assunto),
                    mensagem: btoa($scope.contato.mensagem)
                }
            }).then(function (retorno) {
                swal({
                    title: "Sucesso!",
                    text: "E-mail enviado com sucess.",
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
    }
}]);
