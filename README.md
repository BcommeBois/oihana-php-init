# Oihana PHP - Init

![Oihana PHP Init](https://raw.githubusercontent.com/BcommeBois/oihana-php-init/main/assets/images/oihana-php-init-logo-inline-512x160.png)

Application bootstrap helpers for PHP 8.4+ — config loading, DI container building and PHP runtime setup.

[![Latest Version](https://img.shields.io/packagist/v/oihana/php-init.svg?style=flat-square)](https://packagist.org/packages/oihana/php-init)  
[![Total Downloads](https://img.shields.io/packagist/dt/oihana/php-init.svg?style=flat-square)](https://packagist.org/packages/oihana/php-init)  
[![License](https://img.shields.io/packagist/l/oihana/php-init.svg?style=flat-square)](LICENSE)

## 📚 Documentation

User guides (FR + EN), with narrative explanations and examples:

| 🇬🇧 **[English documentation](wiki/en/README.md)**                       | 🇫🇷 **[Documentation française](wiki/fr/README.md)**                     |
|--------------------------------------------------------------------------|--------------------------------------------------------------------------|
| Getting started, configuration, container & definitions, runtime, testing. | Démarrage, configuration, conteneur & définitions, runtime, tests. |

Auto-generated API reference (phpDocumentor):  
👉 https://bcommebois.github.io/oihana-php-init

## 🧠 What is it?

`oihana/php-init` is a small set of free functions that bootstrap a PHP
application: load and merge a TOML/array configuration, build a
[PHP-DI](https://php-di.org/) container from definition files, and configure the
PHP runtime (timezone, error reporting, memory limit, `ini` directives).

```php
use DI\Container;

use function oihana\init\initConfig;
use function oihana\init\initContainer;
use function oihana\init\initDefinitions;

// 1. Load configuration (config.toml under the given base path)
$config = initConfig( __DIR__ . '/config' );

// 2. Build a DI container from all PHP definition files in a directory
$definitions = initDefinitions( __DIR__ . '/definitions' );
$container    = initContainer( $definitions );
```

## 🚀 Features

- ⚙️ Config loading & merging (TOML + PHP arrays) — `initConfig()`.
- 📦 PHP-DI container building from definitions — `initContainer()`, `initDefinitions()`.
- 🕐 PHP runtime setup — `initDefaultTimezone()`, `initErrors()`, `initMemoryLimit()`, `setIniIfExists()`.
- 🧩 Plain free functions, autoloaded — no framework lock-in.
- 🧪 Full unit-test coverage ensuring reliability and maintainability.

💡 Designed to be lightweight, testable, and compatible with any PHP 8.4+ project.

## 📦 Installation

> **Requires [PHP 8.4+](https://php.net/releases/)**

Install via [Composer](https://getcomposer.org):
```bash
composer require oihana/php-init
```

## ✅ Tests & coverage

Run the full unit-test suite (PHPUnit, strict mode):
```bash
composer test
```

Run a single test case:
```bash
./vendor/bin/phpunit --filter InitContainerTest
```

Measure coverage (requires Xdebug or PCOV):
```bash
composer coverage        # text + Clover + HTML under build/coverage/
composer coverage:md     # readable Markdown summary (build/coverage/COVERAGE.md)
```

The suite runs in **strict mode** and targets **100% line coverage**.

## 🧾 License

This project is licensed under the [Mozilla Public License 2.0 (MPL-2.0)](https://www.mozilla.org/en-US/MPL/2.0/).

## 👤 About the author

* Author : Marc ALCARAZ (aka eKameleon)
* Mail : marc@ooop.fr
* Website : http://www.ooop.fr

## 🛠️ Generate the Documentation

We use [phpDocumentor](https://phpdoc.org/) to generate the documentation into the ./docs folder.

### Usage
Run the command : 
```bash
composer doc
```

## 🔗 Related packages

- [oihana/php-files](https://github.com/BcommeBois/oihana-php-files) – file, path and TOML config helpers used to load configuration.
- [oihana/php-enums](https://github.com/BcommeBois/oihana-php-enums) – strongly-typed constant enumerations (`IniOptions`, …).
- [oihana/php-reflect](https://github.com/BcommeBois/oihana-php-reflect) – reflection utilities and exception types.
