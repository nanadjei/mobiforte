<?php

namespace Test\Unit;

use Test\Utilities\TestBase;
use PHPUnit\Framework\TestCase;
use Nanadjei\Mobiforte\Mobiforte;

class MobiforteClassTest extends TestCase
{
    use TestBase;

    /**
     * Verify if newing up $this->mobiforte() will return an instance of Mobiforte
     * @test
     */
    public function mobiforteClassIsAnInstanceOfMobiforte()
    {
        return $this->assertInstanceOf(Mobiforte::class, $this->mobiforte());
    }

    /**
     * Verify if mobiforte class has sender id attibure
     * @test
     */
    public function mobiforteClassHasSenderIdAttibute()
    {
        $this->assertClassHasAttribute('sender_id', Mobiforte::class);
    }

    /**
     * Verify if mobiforte class has client id attibure
     * @test
     */
    public function mobiforteClassHasClientIdAttibute()
    {
        $this->assertClassHasAttribute('client_id', Mobiforte::class);
    }

    /**
     * Verify if mobiforte class has client secret attibure
     * @test
     */
    public function mobiforteClassHasClientSecretAttibute()
    {
        $this->assertClassHasAttribute('client_secret', Mobiforte::class);
    }

    /**
     * Verify if mobiforte class has to attibure
     * @test
     */
    public function mobiforteClassHasToAttibute()
    {
        $this->assertClassHasAttribute('to', Mobiforte::class);
    }

    /**
     * Verify if mobiforte class has message attibure
     * @test
     */
    public function mobiforteClassHasMessageAttibute()
    {
        $this->assertClassHasAttribute('message', Mobiforte::class);
    }

    /**
     * Verify if mobiforte class has date_time attibure
     * @test
     */
    public function mobiforteClassHasDateTimeAttibute()
    {
        $this->assertClassHasAttribute('date_time', Mobiforte::class);
    }
}
