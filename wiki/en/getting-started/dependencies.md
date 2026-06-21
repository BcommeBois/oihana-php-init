# Dependencies

`oihana/php-init` keeps a minimal runtime footprint. Here is what it requires
and **why**.

## Runtime dependencies

| Package | Role |
|---|---|
| [`oihana/php-files`](https://github.com/BcommeBois/oihana-php-files) | File, path and TOML config helpers — `recursiveFilePaths()`, `requireAndMergeArrays()`, `toml\resolveTomlConfig()`. |
| [`oihana/php-enums`](https://github.com/BcommeBois/oihana-php-enums) | Typed constants — `Char` and the `IniOptions` keys validated by `setIniIfExists()`. |
| [`oihana/php-reflect`](https://github.com/BcommeBois/oihana-php-reflect) | Reflection utilities and the `ConstantException` raised on an invalid `ini` key. |
| [`php-di/php-di`](https://packagist.org/packages/php-di/php-di) | The PSR-11 container built by `initContainer()`. |
| [`devium/toml`](https://packagist.org/packages/devium/toml) | The TOML parser behind `initConfig()`. |

## Development dependencies

| Package | Role |
|---|---|
| `phpunit/phpunit` | Test runner (strict mode). |
| `nunomaduro/collision` | Readable CLI error output. |
| `phpdocumentor/shim` | API documentation generation. |

## Next steps

- [Configuration](../configuration.md)
- [Container & definitions](../container.md)
