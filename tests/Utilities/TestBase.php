<?php

namespace Test\Utilities;

use Nanadjei\Mobiforte\Mobiforte;

trait TestBase
{

    /** Instanciate mobiforte */
    public function mobiforte()
    {
        return (new Mobiforte("ExampleSenderId", "ExampleClientId", "ExampleSecretId"));
    }
}
