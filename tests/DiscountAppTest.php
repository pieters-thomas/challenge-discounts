<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DiscountAppTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Place Order!');
    }

    public function testIndexPost(): void
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/', ['order'=>'1']);

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Place Order!');
    }
}
