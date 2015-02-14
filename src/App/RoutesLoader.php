<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    private function instantiateControllers()
    {
        $this->app['items.controller'] = $this->app->share(function () {
            return new Controllers\ItemsController($this->app['items.service']);
        });

        $this->app['cart.controller'] = $this->app->share(function () {
            return new Controllers\CartController($this->app['cart.service']);
        });
    }

    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];

        $api->get('/items/list', "items.controller:getAll");
        $api->put('/items/save', "items.controller:save");
        $api->put('/items/update/{id}', "items.controller:update");
        $api->delete('/items/{id}', "items.controller:delete");

        $api->post('/cart/add', "cart.controller:add");
        $api->delete('/cart/{id}', "cart.controller:delete");

        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}

