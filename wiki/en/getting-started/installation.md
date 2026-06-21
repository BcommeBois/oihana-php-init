# Installation

## Requirements

- **PHP 8.4 or higher.**
- **[Composer](https://getcomposer.org/).**

The library itself requires no special PHP extension.

## Install via Composer

```bash
composer require oihana/php-init
```

## Autoloading

The package has **no classes** — it exposes seven free functions, all wired via
composer `autoload.files`:

```json
{
    "autoload": {
        "psr-4": {
            "oihana\\init\\": "src/oihana/init"
        },
        "files": [
            "src/oihana/init/initConfig.php",
            "src/oihana/init/initContainer.php",
            "src/oihana/init/initDefaultTimezone.php",
            "src/oihana/init/initDefinitions.php",
            "src/oihana/init/initErrors.php",
            "src/oihana/init/initMemoryLimit.php",
            "src/oihana/init/setIniIfExists.php"
        ]
    }
}
```

Import the functions directly:

```php
use function oihana\init\initConfig;
use function oihana\init\initContainer;
```

## Verify the installation

```php
require 'vendor/autoload.php';

use function oihana\init\initMemoryLimit;

initMemoryLimit( '256M' );
var_dump( ini_get( 'memory_limit' ) ); // string(4) "256M"
```

## Next steps

- [Dependencies](dependencies.md)
- [Configuration](../configuration.md)
