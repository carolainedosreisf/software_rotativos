var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('fotosEstacionamentoController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.objEstacionamento = {};

    $scope.getEstacionamento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Estacionamento/getEstacionamento',
            method: 'GET',
            params:{EstacionamentoId}
        }).then(function (retorno) {
            $scope.objEstacionamento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getFotos = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Estacionamento/getFotos',
            method: 'GET',
            params:{EstacionamentoId}
        }).then(function (retorno) {
            $scope.lista_fotos = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setFoto = function(){
        if($scope.files){
            $scope.mensagem = "";
            var form_data = new FormData();  
            angular.forEach($scope.files, function(file){  
                form_data.append('file', file);  
            });

            $http.post(base_url+'/Estacionamento/setFoto?EstacionamentoId='+EstacionamentoId, form_data,  
            {  
                transformRequest: angular.identity,  
                headers: {'Content-Type': undefined,'Process-Data': false}  
            }).success(function(response){ 
                $scope.carregando = false;
                if(response.erro_tipo){
                    $scope.mensagem = "Extensão de imagem inválida!";
                }else if(response==1){
                    window.location.reload();
                }else{
                    swal('Erro ao salvar!','','warning');
                }
                
            });  
            $scope.carregando = true;
        }else{
            $scope.mensagem = "Selecione uma imagem.";
        }
    }

    $scope.excluirFoto = function(dados){
        swal({
            title: "",
            text: "Deseja realmente apagar a foto?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          },
          function(){
            $http({
                url: base_url+'/Estacionamento/excluirFoto',
                method: 'POST',
                data: dados
            }).then(function (retorno) {
                $scope.getFotos();
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        });
    }

    $scope.getEstacionamento();
    $scope.getFotos();
}]);

app.directive("fileInput", function($parse){  
    return{  
         link: function($scope, element, attrs){  
              element.on("change", function(event){  
                   var files = event.target.files;  
                   $parse(attrs.fileInput).assign($scope, element[0].files);  
                   $scope.$apply();  
              });  
         }  
    }  
});  
