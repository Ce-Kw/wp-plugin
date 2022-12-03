---
layout: default
title: AbstractController
parent: Reference
has_toc: false
---

# AbstractController
{: .no_toc }

Base class for custom routes on top of WordPress.



* Full name: `\CEKW\WpPlugin\AbstractController`


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
| templatePath | `string` | Path to the templates directory for public templates.  |
| config | `\CEKW\WpPlugin\Config` | Holds the plugin directory path, URL and basename.  |
| urlGenerator | `\Symfony\Component\Routing\Generator\UrlGenerator` |   |

## Methods
### __construct 




```php
AbstractController::__construct(\CEKW\WpPlugin\Config config, \Symfony\Component\Routing\Generator\UrlGenerator urlGenerator)
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| config | `\CEKW\WpPlugin\Config` |  |
| urlGenerator | `\Symfony\Component\Routing\Generator\UrlGenerator` |  |



### generateUrl 
Generates a URL from the given parameters.



```php
AbstractController::generateUrl(string routeName, array params = []): string
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| routeName | `string` |  |
| params | `array` |  |


**Returns:** `string` 

**See:**

* `\Symfony\Component\Routing\Generator\UrlGenerator`  

### redirect 
Performs a `wp_redirect` to the given URL.



```php
AbstractController::redirect(string url, int status = 302): void
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| url | `string` |  |
| status | `int` | The HTTP status code (302 by default). |


**Returns:** `void` 
### redirectToRoute 
Performs a `wp_redirect` to the given route with the given parameters.



```php
AbstractController::redirectToRoute(string routeName, array params = [], int status = 302): void
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| routeName | `string` |  |
| params | `array` |  |
| status | `int` | The HTTP status code (302 by default). |


**Returns:** `void` 
### setTitle 
Sets part of the document title.



```php
AbstractController::setTitle(string title): void
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| title | `string` |  |


**Returns:** `void` 
### setUrl 
Sets the canonical URL for the current route.



```php
AbstractController::setUrl(string url): void
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| url | `string` |  |


**Returns:** `void` 
### render 
Injects template into WordPress.



```php
AbstractController::render(string template, array params = []): void
```


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| template | `string` | Path to a template file. |
| params | `array` |  |


**Returns:** `void` 
