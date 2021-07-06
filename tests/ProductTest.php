<?php


namespace App\Tests;


use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetters(): void
    {
        $product = new Product('DELTA128','this is a test', 3, (float) 25.0);

        $this->assertSame($product->getId(), 'DELTA128');
        $this->assertSame($product->getDescription(), 'this is a test');
        $this->assertSame($product->getCategory(), 3);
        $this->assertSame($product->getPrice()->getAmount(), 25.0);
    }
}
