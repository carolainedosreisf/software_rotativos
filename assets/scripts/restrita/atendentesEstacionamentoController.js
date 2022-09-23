var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('atendentesEstacionamentoController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    $scope.objEstacionamento = {};
    $scope.objAtendente = {};
    $scope.lista_atendentes = [];
    $scope.filtro = {Status:""};

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

    $scope.getAtendentes = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Estacionamento/getAtendentes',
            method: 'GET',
            params:{
                EstacionamentoId
                ,Status:$scope.filtro.Status
            }
        }).then(function (retorno) {
            $scope.lista_atendentes = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setAtendente = function(){
        if($scope.form_atendente.$valid){
            $scope.lista_erros = [];
            $scope.objAtendente.EstacionamentoId = EstacionamentoId;
            $scope.carregando = true;
            $http({
                url: base_url+'/Estacionamento/setAtendente',
                method: 'POST',
                data: $scope.objAtendente
            }).then(function (retorno) {
                $scope.carregando = false;
                if((retorno.data.lista_erros).length>0){
                    $scope.lista_erros = retorno.data.lista_erros;
                }else{
                    var data = {
                        i:retorno.data.LoginId,
                        e:$scope.objAtendente.Email,
                        t:retorno.data.token_code
                    };
                    $scope.enviaToken(data,1);
                }
                
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.gerarToken = function(dados){
        swal({
            title: "",
            text: "Deseja realmente enviar o token para o e-mail: "+dados.Email+'?',
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          },
          function(){
            $scope.carregando = true;
            $http({
                url: base_url+'/Estacionamento/gerarToken/'+dados.LoginId,
                method: 'GET',
            }).then(function (retorno) {
                $scope.carregando = false;
                var data = {
                    i:dados.LoginId,
                    e:dados.Email,
                    t:retorno.data.token_code
                };
                $scope.enviaToken(data);
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        });
    }

    $scope.enviaToken = function(data,reload=0){
        $http({
            url: 'https://aggravated-hoods.000webhostapp.com/envia_email.php',
            method: 'GET',
            params:{
                a: 'C',
                s:$scope.objEstacionamento.NomeEstacionamento,
                i: btoa(data.i),
                e: data.e,
                t: data.t
            },
            // headers: {
            //     "Access-Control-Allow-Origin": '*',
            //     'Access-Control-Allow-Methods': 'POST, GET',
            //     'Access-Control-Allow-Headers': '*',
            // },
        }).then(function (retorno) {
           
        },
        function (retorno) {
            if(reload==1){
                swal({
                    title: "Sucesso!",
                    text: "Atendente cadastrado com sucesso.",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                },function () {
                    window.location.reload();
                });
           }else{
                swal('Token enviado com sucesso!','','success')
           }
            console.log('Error: '+retorno.status);
        });
    }

    $scope.acaoUsuario = function(dados){
        swal({
            title: "",
            text: `Deseja realmente ${dados.Status=='A'?'desativar':'ativar'} o atendente ${dados.NomeUsuario}?`,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-warning",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          },
          function(){
            $scope.carregando = true;
            $http({
                url: base_url+'/Estacionamento/acaoUsuario',
                method: 'POST',
                data: dados
            }).then(function (retorno) {
                $scope.carregando = false;
                $scope.getAtendentes();
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        });
    }

    $scope.getEstacionamento();
    $scope.getAtendentes();
}]);

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
