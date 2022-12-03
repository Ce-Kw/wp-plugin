---
layout: default
title: AbstractRestController
parent: Reference
has_toc: false
---

# AbstractRestController
{: .no_toc }

Base class for custom REST routes.



* Full name: `\CEKW\WpPlugin\AbstractRestController`


<details open markdown="block">
  <summary>
    Table of contents
  </summary>
  {: .text-delta }
1. TOC
{:toc}
</details>



## Methods
### permissionCheck 
Checks if the user can perform the action (reading, updating, etc) before the real callback is called.



```php
AbstractRestController::permissionCheck(): bool|\WP_Error
```



**Returns:** `bool|\WP_Error` 
### getArgs 
Defines arguments for the route.



```php
AbstractRestController::getArgs(): array
```



**Returns:** `array` 
