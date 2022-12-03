---
layout: default
title: RestRoute
parent: Reference
has_toc: false
---

# RestRoute
{: .no_toc }

Attribute class as a wrapper around `register_rest_route`.



* Full name: `\CEKW\WpPlugin\Attribute\RestRoute`


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
| route | `string` | The base URL for route you are adding.  |
| namespace | `string` | The first URL segment after core prefix. Should be unique to your package/plugin.  |
| methods | `array` | The HTTP methods this route supports.  |

## Methods
### __construct 




```php
RestRoute::__construct(string route, string namespace, array methods = ['GET'])
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| route | `string` |  |
| namespace | `string` |  |
| methods | `array` |  |



