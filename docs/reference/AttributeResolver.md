---
layout: default
title: AttributeResolver
parent: Reference
has_toc: false
---

# AttributeResolver
{: .no_toc }

Resolves attributes from a class.



* Full name: `\CEKW\WpPlugin\AttributeResolver`


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
| attributeClassName | `string` | Class name of the attribute to check against.  |
| reflectionClass | `\ReflectionClass` | Reflection of the class to resolve attributes from.  |

## Methods
### __construct 




```php
AttributeResolver::__construct(string attributeClassName, \ReflectionClass reflectionClass)
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| attributeClassName | `string` |  |
| reflectionClass | `\ReflectionClass` |  |



### fromMethod 
Resolves attributes from a method and provides a callback for each attribute.



```php
AttributeResolver::fromMethod(callable callback, int flags): mixed
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| callback | `callable` |  |
| flags | `int` | Use `ReflectionAttribute::IS_INSTANCEOF` if you want to test against an interfac. |


**Returns:** `mixed` 
