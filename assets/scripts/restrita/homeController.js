google.charts.load('current', {packages: ['corechart'], 'language': 'pt-br'});
var app = angular.module('app', ['ui.utils.masks','ui.mask','ngSanitize']);
app.controller('homeController', ['$scope', '$http','$filter','$location', function($scope,$http,$filter,$location) {
    var options = {tooltip: {isHtml: false}};
    var columns = [0, 1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2];
    var now = new Date;
    $scope.Ano = now.getFullYear();
    $scope.Mes = PermissaoId==2?(now.getMonth()+1)+"":"";

    $scope.lista_meses = lista_meses;

    $scope.getVerificaPagamento = function(){
        $scope.carregando = true;
        $http({
            url: base_url+'/Pagamentos/getVerificaPagamento',
            method: 'GET',
        }).then(function (retorno) {
            $scope.verificacao = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getDadosGrafico = function(){
        if($scope.form_filtrar.$valid){
            $scope.carregando = true;
            $http({
                url: base_url+'/Home/'+(PermissaoId==1?'getDadosGraficoEmpresas':'getDadosGrafico'),
                method: 'GET',
                params: { 
                    Ano:$scope.Ano
                    ,Mes:$scope.Mes
                }
            }).then(function (retorno) {
                $scope.lista = retorno.data;
                $scope.title = PermissaoId==1?'Cadastros de empresas no sistema':'Faturamento do '+($scope.Mes?'Mês':'Ano');
                if($scope.lista.length>1){
                    var height = (($scope.lista.length-1)*60);
                    document.getElementById("myChart").style.height = height<300?300:height+"px";
                    setTimeout(() => {
                        google.charts.setOnLoadCallback(montaGrafico())
                    }, 100);
                }
                
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
        
    }

    var montaGrafico = function(){
        var dataTable = new google.visualization.DataView(google.visualization.arrayToDataTable($scope.lista));
        var chart = new google.visualization.BarChart(document.getElementById('myChart'))
        dataTable.setColumns(columns);
        options.vAxis = {title: $scope.Mes?'Dias do Mês':'Meses do Ano'};
        chart.draw(dataTable, options);
    }

    if(PermissaoId==2||PermissaoId==1){
        setTimeout(() => {
            $scope.getDadosGrafico();
        }, 100);
    }

    if(PermissaoId==2|| PermissaoId==3){
        $scope.getVerificaPagamento();
    }

}]);


