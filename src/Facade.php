<?php

namespace wickedsoft\Virtualizor;

/**
 * @method static \wickedsoft\Virtualizor\Api
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'Virtualizor';
    }
}
