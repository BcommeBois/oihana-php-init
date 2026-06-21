# Dépendances

`oihana/php-init` conserve une empreinte runtime minimale. Voici ce qu'elle
requiert et **pourquoi**.

## Dépendances runtime

| Paquet | Rôle |
|---|---|
| [`oihana/php-files`](https://github.com/BcommeBois/oihana-php-files) | Helpers fichiers, chemins et config TOML — `recursiveFilePaths()`, `requireAndMergeArrays()`, `toml\resolveTomlConfig()`. |
| [`oihana/php-enums`](https://github.com/BcommeBois/oihana-php-enums) | Constantes typées — `Char` et les clés `IniOptions` validées par `setIniIfExists()`. |
| [`oihana/php-reflect`](https://github.com/BcommeBois/oihana-php-reflect) | Utilitaires de réflexion et l'exception `ConstantException` levée sur une clé `ini` invalide. |
| [`php-di/php-di`](https://packagist.org/packages/php-di/php-di) | Le conteneur PSR-11 construit par `initContainer()`. |
| [`devium/toml`](https://packagist.org/packages/devium/toml) | Le parseur TOML derrière `initConfig()`. |

## Dépendances de développement

| Paquet | Rôle |
|---|---|
| `phpunit/phpunit` | Lanceur de tests (mode strict). |
| `nunomaduro/collision` | Sortie d'erreurs CLI lisible. |
| `phpdocumentor/shim` | Génération de la documentation API. |

## Étapes suivantes

- [Configuration](../configuration.md)
- [Conteneur & définitions](../container.md)
