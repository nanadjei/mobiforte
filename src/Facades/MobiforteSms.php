<?php

namespace Nanadjei\Mobiforte\Facades;

use Illuminate\Support\Facades\Facade;

class MobiforteSms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "mobi-forte";
    }
}
