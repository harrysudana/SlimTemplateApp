<?php

$authenticateForRole = function ( $role = 'member' ) {
    return function () use ( $role ) {
        $user = Model::factory('User')->where('username', 'admisn')->find_many();
        if ( $user->belongsToRole($role) === false ) {
            Slim::flash('error', 'Login required');
            Slim::redirect('/admin/login/');
        }
    };
};

$app->map('/admin/login/', function () use ($app) {
            if ($app->request()->isPost()) {
//If valid login, set auth cookie and redirect
            }
            return $app->render('admin/footer.htm');
        })->via('GET', 'POST');

$app->get('/admin/logout', function () use ($app) {
//Remove auth cookie and redirect to login page
        });



$app->get('/admin/', function() use ($app) {
//$users = Model::factory('User')->find_many();
//print_r($users);
            //$app->flash('info', 'Hello there');
            
            $user = Model::factory('User')->where('username', 'admin')->find_many();
            $_SESSION['log.user']=$user;
            var_dump($_SESSION);
            return $app->render('admin/layout.htm');
        });

$app->get('/admin/category/list/' , function() use ($app) {
//$users = Model::factory('User')->find_many();
//print_r($users);

            var_dump($_SESSION);
            return $app->render('admin/layout.htm');
        });
        
$app->get('/admin2/', $authenticateForRole, function() use ($app) {
//$users = Model::factory('User')->find_many();
//print_r($users);

            var_dump($_SESSION);
            return $app->render('admin/layout.htm');
        });
?>
