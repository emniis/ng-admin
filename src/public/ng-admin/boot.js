
var APPBASE = '/admin/';
var APP_VIEWS_BASE = '/admin/view/';
var BASE = '/';
var API = '/admin/api/';
var MSG = {
    OK : 'Ok',
    CANCEL : 'Annuler',
    OP_GOOD:'Opération réussie',
    OP_BAD: 'Opération Echouée',
    OP_NOVALID: 'Données Invalides',
    OP_CONFIRM: "voulez-vous vraiment effectuer cette opération ?",
    OP_CONFIRM_TITLE: "Confirmation Operation",
    E_500: '500 erreur interne',
    FILE_REQUIRED: 'Veuillez selectionner un fichier',
    UPLOAD_FAIL: 'Envoi du fichier Echoué',
    ROW_EXIST: 'Cet élément existe déjà dans la liste',
    DEL_ONE_CONFIRM: 'Voulez-vous vraiment supprimer cet élément ? ',
    IRREVERSIBLE_CONFIRM: "Etes vous sure de vouloir effectuer cette operation? NB :  opération irreversible"
};

angular.module('admin',
                ['ngRoute',
                    'ngResource',
                    'ui.bootstrap',
                    'ngTable',
                    'ngFileUpload',
                    'infinite-scroll',
                    'validation',
                    'validation.rule',
                    'chart.js',
                    'angucomplete-alt',
                    'moment-picker',
                    'ckeditor',
                    'oc.lazyLoad',
                    'angularFileUpload',
                    'ui.select',
                    'ngSanitize'
                ],
                function($interpolateProvider) {
                /*$interpolateProvider.startSymbol('[[');
                $interpolateProvider.endSymbol(']]');*/
            });

angular.module('admin')
    .config(['$routeProvider','$locationProvider',
        function($routeProvider,$locationProvider) {

    //cfpLoadingBarProvider.spinnerTemplate = '<div class="loader">Chargement...</div>';
            $locationProvider.hashPrefix('');
            // Système de routage
            $routeProvider
            .when('/', {
                title:"Tableau de bord",
                templateUrl: APP_VIEWS_BASE+'dashboard',
                controller: 'DashboardController',
                resolve: {
                    lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            name: 'admin',
                            files: [
                                BASE+'ng-admin/dashboard-controller.js'
                            ]
                        });
                    }]
                }
            })
            .when('/role', {
                title:" Roles ",
                templateUrl: APP_VIEWS_BASE+'role',
                controller: 'RoleController',
                resolve: {
                    lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            name: 'admin',
                            files: [
                                BASE+'ng-admin/role-controller.js'
                            ]
                        });
                    }]
                }
            })
            .when('/role/:id/permissions', {
                title:" Permissions ",
                templateUrl: APP_VIEWS_BASE+'role_permission',
                controller: 'RolePermissionController',
                resolve: {
                    lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            name: 'admin',
                            files: [
                                BASE+'ng-admin/role-controller.js'
                            ]
                        });
                    }]
                }
            })
            .when('/permission', {
                title:" Permissions ",
                templateUrl: APP_VIEWS_BASE+'permission',
                controller: 'PermissionController',
                resolve: {
                    lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            name: 'admin',
                            files: [
                                BASE+'ng-admin/permission-controller.js'
                            ]
                        });
                    }]
                }
            })
            .when('/profile', {
                title:"Profile",
                templateUrl: APP_VIEWS_BASE+'profile',
                controller: 'ProfileController',
                resolve: {
                    lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            name: 'admin',
                            files: [
                                BASE+'ng-admin/profile-controller.js'
                            ]
                        });
                    }]
                }
            })
            .when('/setting', {
                templateUrl: APP_VIEWS_BASE+'setting',
                controller: 'SettingController',
                resolve: {
                    lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            name: 'admin',
                            files: [
                                BASE+'ng-admin/setting-controller.js'
                            ]
                        });
                    }]
                }
            })
/** crudgen dont remove **/
            .otherwise({
                redirectTo: '/'
            });

        }
    ]).run(['$rootScope', function($rootScope) {
    $rootScope.page = {
        setTitle: function(title) {
            this.title = title;
        }
    }

    $rootScope.$on('$routeChangeSuccess', function(event, current, previous) {
        $rootScope.page.setTitle(current.$$route.title || ' Administration');
    });
}]).controller('AppController',['$rootScope','$scope','$http','$uibModal',function($rootScope, $scope, $http, $uibModal){

              $rootScope.API = API;
              $rootScope.BASE = BASE;
              $rootScope.APPBASE = APPBASE;
              $rootScope.searchQuery = null;
              $scope.logout = function(){
                    if (confirm("Voulez-vous vraiment vous déconnecter")) {
                        $http.post(APPBASE+'logout')
                            .success(function(d) {
                                  window.location.href=APPBASE;
                            });
                    }

               };

        }])
    .controller('DetailModalController', function ($scope, $uibModalInstance, item) {

          $scope.item = item;
          $scope.close = function () {
            $uibModalInstance.close();
          };
    });
