# Conteneur & définitions

Deux fonctions coopèrent pour construire un conteneur [PHP-DI](https://php-di.org/) :
`initDefinitions()` collecte les tableaux de définitions depuis des fichiers PHP,
et `initContainer()` construit le conteneur à partir d'une ou plusieurs sources
de définitions.

## `initDefinitions()`

```php
function initDefinitions( string $basePath , bool $recursive = true ) : array
```

Scanne récursivement `$basePath` à la recherche de fichiers `.php`, fait un
`require` de chacun, et fusionne les tableaux retournés en un seul tableau de
définitions. Chaque fichier doit **retourner un tableau** de définitions PHP-DI.

| Paramètre | Rôle |
|---|---|
| `$basePath` | Répertoire racine contenant les fichiers de définitions `.php` (recherche récursive). |
| `$recursive` | `true` (défaut) fusionne les tableaux en profondeur : quand deux fichiers portent la même clé et que les deux valeurs sont des tableaux, ils sont fusionnés clé par clé. `false` fusionne à plat : la valeur du dernier fichier gagne, quel que soit son type. |

La fusion à plat est la bonne pour des définitions de conteneur : une clé est
une entrée, et la dernière définition d'une entrée remplace la précédente,
exactement comme PHP-DI le fait avec plusieurs sources. Elle est aussi bien
moins coûteuse sur un grand arbre de définitions, puisqu'une fusion profonde
recopie tout le tableau accumulé à chaque fichier.

Retourne le tableau de définitions fusionné. Lève `Exception` si un fichier ne
peut pas être lu/inclus ou si la fusion échoue.

```php
use function oihana\init\initDefinitions;

// Fusionne tous les fichiers de définitions *.php sous le dossier 'definitions'
$definitions = initDefinitions( __DIR__ . '/definitions' );

// La même chose, à plat : la dernière définition d'une entrée gagne
$definitions = initDefinitions( __DIR__ . '/definitions' , recursive : false );
```

Un fichier de définitions retourne simplement un tableau :

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

Crée un `ContainerBuilder`, ajoute chaque source de définitions fournie, et
retourne le `Container` construit. Chaque source peut être :

- une **chaîne** — un chemin vers un fichier de définitions PHP retournant un tableau ;
- un **tableau** — un tableau associatif de définitions ;
- un `DI\Definition\Source\DefinitionSource` — toute source de définitions PHP-DI.

Les sources ultérieures surchargent les entrées définies précédemment. Lève
`Exception` si la construction échoue.

```php
use DI\Container;

use function oihana\init\initContainer;
use function oihana\init\initDefinitions;

// À partir d'un tableau de définitions fusionné
$container = initContainer( initDefinitions( __DIR__ . '/definitions' ) );

// À partir de plusieurs sources (les dernières l'emportent)
$container = initContainer(
    __DIR__ . '/definitions/services.php',
    [ 'app.env' => 'prod' ],
);
```

## Voir aussi

- [Configuration](configuration.md) — charger la config que lisent vos définitions.
- [Runtime](runtime.md) — configurer le runtime PHP en parallèle du conteneur.
- Retour à l'[index de la documentation](README.md).
