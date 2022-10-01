<?php namespace Core\Conf;

use Core\Conf\Kyaaaa\Router;

class Routes {
    public function kyaaaaRun() {
        $router = new Router();

        $router->get('/', [\Core\Controllers\DonateCtrl::class,'index']);
        $router->post('/do_donate', [\Core\Controllers\PaymentCtrl::class,'do_donate']);

//        $router->post('/do_donate', [\Core\Controllers\PaymentCtrl::class,'do_donate'])
//            ->middleware(function(){ \Core\Conf\Filter\CSRF::donate(); });

        $router->get('/inv/:id', [\Core\Controllers\PaymentCtrl::class,'invoice']);

        $router->get('/login', [\Core\Controllers\AdminCtrl::class,'login']);


        $router->run();
    }
}