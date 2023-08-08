'use strict';

var MyStoresBT = angular.module('MyStoresN', []);

MyStoresBT.controller('SearchCtrl' , function ($scope, $http, $element){

    $scope.search = function(){
        var company = $('#company_id').val();
        $http.get('http://ttaudit.com/SearchStoresVisits', {
            params: {dir: $scope.searchInput + '|' + company}
        }).success(function (data){
            $scope.stores = data;
        })
    }

    $scope.clickSimple = function(DirrPassedFromNgClick){
        //alert ('holaaa');
        $scope.searchResult = DirrPassedFromNgClick;
        //console.log($element.find('.list-group-item').text());

        //console.log(DirrPassedFromNgClick);
        $('#codclient').val(DirrPassedFromNgClick);


        $('#codclient').css({"display":"block","color":"red"});
        $scope.menuState = {}
        $scope.menuState.show = false;
        $scope.cambiarMenu = function() {
            $scope.menuState.show = !$scope.menuState.show;
        };

    }

    $scope.clickId = function(DirrPassedFromNgClick){
        //alert ('holaaa');
        $scope.searchId = DirrPassedFromNgClick;

        $('#store_id').val(DirrPassedFromNgClick);

    }


} );

