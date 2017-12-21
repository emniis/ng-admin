# ng-admin
Laravel admin panel based on angular Js
### Installation ###
Add Scafold to your composer.json file to require Scafold :
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

The last required step is to publish views and assets in your application with :
```
    php artisan vendor:publish "Emniis\NgAdmin\NgAdminServiceProvider"
```

Congratulations, you have successfully installed NG Admin !

