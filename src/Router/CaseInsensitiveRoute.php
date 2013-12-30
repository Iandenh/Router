<?php
/**
 * Created by Ian den Hartog
 * Version 0.2
 * Copyright (c) 2013 Ian den Hartog
 */

namespace Router;


class CaseInsensitiveRoute extends Route{
    public function pattern($pattern)
    {
        return sprintf('/^%s\/?$/', $pattern);
    }

} 