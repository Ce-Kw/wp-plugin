<?php

declare(strict_types=1);

namespace CEKW\WpPlugin\Tests;

use CEKW\WpPlugin\Attribute\Action;
use CEKW\WpPlugin\AttributeResolver;
use CEKW\WpPlugin\Attribute\Filter;
use ReflectionAttribute;
use ReflectionClass;
use stdClass;

class AttributeResolverTest extends TestCase
{
    public function testThatCallableGetsCalledForEachAttribute()
    {
        $mock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['callback'])
            ->getMock();

        $mock->expects($this->exactly(2))
            ->method('callback');

        $serviceReflection = new ReflectionClass(new class {
            #[
                Action('example'),
                Filter('example')
            ]
            public function methodWithAttributes()
            {
            }
        });

        $attributeResolver = new AttributeResolver(Filter::class, $serviceReflection);
        $attributeResolver->fromMethod([$mock, 'callback'], ReflectionAttribute::IS_INSTANCEOF);
    }
}