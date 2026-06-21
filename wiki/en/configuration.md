# Configuration

`initConfig()` loads a [TOML](https://toml.io/) configuration file and returns it
as a PHP array. It delegates the actual parsing to
`oihana\files\toml\resolveTomlConfig()` while preserving a convenient behaviour:
**a missing config file yields an empty configuration** rather than an error.

## Signature

```php
function initConfig(
    string    $basePath = '' ,
    string    $file     = 'config.toml' ,
    ?callable $init     = null
) : array
```

| Parameter | Role |
|---|---|
| `$basePath` | Base directory of the configuration file. |
| `$file` | Config file name, with or without the `.toml` extension (default `config.toml`). |
| `$init` | Optional `callable(array): array` to post-process / initialize the loaded config. |

Returns the configuration as an array (empty when the file does not exist).
Throws `Devium\Toml\TomlError` when the file exists but cannot be parsed.

## Usage

```php
use function oihana\init\initConfig;

// Load <basePath>/config.toml
$config = initConfig( __DIR__ . '/config' );

// Custom file name (extension optional)
$config = initConfig( __DIR__ . '/config' , 'app.toml' );

// Post-process the loaded config with a callback
$config = initConfig( __DIR__ . '/config' , 'config.toml' , function( array $config ): array
{
    $config[ 'app' ][ 'timezone' ] ??= 'UTC' ;
    return $config ;
} );
```

Given a `config.toml` such as:

```toml
[app]
name     = "My App"
timezone = "Europe/Lisbon"
```

`initConfig()` returns `[ 'app' => [ 'name' => 'My App', 'timezone' => 'Europe/Lisbon' ] ]`.

## See also

- [Container & definitions](container.md) — feed the configuration into your DI definitions.
- [Runtime](runtime.md) — apply config values such as timezone and memory limit.
- Back to the [Documentation index](README.md).
