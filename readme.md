# Iandenh Router

**Router.php** is a simple Router for PHP.

## Example

```php
<?php
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
$router->add(new \Router\CaseInsensitiveRoute('/HaHa'), function($route){
    echo "Hallo, $route->name";
});
$router->route($_GET['q'], function(){
    echo 'error 404';
});
```
