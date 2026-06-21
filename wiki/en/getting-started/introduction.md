# Introduction

`oihana/php-init` gathers the application-bootstrap building blocks that used to live inside `oihana/php-system`, extracted into a focused package so a project can depend on the bootstrap layer without pulling anything else.

It is intentionally tiny: a handful of free functions you call once, at boot, to load configuration, build a DI container and configure the PHP runtime.

## What it provides

| Function | Role |
|---|---|
| `initConfig()` | Load a TOML configuration file (with an empty-config fallback) and optionally post-process it. |
| `initDefinitions()` | Recursively load and merge all PHP definition files under a directory into a single array. |
| `initContainer()` | Build a [PHP-DI](https://php-di.org/) container from one or more definition sources. |
| `initDefaultTimezone()` | Set the default timezone, with a fallback when none is provided. |
| `initErrors()` | Configure error reporting and the related `ini` directives (display/log). |
| `initMemoryLimit()` | Set the `memory_limit` directive, with a default. |
| `setIniIfExists()` | Set a single `ini` directive from a scalar or a config array, only when a non-empty value exists. |

## The *oihana* philosophy

- **PHP 8.4+ only** — no legacy shims.
- **Plain free functions** — no base class, no framework lock-in; call what you need.
- **No *magic strings*** — `ini` keys are validated against the typed `oihana\enums\IniOptions` constants.
- **Tested** — 100% line coverage, strict PHPUnit mode (see [Tests & coverage](../testing.md)).

## Next steps

- [Installation](installation.md)
- [Dependencies](dependencies.md)
- [Configuration](../configuration.md)
