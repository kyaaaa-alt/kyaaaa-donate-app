<?php namespace Core\Conf;

use Core\Conf\Kyaaaa\Router;

class Routes {
    public function kyaaaaRun() {
        $router = new Router();

        $router->get('/', [\Core\Controllers\DonateCtrl::class,'index']);
        $router->post('/do_donate', [\Core\Controllers\PaymentCtrl::class,'do_donate'])
            ->middleware('\Core\Filter\CSRF#donate');
        $router->get('/inv/:id', [\Core\Controllers\PaymentCtrl::class,'invoice']);

        $router->get('/login', [\Core\Controllers\AdminCtrl::class,'login']);
        $router->get('/logout', [\Core\Controllers\AdminCtrl::class,'logout']);
        $router->post('/auth', [\Core\Controllers\AdminCtrl::class,'auth'])
            ->middleware('\Core\Filter\CSRF#auth');

        $router->get('/dashboard', [\Core\Controllers\AdminCtrl::class,'index'])
            ->middleware('\Core\Filter\Auth#admin');
        $router->get('/dashboard/settings', [\Core\Controllers\AdminCtrl::class,'settings'])
            ->middleware('\Core\Filter\Auth#admin');

        $router->post('/update_profile', [\Core\Controllers\AdminCtrl::class,'update_profile'])
            ->middleware('\Core\Filter\Auth#admin')
            ->middleware('\Core\Filter\CSRF#update');


        $router->run();
    }
}