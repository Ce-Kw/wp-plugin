<?php

namespace CEKW\WpPlugin\Tests;

use ArrayIterator;
use CEKW\WpPlugin\RestRouteCollection;

class RestRouteCollectionTest extends TestCase
{
    public function testAddRoute()
    {
        $restRouteCollection = new RestRouteCollection();
        $args = [
            'methods' => ['GET'],
            'callback' => fn() => [],
            'permissionCallback' => fn() => true,
            'args' => [],
        ];
        $restRouteCollection->add('test/v1', '/route', $args);

        $this->assertInstanceOf(ArrayIterator::class, $restRouteCollection->getIterator());
        $this->assertEquals(
            ['test/v1' => [array_merge($args, ['route' => '/route'])]],
            $restRouteCollection->getIterator()->getArrayCopy()
        );
    }
}