---
layout: default
title: DebugRestRouterCommand
parent: Reference
has_toc: false
---

# DebugRestRouterCommand
{: .no_toc }





* Full name: `\CEKW\WpPlugin\DebugRestRouterCommand`
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
| restRouteCollection | `\CEKW\WpPlugin\RestRouteCollection` |   |

## Methods
### __construct 




```php
DebugRestRouterCommand::__construct(\CEKW\WpPlugin\RestRouteCollection restRouteCollection)
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| restRouteCollection | `\CEKW\WpPlugin\RestRouteCollection` |  |



### __invoke 
Display current REST routes added from this plugin.

## EXAMPLES

wp cekw debug:rest-router

```php
DebugRestRouterCommand::__invoke(array args, array assocArgs): mixed
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| args | `array` |  |
| assocArgs | `array` |  |


**Returns:** `mixed` 
