<?php

use wickedsoft\Virtualizor\NetBox;

if (!function_exists('virtualizor')) {
    function virtualizor()
    {
        return app(Virtualizor::class);
    }
}
