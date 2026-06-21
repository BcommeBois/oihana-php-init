# Runtime

Quatre fonctions configurent le runtime PHP au démarrage. Elles s'appuient
toutes au final sur `setIniIfExists()`, qui valide la clé `ini` contre les
constantes typées `oihana\enums\IniOptions` — donc **aucun *magic string***.

## `setIniIfExists()`

```php
function setIniIfExists( string $key , array|string|int|float|bool|null $init = [] ) : bool
```

Définit une seule directive `ini`, **uniquement si une valeur non vide existe**.
Si `$init` est un tableau, la valeur est recherchée à `$init[$key]` ; sinon
`$init` est la valeur elle-même. La valeur est convertie en chaîne et nettoyée
(`trim`) ; les chaînes vides sont ignorées. Retourne `true` quand `ini_set()` a
réellement été appelé, `false` sinon. Lève `ConstantException` si `$key` n'est
pas une directive `IniOptions` valide.

```php
use function oihana\init\setIniIfExists;

// Depuis un tableau de config (recherche par clé)
$config = [ 'display_errors' => '1', 'memory_limit' => '256M' ];
setIniIfExists( 'display_errors', $config );      // appelle ini_set('display_errors', '1') → true
setIniIfExists( 'upload_max_filesize', $config ); // absent → false

// Depuis un scalaire direct
setIniIfExists( 'memory_limit', '512M' );  // → true
setIniIfExists( 'display_errors', "\t\n" ); // vide après trim → false
```

## `initDefaultTimezone()`

```php
function initDefaultTimezone( ?string $timezoneId , string $defaultTimezone = 'Europe/Paris' ) : void
```

Définit le fuseau horaire global (`date_default_timezone_set()`). Quand
`$timezoneId` vaut `null`, `$defaultTimezone` est appliqué — préférez passer
`null` plutôt qu'une chaîne vide pour déclencher le repli.

```php
use function oihana\init\initDefaultTimezone;

initDefaultTimezone( 'UTC' );
initDefaultTimezone( null, 'Europe/Paris' );          // repli
initDefaultTimezone( $config['app']['timezone'] ?? null, 'UTC' );
```

## `initMemoryLimit()`

```php
function initMemoryLimit( ?string $memoryLimit , string $defaultMemoryLimit = '128M' ) : bool
```

Définit la directive `memory_limit` à `$memoryLimit`, ou à `$defaultMemoryLimit`
lorsqu'elle vaut `null`. Retourne le résultat de l'appel sous-jacent à
`setIniIfExists()`.

```php
use function oihana\init\initMemoryLimit;

initMemoryLimit( '256M' ); // → true
initMemoryLimit( null );   // applique le défaut '128M'
```

## `initErrors()`

```php
function initErrors( ?array $init = null , ?string $logRootPath = null , int $defaultErrorLevel = E_ALL ) : void
```

Configure la gestion des erreurs à partir d'un tableau de réglages `ini` :

- définit `error_reporting()` à `$init['error_reporting']` (ou `$defaultErrorLevel`) ;
- applique `display_errors` et `display_startup_errors` via `setIniIfExists()` ;
- applique `error_log`, en préfixant éventuellement un chemin relatif par `$logRootPath`.

Lève `ConstantException` si l'une des clés n'est pas une directive `IniOptions` valide.

```php
use function oihana\init\initErrors;

initErrors(
    [
        'error_reporting' => E_ALL,
        'display_errors'  => '0',
        'error_log'       => 'var/log/php-errors.log',
    ],
    __DIR__, // racine ajoutée au chemin error_log relatif
);
```

## Voir aussi

- [Configuration](configuration.md) — alimenter ces valeurs depuis votre fichier de config.
- [Conteneur & définitions](container.md).
- Retour à l'[index de la documentation](README.md).
