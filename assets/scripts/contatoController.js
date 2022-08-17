var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask']);
app.controller('contatoController', ['$scope', '$http','$filter','$window','$location','$anchorScroll', function($scope,$http,$filter,$window,$location,$anchorScroll) {
    
    $scope.setContato = function(){
        if($scope.form_contato.$valid){
            
        }
    }
}]);
