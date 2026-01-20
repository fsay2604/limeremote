<?php

namespace Evently\LimeRemote\Facades;

use Illuminate\Support\Facades\Facade;

class LimeRemote extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'limeremote';
    }
}
