---
layout: default
title: RestRouteCollection
parent: Reference
has_toc: false
---

# RestRouteCollection
{: .no_toc }





* Full name: `\CEKW\WpPlugin\RestRouteCollection`
* This class implements: `\IteratorAggregate`


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
| restRoutes | `array` |   |

## Methods
### getIterator 




```php
RestRouteCollection::getIterator(): \ArrayIterator
```



**Returns:** `\ArrayIterator` 
### add 




```php
RestRouteCollection::add(string namespace, string route, array restRouteArgs): mixed
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| namespace | `string` |  |
| route | `string` |  |
| restRouteArgs | `array` |  |


**Returns:** `mixed` 
### getByNamespace 




```php
RestRouteCollection::getByNamespace(string namespace): array
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| namespace | `string` |  |


**Returns:** `array` 
