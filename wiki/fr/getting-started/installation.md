# Installation

## Prérequis

- **PHP 8.4 ou supérieur.**
- **[Composer](https://getcomposer.org/).**

La bibliothèque elle-même ne requiert aucune extension PHP particulière.

## Installation via Composer

```bash
composer require oihana/php-init
```

## Autochargement

Le paquet n'a **aucune classe** — il expose sept fonctions libres, toutes
câblées via `autoload.files` de composer :

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

Importez les fonctions directement :

```php
use function oihana\init\initConfig;
use function oihana\init\initContainer;
```

## Vérifier l'installation

```php
require 'vendor/autoload.php';

use function oihana\init\initMemoryLimit;

initMemoryLimit( '256M' );
var_dump( ini_get( 'memory_limit' ) ); // string(4) "256M"
```

## Étapes suivantes

- [Dépendances](dependencies.md)
- [Configuration](../configuration.md)
