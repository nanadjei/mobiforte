<?php

namespace Test\Unit;

use Test\Utilities\TestBase;
use PHPUnit\Framework\TestCase;

class MobiforteClassMethodsTest extends TestCase
{
    use TestBase;

    /**
     * Test sender Id
     * @test
     * @return string
     */
    public function whoIsSendingTheSms()
    {
        $mobiforte = $this->mobiforte()->from("My Laravel App");

        return $this->assertEquals("My Laravel App", $mobiforte->sender_id);
    }

    /**
     * Get client id
     * @test
     */
    public function getApiClientId()
    {
        return $this->assertEquals("ExampleClientId", $this->mobiforte()->getClientId());
    }

    /**
     * Verify if mobiforte uses the fresh api keys
     * @test
     */
    public function withFreshApiKeys()
    {
        $mobiforte = $this->mobiforte();

        $mobiforte->withFreshApiKeys("someNewApiClientId", "someNewApiSecrete");

        $this->assertEquals("someNewApiClientId", $mobiforte->client_id);

        return $this->assertEquals("someNewApiSecrete", $mobiforte->client_secret);
    }
}
