# oihana/php-init — application bootstrap helpers for PHP

![Language](https://img.shields.io/badge/language-English-blue)

`oihana/php-init` is a PHP 8.4+ library providing a small set of **free functions** that bootstrap a PHP application: load and merge a TOML/array configuration, build a [PHP-DI](https://php-di.org/) container from definition files, and configure the PHP runtime (timezone, error reporting, memory limit, `ini` directives).

![Oihana PHP Init](https://raw.githubusercontent.com/BcommeBois/oihana-php-init/main/assets/images/oihana-php-init-logo-inline-512x160.png)

## Who this documentation is for

PHP developers who want to:

- load a **TOML** (or PHP-array) **configuration** with a sane empty-file fallback — `initConfig()`;
- build a **PHP-DI container** from one or many definition files — `initContainer()`, `initDefinitions()`;
- configure the **PHP runtime** at boot — timezone, errors, memory limit and arbitrary `ini` directives.

## Quick start

```php
use DI\Container;

use function oihana\init\initConfig;
use function oihana\init\initContainer;
use function oihana\init\initDefinitions;

$config = initConfig( __DIR__ . '/config' );          // loads config.toml
$definitions = initDefinitions( __DIR__ . '/definitions' ); // merges all *.php definition files
$container = initContainer( $definitions );            // builds the PHP-DI container
```

## Table of contents

### Getting started — [`getting-started/`](getting-started/)

- [Introduction](getting-started/introduction.md) — what the library does and the *oihana* philosophy.
- [Installation](getting-started/installation.md) — PHP 8.4+ requirement and `composer require`.
- [Dependencies](getting-started/dependencies.md) — the runtime packages and their role.

### Usage

- [Configuration](configuration.md) — `initConfig()`: TOML/array config loading and merging.
- [Container & definitions](container.md) — `initContainer()` and `initDefinitions()`.
- [Runtime](runtime.md) — `initDefaultTimezone()`, `initErrors()`, `initMemoryLimit()`, `setIniIfExists()`.

### Cross-cutting

- [Tests & coverage](testing.md) — run the PHPUnit suite and measure coverage.

## Source code

The library code lives under [`src/oihana/init/`](../../src/oihana/init/) — namespace `oihana\init`.

## See also

- [Packagist `oihana/php-init`](https://packagist.org/packages/oihana/php-init) — the package page.
- [API reference (phpDocumentor)](https://bcommebois.github.io/oihana-php-init) — function-level generated reference.
