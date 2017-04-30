<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fragment" content="!">
    <base href="/">
    <title>Silex 2.x + AngularJS 1.x</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
        section {margin-bottom: 10px;}
    </style>
</head>

<body>

<div class="container-fluid">
    <ng-view></ng-view>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-route.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-resource.min.js"></script>
<script>
    ;(function (angular) {
        'use strict';

        /**
         * Init
         */
        angular.module('app', ['ngRoute', 'ngResource']);


        /**
         * Config
         */
        angular.module('app').config(AppConfig);
        AppConfig.$inject = ['$locationProvider', '$routeProvider'];
        function AppConfig($locationProvider, $routeProvider) {
            $locationProvider.hashPrefix('!');
            $routeProvider
                .when('/', {
                    templateUrl : '/app/views/default.html',
                    controller : 'DefaultController'
                })
                .when('/items', {
                    templateUrl : '/app/views/item.list.html',
                    controller : 'ItemListController'
                })
                .when('/items/:id', {
                    templateUrl : '/app/views/item.view.html',
                    controller : 'ItemViewController'
                })
                .otherwise({redirectTo: '/'});
        }


        /**
         * Controllers
         */
        angular.module('app').controller('DefaultController', DefaultController);
        DefaultController.$inject = ['$scope', '$log'];
        function DefaultController($scope, $log) {}


        angular.module('app').controller('ItemListController', ItemListController);
        ItemListController.$inject = ['$scope', '$log', 'Item'];
        function ItemListController($scope, $log, Item) {
            $scope.items = [];
            Item.findAll({}, function (items) {
                $scope.items = items;
            });
            $scope.createItem = function() {
                var item = new Item({title: 'Item title'});
                item.$save().then(function(data) {
                    $log.log(data);
                    $scope.items.push(data);
                }, function(errResponse) {
                    $log.log(errResponse);
                });
            };
        }


        angular.module('app').controller('ItemViewController', ItemViewController);
        ItemViewController.$inject = ['$scope', '$log', '$routeParams', 'Item'];
        function ItemViewController($scope, $log, $routeParams, Item) {
            $scope.item = null;
            Item.get({id: $routeParams.id}, function(item) {
                $scope.item = item;
                $log.log(item);
            });
            $scope.updateItem = function(id) {
                Item.get({id: id}, function(item) {
                    $scope.item = item;
                    $scope.item.title = 'New item title';
                    $scope.item.$update().then(function(data) {
                        $log.log(data);
                    }, function(errResponse) {
                        $log.log(errResponse);
                    });
                });
            };
            $scope.deleteItem = function(id) {
                Item.get({id: id}, function(item) {
                    $scope.item = item;
                    $scope.item.$delete().then(function(data) {
                        $log.log(data);
                    }, function(errResponse) {
                        $log.log(errResponse);
                    });
                });
            };
        }


        /**
         * Factories, Services
         */
        angular.module('app').factory('Item', ItemFactory);
        ItemFactory.$inject = ['$resource'];
        function ItemFactory($resource) {
            return $resource('/api.php/items/:id', {id: '@id'}, {
                update: {
                    method: 'PUT'
                },
                findAll: {
                    method: 'GET',
                    isArray: true
                }
            });
        }
    })(angular);
</script>
</body>

</html>
