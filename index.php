<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 27-11-13
 * Time: 17:29
 */
require_once 'src/Router/Router.php';
require_once 'src/Router/Route.php';

$router = new \Router\Router();

$router->add('GET','/', function(){
    echo 'index';
});
$router->add('/haha', function(){
    echo 'wildcard';
});
$router->add('/bar/*', function(){
    echo 'wildcard';
});
$router->add('/foo/:name', function($route){
    echo "Hallo, $route->name";
});
$router->route($_GET['q'], function(){
    echo 'error 404';
});

