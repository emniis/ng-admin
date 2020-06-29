# ng-admin
Laravel admin panel based on angular Js that include a CRUD generator.

This is compatible with  :
- Angular Js 1.8
- Laravel 5.4 +

### Installation ###
Add Ng Admin to your laravel project via composer:
```
    composer require emniis/ng-admin
```

The next required step is to add the service provider to config/app.php :
```
    Emniis\NgAdmin\NgAdminServiceProvider::class,
```

### Publish ###

The next required step is to publish views and assets in your application with :
```
    php artisan vendor:publish --provider="Emniis\NgAdmin\NgAdminServiceProvider"
```
### Install npm dependencies  ###
The last step is to install ng-admin npm dependencies in laravel public directory (laravel-app-directory/public/)
```
    npm install
```
Congratulations, you have successfully installed NG Admin !
### generate a crud for an entity  ###
Genarate a CRUD for an entity (table) using nga:crud 
```
    php artisan nga:crud <entity> "<the list of table columns coma separated>"
```
Eg: Generate a CRUD for table articles
```
    php artisan nga:crud article "name,content,is_published"
```
Generated files :

an Admin controller : /app/Http/Controllers/Admin/ArticleController.php

a view : /resources/views/ng-admin/articles.php

a model : /app/Models/Article.php

a migration : /database/migrations/<...>create_articles_table.php

Some routes will be added 

Laravel web route in `/routes/web.php`

```
<?php
    ...
      Route::resource('articles', 'Admin\ArticleController');
      /** crudgen routes dont remove this comment **/
    ...
```
Angular route in `/public/ng-admin/boot.js`
```
    ...
                  .when('/articles', {
                      title:"Smarts",
                      templateUrl: APP_VIEWS_BASE+'articles',
                      controller: 'ArticleController',
                      resolve: {
                          lazy: ['$ocLazyLoad', function($ocLazyLoad) {
                              return $ocLazyLoad.load({
                                  name: 'admin',
                                  files: [
                                      BASE+'ng-admin/article-controller.js'
                                  ]
                              });
                          }]
                      }
                  })
      /** crudgen dont remove **/
    ...
```

Angular service in `/public/ng-admin/services.js`
```
    ... 
        .service("ArticleService", ["$resource", function($resource) {
                return $resource(API+"Smarts/:id" ,{id: '@id'}, {
                      query: {method: 'get', isArray: false, cancellable: true},
                        update: { method:'PUT' }
                    });
        }])
      /** crudgen dont remove **/
    ...
```