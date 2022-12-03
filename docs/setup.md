---
layout: default
title: Setup
nav_order: 10
---

# Setup
{: .no_toc }

Add the following lines to the plugins bootstrap file:

```php
$loader = new \CEKW\WpPlugin\Loader(__FILE__);
$loader
    ->addServices([
        ...
    ])
    ->bootstrap();
```

## Adding custom dependencies to the injector

```php
$injector = new Injector();
$injector->alias(LoggerInterface::class, Logger::class);
$injector->define(Logger::class, [
    ':logDirectory' => WP_CONTENT_DIR
]);

class MyCustomConfig
{
  public function __construct(
        public readonly string $customOption;
    ) {}
}
$injector->share(new MyCustomConfig('value'));

$loader = new \CEKW\WpPlugin\Loader(__FILE__, $injector);
...
```

## Making the URL generator accessible to other plugins or themes.
```php
...
global $cekwAppUrlGenerator;
$cekwAppUrlGenerator = $loader->getUrlGenerator();

function get_url_generator() {
    global $cekwAppUrlGenerator;

    return $cekwAppUrlGenerator;
}
```

[Loader class reference](reference/Loader.html)