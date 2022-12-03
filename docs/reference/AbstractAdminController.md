---
layout: default
title: AbstractAdminController
parent: Reference
has_toc: false
---

# AbstractAdminController
{: .no_toc }

Base class for pages and actions in the WordPress admin.



* Full name: `\CEKW\WpPlugin\AbstractAdminController`
* This class implements: `\CEKW\WpPlugin\HookSubscriberInterface`


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
| templatePath | `string` | Path to the templates directory for admin templates.  |
| config | `\CEKW\WpPlugin\Config` | Holds the plugin directory path, URL and basename.  |

## Methods
### __construct 




```php
AbstractAdminController::__construct(\CEKW\WpPlugin\Config config)
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| config | `\CEKW\WpPlugin\Config` |  |



### render 
Renders a template.



```php
AbstractAdminController::render(string template, array params = []): string
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| template | `string` |  |
| params | `array` |  |


**Returns:** `string` 
