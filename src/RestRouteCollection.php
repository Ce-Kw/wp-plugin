<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

use ArrayIterator;
use IteratorAggregate;

class RestRouteCollection implements IteratorAggregate
{
    protected array $restRoutes = [];

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->restRoutes);
    }

    public function add(string $namespace, string $route, array $restRouteArgs)
    {
        if (empty($this->restRoutes[$namespace])) {
            $this->restRoutes[$namespace] = [];
        }

        $restRouteArgs['route'] = $route;
        $this->restRoutes[$namespace][] = $restRouteArgs;
    }

    public function getByNamespace(string $namespace): array
    {
        return $this->restRoutes[$namespace] ?? [];
    }
}