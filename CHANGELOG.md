# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-06-21

First release. The `oihana\init` namespace is extracted from
`oihana/php-system` into its own focused application-bootstrap package for
PHP 8.4+.

### Added
- Project scaffolding: `composer.json`, `phpunit.xml`, `phpdoc.xml`,
  CI and Docs GitHub workflows, coverage tooling, phpDocumentor template,
  README, CONTRIBUTING and license.
- Brand assets (logos) under `assets/images/`.
- The `oihana\init` library, imported from `oihana/php-system`
  (identical FQNs) — seven free functions wired via composer `autoload.files`:
  - `initConfig()` — load a TOML configuration (empty-config fallback) with an
    optional post-processing callback.
  - `initDefinitions()` — recursively load and merge PHP definition files.
  - `initContainer()` — build a PHP-DI container from one or more definition
    sources.
  - `initDefaultTimezone()` — set the default timezone with a fallback.
  - `initErrors()` — configure error reporting and the related `ini` directives.
  - `initMemoryLimit()` — set the `memory_limit` directive with a default.
  - `setIniIfExists()` — set an `ini` directive from a scalar or config array,
    validating the key against `oihana\enums\IniOptions`.
- Unit-test suite imported from `oihana/php-system` (PHPUnit, strict mode).
  **100% line coverage** (31/31 lines), 19 tests.
- Bilingual user guide under `wiki/` (English + French): getting started
  (introduction, installation, dependencies), configuration, container &
  definitions, runtime and a testing guide.
