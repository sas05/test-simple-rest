<?php

namespace App;

use Silex\Application;

class ServicesLoader
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function bindServicesIntoContainer()
    {

        $this->app['items.service'] = $this->app->share(function () {
            return new Services\ItemsService($this->app["db"]);
        });

        $this->app['cart.service'] = $this->app->share(function () {
            return new Services\CartService($this->app["db"]);
        });
    }
}

