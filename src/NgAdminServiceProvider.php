<?php

namespace Emniis\NgAdmin;

use Illuminate\Support\ServiceProvider;

class NgAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->publishes([
          __DIR__.'/Config/ng-admin.php' => config_path('ng-admin.php'),
          __DIR__.'/public/ng-admin/boot.js' => public_path('ng-admin/boot.js'),
          __DIR__.'/public/ng-admin/services.js' => public_path('ng-admin/services.js'),
          __DIR__.'/public/package.json' => public_path('package.json'),
          __DIR__.'/resources/lang/fr/ng-admin.php' => resource_path('lang/fr/ng-admin.php'),
          __DIR__.'/resources/lang/en/ng-admin.php' => resource_path('lang/en/ng-admin.php'),
          __DIR__.'/resources/views/ng-admin/admin.blade.php' => resource_path('views/ng-admin/admin.blade.php'),
          __DIR__.'/resources/views/ng-admin/sidemenu.blade.php' => resource_path('views/ng-admin/sidemenu.blade.php'),
      ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->commands(
          Console\Commands\NgAdminCrud::class
      );
    }
}
