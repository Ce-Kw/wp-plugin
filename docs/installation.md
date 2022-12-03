---
layout: default
title: Installation
nav_order: 5
---

# Installation

Make sure you have the following repository and configuration options added to your composer.json file in your WordPress plugin:

```json
{
  "repositories": [{
    "type": "composer",
    "url": "https://ce-kw.github.io/satis/"
  }],
  "minimum-stability": "dev",
  "prefer-stable": true
}
```

Then run `composer require cekw/wp-plugin`.

## Routing on top of WordPress

To disable the routing feature remove the following composer packages:

* `symfony/routing`
* `symfony/http-foundation`

## Suggested packages

The following composer packages are suggested to help improving the development experience:

* `johnbillion/args`
* `htmlburger/carbon-fields`
* `tareq1988/wp-eloquent`
* `wptrt/admin-notices`
* `katzgrau/klogger`