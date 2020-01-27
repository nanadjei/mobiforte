<?php

namespace Nanadjei2\Mobiforte\Facades;

use Illuminate\Support\Facades\Facade;

class Mobiforte extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "mobi-forte";
    }
}
