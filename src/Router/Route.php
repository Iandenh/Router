<?php
/**
 * Created by Ian den Hartog
 * Version 0.2
 * Copyright (c) 2013 Ian den Hartog
 */

namespace Router;


class Route {
    protected $pattern;

    function __construct($pattern)
    {
        if(is_string($pattern))
        {
            $this->pattern = $pattern;
        }
    }

    function __toString()
    {
        return $this->pattern;
    }

    public function pattern($pattern)
    {
        return sprintf('/^%s$/i', $pattern);
    }
}