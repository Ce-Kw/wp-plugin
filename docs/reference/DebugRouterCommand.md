---
layout: default
title: DebugRouterCommand
parent: Reference
has_toc: false
---

# DebugRouterCommand
{: .no_toc }





* Full name: `\CEKW\WpPlugin\DebugRouterCommand`
* This class implements: `\CEKW\WpPlugin\CommandInterface`


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
| routeCollection | `\Symfony\Component\Routing\RouteCollection` |   |

## Methods
### __construct 




```php
DebugRouterCommand::__construct(\Symfony\Component\Routing\RouteCollection routeCollection)
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| routeCollection | `\Symfony\Component\Routing\RouteCollection` |  |



### __invoke 
Display additional routes added on top of WordPress.

## OPTIONS

[<name>]
: The name of the route to get detailed information about.

## EXAMPLES

    wp cekw debug:router
    wp cekw debug:router book_single

```php
DebugRouterCommand::__invoke(array args, array assocArgs): mixed
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| args | `array` |  |
| assocArgs | `array` |  |


**Returns:** `mixed` 
### getControllerFromRoute 




```php
DebugRouterCommand::getControllerFromRoute(\Symfony\Component\Routing\Route route): string
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| route | `\Symfony\Component\Routing\Route` |  |


**Returns:** `string` 
