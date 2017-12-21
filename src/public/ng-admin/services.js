angular.module('admin')
        .service("UserService", ["$resource", function($resource) {
                return $resource(API+"users/:id" ,{id: '@id'}, {
                      query: {method: 'get', isArray: false, cancellable: true},
                        update: { method:'PUT' }
                    });
        }])
        .service("RoleService", ["$resource", function($resource) {
                return $resource(API+"roles/:id" ,{id: '@id'}, {
                      query: {method: 'get', isArray: false, cancellable: true},
                        update: { method:'PUT' }
                    });
        }])
        .service("PermissionService", ["$resource", function($resource) {
                return $resource(API+"permissions/:id" ,{id: '@id'}, {
                      query: {method: 'get', isArray: false, cancellable: true},
                        update: { method:'PUT' }
                    });
        }])
        .service("SettingService", ["$resource", function($resource) {
                return $resource(API+"settings/:id" ,{id: '@id'}, {
                      query: {method: 'get', isArray: false, cancellable: true},
                        update: { method:'PUT' }
                    });
        }])
        .service("UploadService", ["$resource", function($resource) {
                return $resource(API+"uploads/:id" ,{id: '@id'}, {
                      query: {method: 'get', isArray: false, cancellable: true},
                        update: { method:'PUT' }
                    });
        }])
/** crudgen dont remove **/
        ;
