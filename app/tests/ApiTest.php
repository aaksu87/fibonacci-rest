<?php

namespace App\Tests;

use App\Service\MathService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class ApiTest extends WebTestCase
{
    private AbstractBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        parent::setUp();
    }

    public function testNegativeIntegerReturnsError(): void
    {
        $number = -5;

        $this->client->request(
            'GET',
            '/nth-fibonacci/'.$number
        );

        $response = $this->client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
    }


    public function testNonIntegerValueReturnsError(): void
    {
        $number = 'string';

        $this->client->request(
            'GET',
            '/nth-fibonacci/'.$number
        );

        $response = $this->client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testSuccessResult(): void
    {
        $number = rand(0,1000);
        $resultFromService = (new MathService())->getNumber($number);

        $this->client->request(
            'GET',
            '/nth-fibonacci/'.$number
        );

        $response = $this->client->getResponse();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));

        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData, $resultFromService);
    }

}
