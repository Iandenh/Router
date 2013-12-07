<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 27-11-13
 * Time: 17:29
 */
require_once 'src/Router/Router.php';

$router = new \Router\Router();

$router->add('GET','/', function(){
    echo 'index';
});
$router->add('/bar/*', function(){
    echo 'wildcard';
});
$router->add('/foo/:name', function($route){
    echo "Hallo, $route->name";
});
$router->route($_GET['q'], function(){//Callback for
    echo 'error 404';
});

