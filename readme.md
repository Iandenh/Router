# Iandenh Router

**Router.php** is a simple Router for PHP

## Example

```php
<?php
require_once 'src/Router/Router.php';

$router = new \Router\Router();

$router->add('GET','/', function(){
    echo 'index';
});
$router->add('/foo/*', function(){
    echo 'wildcard';
});
$r->add('/foo/:bar', function($route){
    echo "<br />Hallo word $route->boek";
});
$klein->router($_GET['q'], function(){//Callback for
    echo 'error 404';
});
```
