# Container & definitions

Two functions cooperate to build a [PHP-DI](https://php-di.org/) container:
`initDefinitions()` collects definition arrays from PHP files, and
`initContainer()` builds the container from one or more definition sources.

## `initDefinitions()`

```php
function initDefinitions( string $basePath ) : array
```

Recursively scans `$basePath` for `.php` files, `require`s each one, and merges
the returned arrays into a single definitions array. Each file must **return an
array** of PHP-DI definitions.

| Parameter | Role |
|---|---|
| `$basePath` | Root directory containing the `.php` definition files (searched recursively). |

Returns the merged definitions array. Throws `Exception` if a file cannot be
read/included or if merging fails.

```php
use function oihana\init\initDefinitions;

// Merge every *.php definition file under the 'definitions' directory
$definitions = initDefinitions( __DIR__ . '/definitions' );
```

A definition file simply returns an array:

```php
// definitions/services.php
use Psr\Log\LoggerInterface;
use function DI\create;

return [
    LoggerInterface::class => create( MyLogger::class ),
];
```

## `initContainer()`

```php
function initContainer( string|array|DefinitionSource ...$definitions ) : Container
```

Creates a `ContainerBuilder`, adds every provided definition source, and returns
the built `Container`. Each source may be:

- a **string** — a path to a PHP definition file returning an array;
- an **array** — an associative array of definitions;
- a `DI\Definition\Source\DefinitionSource` — any PHP-DI definition source.

Later sources override entries defined earlier. Throws `Exception` if the build
fails.

```php
use DI\Container;

use function oihana\init\initContainer;
use function oihana\init\initDefinitions;

// From a merged definitions array
$container = initContainer( initDefinitions( __DIR__ . '/definitions' ) );

// From several sources (later ones win)
$container = initContainer(
    __DIR__ . '/definitions/services.php',
    [ 'app.env' => 'prod' ],
);
```

## See also

- [Configuration](configuration.md) — load the config your definitions read from.
- [Runtime](runtime.md) — configure the PHP runtime alongside the container.
- Back to the [Documentation index](README.md).
