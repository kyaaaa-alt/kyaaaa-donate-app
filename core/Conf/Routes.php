<?php namespace Core\Conf;

use Core\Conf\Kyaaaa\Router;

class Routes {
    public function kyaaaaRun() {
        $router = new Router();

        $router->get('/', [\Core\Controllers\DonateCtrl::class,'index']);
        $router->get('/login', [\Core\Controllers\DonateCtrl::class,'login']);

        $router->post('/do_donate', [\Core\Controllers\DonateCtrl::class,'post'])
            ->middleware(function(){ \Core\Conf\Filter\CSRF::donate(); });

        $router->get('/inv/:id', function($id) {
        });


        $router->run();
    }
}