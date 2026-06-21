# Introduction

`oihana/php-init` rassemble les briques de bootstrap applicatif qui vivaient auparavant dans `oihana/php-system`, extraites dans un paquet dédié afin qu'un projet puisse dépendre de la couche d'amorçage sans rien tirer d'autre.

Elle est volontairement minuscule : une poignée de fonctions libres que l'on appelle une fois, au démarrage, pour charger la configuration, construire un conteneur DI et configurer le runtime PHP.

## Ce qu'elle fournit

| Fonction | Rôle |
|---|---|
| `initConfig()` | Charge un fichier de configuration TOML (avec repli sur une config vide) et le post-traite éventuellement. |
| `initDefinitions()` | Charge récursivement et fusionne tous les fichiers de définitions PHP d'un dossier en un seul tableau. |
| `initContainer()` | Construit un conteneur [PHP-DI](https://php-di.org/) à partir d'une ou plusieurs sources de définitions. |
| `initDefaultTimezone()` | Définit le fuseau horaire par défaut, avec un repli si aucun n'est fourni. |
| `initErrors()` | Configure le rapport d'erreurs et les directives `ini` associées (affichage/journal). |
| `initMemoryLimit()` | Définit la directive `memory_limit`, avec une valeur par défaut. |
| `setIniIfExists()` | Définit une directive `ini` à partir d'un scalaire ou d'un tableau de config, uniquement si une valeur non vide existe. |

## La philosophie *oihana*

- **PHP 8.4+ uniquement** — aucun palliatif legacy.
- **De simples fonctions libres** — pas de classe de base, pas d'enfermement dans un framework ; appelez ce dont vous avez besoin.
- **Pas de *magic strings*** — les clés `ini` sont validées contre les constantes typées `oihana\enums\IniOptions`.
- **Testée** — 100 % de couverture de lignes, mode strict PHPUnit (voir [Tests & couverture](../testing.md)).

## Étapes suivantes

- [Installation](installation.md)
- [Dépendances](dependencies.md)
- [Configuration](../configuration.md)
