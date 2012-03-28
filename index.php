<?php
//SlimFramework
require 'app/vendors/Slim/Slim/Slim.php';
// Views
require 'app/vendors/Slim-Extras/Views/TwigView.php';
// Idiorm and Paris
require 'app/vendors/idiorm/idiorm.php';
require 'app/vendors/paris/paris.php';
// Configuration
require_once('app/vendors/yaml/lib/sfYaml.php');
require_once('app/vendors/yaml/lib/sfYamlParser.php');
//Load Custom Library
require 'app/libraries/Site.php';

TwigView::$twigDirectory = __DIR__ . '/app/vendors/Twig/lib/Twig/';

$app = new Slim(array(
            'view' => new TwigView,
            'session.handler' => true,
        ));

//set app config from config.yml file
$parser = new sfYamlParser();
$config = $parser->parse(file_get_contents(dirname(__FILE__).'/app/data/config.yml'));
$site = new Site();
$app->config('config', $site->arrayToObject($config));

//start database engine
ORM::configure('mysql:host=' . $app->config('config')->database->host . ';dbname=' . $app->config('config')->database->name);
ORM::configure('username', $app->config('config')->database->user);
ORM::configure('password', $app->config('config')->database->pass);

//basic routing
$app->get('/', function () use ($app) {
    echo "hello, kenken khabare broo...?";
});

//if want routing more complex just use seperate routing
//require 'app/routes/session.php';
//require 'app/routes/member.php';
//require 'app/routes/admin.php';

$app->run();
?>