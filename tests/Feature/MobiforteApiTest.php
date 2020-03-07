<?php

namespace Test\Unit;

use Prophecy\Prophet;
use GuzzleHttp\HandlerStack;
use Test\Utilities\TestBase;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;


class MobiforteApiTest extends TestCase
{
    use TestBase;

    private $prophet;

    protected $mockHandler;

    /**
     * Set up method which is called before any tests are
     * run. Mocks of the services that the class being tested rely on are
     * created.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->mockHandler = new MockHandler();
        $handler = HandlerStack::create($this->mockHandler);
        $this->mockHttp = new Guzzle(['handler' => $handler]);
    }

    /**
     * Find out how much you have on your sms account
     * @test
     */
    public function checkSmsBalance()
    {
        $willReturn = (string) json_encode([
            'status' => 'success',
            'balance' => 1200
        ]);

        $this->mockHandler->append(new Response(200, ['X-Foo' => 'Bar'], $willReturn));

        $mobiforte = $this->mobiforte();

        $mobiforte->setClient($this->mockHttp);

        $this->assertSame($willReturn, (string) $mobiforte->balance());

        // $wrongApiKey = {"status": "error", "message": "Invalid API authorization keys", "code": 401 };
        // $this->mobiforte();
        // return $this->assertTrue(true);
    }


    /**
     * Find out how much you have on your sms account
     * @test
     */
    public function checkSmsBalanceError()
    {
        $willReturn = (string) json_encode([
            'status' => 'success',
            'balance' => 1200
        ]);

        $this->mockHandler->append(new Response(200, ['X-Foo' => 'Bar'], $willReturn));

        $mobiforte = $this->mobiforte();

        $mobiforte->setClient($this->mockHttp);

        $this->assertSame($willReturn, (string) $mobiforte->balance());
    }
    /**
     * Find out how much you have on your sms account
     * @test
     */
    public function checkSend()
    {
        $willReturn = (string) json_encode([
            'status' => 'success',
            'balance' => 1200
        ]);

        $this->mockHandler->append(new Response(200, ['X-Foo' => 'Bar'], $willReturn));

        $mobiforte = $this->mobiforte();

        $mobiforte->setClient($this->mockHttp);

        $this->assertSame($willReturn, (string) $mobiforte->balance());
    }


    /**
     * Find out how much you have on your sms account
     * @test
     */
    public function checkSendError()
    {
        $willReturn = (string) json_encode([
            'status' => 'success',
            'balance' => 1200
        ]);

        $this->mockHandler->append(new Response(200, ['X-Foo' => 'Bar'], $willReturn));

        $mobiforte = $this->mobiforte();

        $mobiforte->setClient($this->mockHttp);

        $this->assertSame($willReturn, (string) $mobiforte->balance());
    }
}
