---
layout: default
title: Filter
parent: Reference
has_toc: false
---

# Filter
{: .no_toc }

Attribute class as a wrapper around `add_filter`.



* Full name: `\CEKW\WpPlugin\Attribute\Filter`


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
| hookName | `string` | The name of the filter to add the callback to.  |
| priority | `int` | Used to specify the order in which the functions associated with a particular filter are executed. Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the filter. |
| acceptedArgs | `int` | The number of arguments the function accepts.  |

## Methods
### __construct 




```php
Filter::__construct(string hookName, int priority = 10, int acceptedArgs = 1)
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| hookName | `string` |  |
| priority | `int` |  |
| acceptedArgs | `int` |  |



