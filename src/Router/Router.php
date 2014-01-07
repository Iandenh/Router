<?php
/**
 * Created by Ian den Hartog
 * Version 0.2
 * Copyright (c) 2013 Ian den Hartog
 */

namespace Router;


class Router {
    protected $route = array();
    protected $method;
    protected $wildcard = false;

    function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    private function getLooseArg(array $array)
    {
        $callback = array_pop($array);
        $route = array_pop($array);
        $method = array_pop($array);

        return array(
            'method' => $method,
            'route' => $route,
            'callback' => $callback,
        );
    }

    /**
     * Create a new route using a method, route and callback
     *
     * @param $method
     * @param string $route
     * @param null $callback
     */
    public function add($method, $route = '/', $callback=null)
    {
        extract($this->getLooseArg(func_get_args()),EXTR_OVERWRITE);
        if($method == null)
        {
            $method = array('GET','POST','PUT','DELETE');//default value
        }
        if(!is_object($route))
        {
            $route = new Route($route);
        }

        $this->addMethod($method,$route,$callback);
    }
    private function addMethod($method,Route $route, $callback)
    {
        if(is_callable($callback))
        {
            $row = compact('method', 'route', 'callback');
            $this->route[] = $row;
        }
    }

    /**
     * @param $url
     * @param null $call
     * @return mixed
     */
    public function route($url,$call = null)
    {
        foreach($this->route as $route)
        {
            if($route['method'] == $this->method || (is_array($route['method']) && in_array($this->method,$route['method'])))
            {


                if(preg_match($route['route']->pattern($route['route']),$url))
                {
                    return call_user_func($route['callback']); //simple url
                }
                else
                {
                    $result = $this->match($route['route'],$url);
                    if($result != false)
                    {

                        $object = json_decode(json_encode($result), FALSE);
                        return call_user_func($route['callback'],$object);
                    }
                }
            }
        }
        if(is_callable($call))
        {
            return call_user_func($call);
        }
    }
    private function match($pattern,$url)
    {
        $parts = explode('/', trim($pattern, '/'));
        $partsUrl = explode('/', trim($url, '/'));
        $vars = null;
        if(count($parts) <= count($partsUrl))
        {
            $patterns = array();
            for($i = 0; $i <count($parts); $i++ )
            {
                $patterns[] = array($parts[$i] => $partsUrl[$i]);
            }
        }
        else
        {
            return false;
        }
        foreach($patterns as $route)
        {
            foreach($route as $key => $value)
            {
                if(substr($key, 0, 1) == ':'  || substr($key, 0, 1) == '*' || $this->wildcard == true || preg_match($pattern->pattern($key),$value))
                {
                    if(substr($key, 0, 1) == ':' )
                    {
                        $key = substr($key, 1);
                        $vars[$key] = $value;
                    }
                    elseif(substr($key, 0, 1) == '*' || $this->wildcard == true)
                    {
                        $this->wildcard = true;
                    }
                }
                else
                {
                    return false;
                }

            }
        }
        if($this->wildcard == true)
        {
            return true;
        }
        elseif(count($parts) == count($partsUrl))
            return $vars;
        else
            return false;
    }
} 