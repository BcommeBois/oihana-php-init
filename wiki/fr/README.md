# oihana/php-init — helpers de bootstrap applicatif pour PHP

![Langue](https://img.shields.io/badge/langue-Français-blue)

`oihana/php-init` est une bibliothèque PHP 8.4+ qui fournit un petit ensemble de **fonctions libres** pour amorcer une application PHP : charger et fusionner une configuration TOML/tableau, construire un conteneur [PHP-DI](https://php-di.org/) à partir de fichiers de définitions, et configurer le runtime PHP (fuseau horaire, rapport d'erreurs, limite mémoire, directives `ini`).

![Oihana PHP Init](https://raw.githubusercontent.com/BcommeBois/oihana-php-init/main/assets/images/oihana-php-init-logo-inline-512x160.png)

## À qui s'adresse cette documentation

Aux développeurs PHP qui souhaitent :

- charger une **configuration TOML** (ou tableau PHP) avec un repli propre si le fichier est absent — `initConfig()` ;
- construire un **conteneur PHP-DI** à partir d'un ou plusieurs fichiers de définitions — `initContainer()`, `initDefinitions()` ;
- configurer le **runtime PHP** au démarrage — fuseau horaire, erreurs, limite mémoire et directives `ini` arbitraires.

## Démarrage rapide

```php
use DI\Container;

use function oihana\init\initConfig;
use function oihana\init\initContainer;
use function oihana\init\initDefinitions;

$config = initConfig( __DIR__ . '/config' );          // charge config.toml
$definitions = initDefinitions( __DIR__ . '/definitions' ); // fusionne tous les fichiers *.php de définitions
$container = initContainer( $definitions );            // construit le conteneur PHP-DI
```

## Table des matières

### Démarrage — [`getting-started/`](getting-started/)

- [Introduction](getting-started/introduction.md) — ce que fait la bibliothèque et la philosophie *oihana*.
- [Installation](getting-started/installation.md) — prérequis PHP 8.4+ et `composer require`.
- [Dépendances](getting-started/dependencies.md) — les paquets runtime et leur rôle.

### Utilisation

- [Configuration](configuration.md) — `initConfig()` : chargement et fusion de config TOML/tableau.
- [Conteneur & définitions](container.md) — `initContainer()` et `initDefinitions()`.
- [Runtime](runtime.md) — `initDefaultTimezone()`, `initErrors()`, `initMemoryLimit()`, `setIniIfExists()`.

### Transverse

- [Tests & couverture](testing.md) — lancer la suite PHPUnit et mesurer la couverture.

## Code source

Le code de la bibliothèque se trouve sous [`src/oihana/init/`](../../src/oihana/init/) — namespace `oihana\init`.

## Voir aussi

- [Packagist `oihana/php-init`](https://packagist.org/packages/oihana/php-init) — la page du paquet.
- [Référence API (phpDocumentor)](https://bcommebois.github.io/oihana-php-init) — référence générée au niveau des fonctions.
