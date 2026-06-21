# Runtime

Four functions configure the PHP runtime at boot. They all ultimately rely on
`setIniIfExists()`, which validates the `ini` key against the typed
`oihana\enums\IniOptions` constants — so there are **no *magic strings***.

## `setIniIfExists()`

```php
function setIniIfExists( string $key , array|string|int|float|bool|null $init = [] ) : bool
```

Sets a single `ini` directive, **only when a non-empty value exists**. If `$init`
is an array, the value is looked up at `$init[$key]`; otherwise `$init` is the
value itself. The value is cast to a string and trimmed; empty strings are
ignored. Returns `true` when `ini_set()` was actually called, `false` otherwise.
Throws `ConstantException` if `$key` is not a valid `IniOptions` directive.

```php
use function oihana\init\setIniIfExists;

// From a config array (looked up by key)
$config = [ 'display_errors' => '1', 'memory_limit' => '256M' ];
setIniIfExists( 'display_errors', $config );      // calls ini_set('display_errors', '1') → true
setIniIfExists( 'upload_max_filesize', $config ); // not present → false

// From a direct scalar
setIniIfExists( 'memory_limit', '512M' );  // → true
setIniIfExists( 'display_errors', "\t\n" ); // empty after trim → false
```

## `initDefaultTimezone()`

```php
function initDefaultTimezone( ?string $timezoneId , string $defaultTimezone = 'Europe/Paris' ) : void
```

Sets the global timezone (`date_default_timezone_set()`). When `$timezoneId` is
`null`, `$defaultTimezone` is applied — prefer passing `null` rather than an
empty string to trigger the fallback.

```php
use function oihana\init\initDefaultTimezone;

initDefaultTimezone( 'UTC' );
initDefaultTimezone( null, 'Europe/Paris' );          // fallback
initDefaultTimezone( $config['app']['timezone'] ?? null, 'UTC' );
```

## `initMemoryLimit()`

```php
function initMemoryLimit( ?string $memoryLimit , string $defaultMemoryLimit = '128M' ) : bool
```

Sets the `memory_limit` directive to `$memoryLimit`, or to `$defaultMemoryLimit`
when it is `null`. Returns the result of the underlying `setIniIfExists()` call.

```php
use function oihana\init\initMemoryLimit;

initMemoryLimit( '256M' ); // → true
initMemoryLimit( null );   // applies the default '128M'
```

## `initErrors()`

```php
function initErrors( ?array $init = null , ?string $logRootPath = null , int $defaultErrorLevel = E_ALL ) : void
```

Configures error handling from an `ini` settings array:

- sets `error_reporting()` to `$init['error_reporting']` (or `$defaultErrorLevel`);
- applies `display_errors` and `display_startup_errors` via `setIniIfExists()`;
- applies `error_log`, optionally prefixing a relative path with `$logRootPath`.

Throws `ConstantException` if one of the keys is not a valid `IniOptions` directive.

```php
use function oihana\init\initErrors;

initErrors(
    [
        'error_reporting' => E_ALL,
        'display_errors'  => '0',
        'error_log'       => 'var/log/php-errors.log',
    ],
    __DIR__, // root prepended to the relative error_log path
);
```

## See also

- [Configuration](configuration.md) — source these values from your config file.
- [Container & definitions](container.md).
- Back to the [Documentation index](README.md).
