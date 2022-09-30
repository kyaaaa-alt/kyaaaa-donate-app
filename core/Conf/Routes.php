<?php namespace Core\Conf;

use Core\Conf\Kyaaaa\Router;

class Routes {
    public function kyaaaaRun() {
        $router = new Router();

        $router->get('/', [\Core\Controllers\HomeCtrl::class,'index']);
        $router->get('/login', [\Core\Controllers\HomeCtrl::class,'login']);

        $router->post('/do_donate', [\Core\Controllers\HomeCtrl::class,'post'])
            ->middleware(function(){ \Core\Conf\Filter\CSRF::donate(); });

        $router->get('/inv/:id', function($id) {
        });


        $router->run();
    }
}