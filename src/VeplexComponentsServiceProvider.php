<?php

namespace VeplexComponents;

use Illuminate\Support\ServiceProvider;

class VeplexComponentsServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    $this->publishes([__DIR__.'/../views' => resource_path('views/components')]);
  }
}