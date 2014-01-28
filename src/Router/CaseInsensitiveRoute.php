<?php
/**
 * Created by Ian den Hartog
 * Version 0.3
 * Copyright (c) 2013 Ian den Hartog
 */

namespace Router;


class CaseInsensitiveRoute extends Route{
    public function pattern($pattern)
    {
        return sprintf('/^%s\/?$/', preg_quote($pattern, '/'));
    }

} 