# ng-admin
Laravel admin panel based on angular Js
### Installation ###
Add Ng Admin to your composer.json file to require ng-admin :
```
    require : {
        "laravel/framework": "5.4.*",
        "emniis/ng-admin": "dev-master"
    }
```

Update Composer :
```
    composer update
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
