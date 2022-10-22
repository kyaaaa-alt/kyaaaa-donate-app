<?php namespace Core\Conf;

use Core\Conf\Kyaaaa\Router;

class Routes {
    public function kyaaaaRun() {
        $router = new Router();

        $router->get('/', [\Core\Controllers\DonateCtrl::class,'index']);

        $router->get('/donate_notification', [\Core\Controllers\DonateCtrl::class,'donate_notification']);

        $router->get('/running_text', [\Core\Controllers\DonateCtrl::class,'running_text']);

        $router->post('/callback', [\Core\Controllers\PaymentCtrl::class,'callback']);

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

        $router->post('/test_notification', [\Core\Controllers\AdminCtrl::class,'test_notification'])
            ->middleware('\Core\Filter\Auth#admin');

        $router->post('/update_profile', [\Core\Controllers\AdminCtrl::class,'update_profile'])
            ->middleware('\Core\Filter\Auth#admin')
            ->middleware('\Core\Filter\CSRF#update');

        $router->post('/update_stream', [\Core\Controllers\AdminCtrl::class,'update_stream'])
            ->middleware('\Core\Filter\Auth#admin')
            ->middleware('\Core\Filter\CSRF#update');

        $router->post('/update_tripay', [\Core\Controllers\AdminCtrl::class,'update_tripay'])
            ->middleware('\Core\Filter\Auth#admin')
            ->middleware('\Core\Filter\CSRF#update');

        $router->post('/update_pusher', [\Core\Controllers\AdminCtrl::class,'update_pusher'])
            ->middleware('\Core\Filter\Auth#admin')
            ->middleware('\Core\Filter\CSRF#update');

        $router->run();
    }
}