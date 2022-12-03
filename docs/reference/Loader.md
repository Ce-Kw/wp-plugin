---
layout: default
title: Loader
parent: Reference
has_toc: false
---

# Loader
{: .no_toc }

Class to initialize the framework.

```php
$loader = new \CEKW\WpPlugin\Loader(__FILE__);
$loader
    ->addServices([
        ...
    ])
    ->bootstrap();
```

* Full name: `\CEKW\WpPlugin\Loader`


<details open markdown="block">
  <summary>
    Table of contents
  </summary>
  {: .text-delta }
1. TOC
{:toc}
</details>


## Properties

| Name | Type | Description |
|------|------|-------------|
| restRouteCollection | `\CEKW\WpPlugin\RestRouteCollection` |   |
| routeCollection | `\Symfony\Component\Routing\RouteCollection` |   |
| serviceInstances | `array` | Instances of classes defined in `Loader::addServices()`.  |
| pluginFile | `string` | The filename of the plugin including the path.  |
| injector | `\Auryn\Injector` | Injector instance that can be overriden.  |

## Methods
### __construct 




```php
Loader::__construct(string pluginFile, \Auryn\Injector injector = new Injector())
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| pluginFile | `string` |  |
| injector | `\Auryn\Injector` |  |



### addServices 
Instantiates custom service classes of this plugin and prepares them for autowiring.



```php
Loader::addServices(array services): self
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| services | `array` |  |


**Returns:** `self` 
### bootstrap 
Bootstraps the framework and sets up all the hooks. Should be the final method called.



```php
Loader::bootstrap(): void
```



**Returns:** `void` 
### getUrlGenerator 
Returns the `UrlGenerator` for use in other plugins or themes.



```php
Loader::getUrlGenerator(): \Symfony\Component\Routing\Generator\UrlGenerator
```



**Returns:** `\Symfony\Component\Routing\Generator\UrlGenerator` 

**See:**

* `\Symfony\Component\Routing\Generator\UrlGenerator`  

### registerHooks 
Callback that registers all hooks in service classes that implement `HookSubscriberInterface`
and adding their hooks via `Action` or `Filter` attributes.



```php
Loader::registerHooks(): void
```



**Returns:** `void` 

**See:**

* `\CEKW\WpPlugin\HookSubscriberInterface`  

### collectRestRoutes 
Collects all REST routes from service classes extending `AbstractRestController`
and using the `RestRoute` attribute so that they can be displayed in `DebugRestRouterCommand`.



```php
Loader::collectRestRoutes(): void
```



**Returns:** `void` 

**See:**

* `\CEKW\WpPlugin\AbstractRestController`  

### registerRestRoutes 
Callback that registers all routes collected in `RestRouteCollection`.



```php
Loader::registerRestRoutes(): void
```



**Returns:** `void` 

**See:**

* `\CEKW\WpPlugin\RestRouteCollection`  

### registerRoutes 
Callback that registers all routes from service classes extending `AbstractController`
and using the `Route` attribute.



```php
Loader::registerRoutes(): void
```



**Returns:** `void` 

**See:**

* `\CEKW\WpPlugin\AbstractController`  

### registerCliCommands 
Registers all commands in service classes that implement `CommandInterface`.



```php
Loader::registerCliCommands(): void
```



**Returns:** `void` 

**See:**

* `\CEKW\WpPlugin\CommandInterface`  

