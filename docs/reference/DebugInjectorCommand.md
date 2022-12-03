---
layout: default
title: DebugInjectorCommand
parent: Reference
has_toc: false
---

# DebugInjectorCommand
{: .no_toc }





* Full name: `\CEKW\WpPlugin\DebugInjectorCommand`
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
| injector | `\Auryn\Injector` |   |

## Methods
### __construct 




```php
DebugInjectorCommand::__construct(\Auryn\Injector injector)
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| injector | `\Auryn\Injector` |  |



### __invoke 
Display classes and interfaces that can be type-hinted.

## OPTIONS

[--type=<type>]
: Limit the result to the specified type.
---
default: all
options:
  - all
  - classDefinitions
  - delegates
  - prepares
  - aliases
  - shares
---

## EXAMPLES

    wp cekw debug:injector
    wp cekw debug:injector --type=aliases

```php
DebugInjectorCommand::__invoke(array args, array assocArgs): mixed
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| args | `array` |  |
| assocArgs | `array` |  |


**Returns:** `mixed` 
### typeNameToId 




```php
DebugInjectorCommand::typeNameToId(string type): int
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| type | `string` |  |


**Returns:** `int` 
