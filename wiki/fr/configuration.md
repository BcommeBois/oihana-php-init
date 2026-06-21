# Configuration

`initConfig()` charge un fichier de configuration [TOML](https://toml.io/) et le
retourne sous forme de tableau PHP. Elle délègue l'analyse à
`oihana\files\toml\resolveTomlConfig()` tout en préservant un comportement
pratique : **un fichier de config absent produit une configuration vide** plutôt
qu'une erreur.

## Signature

```php
function initConfig(
    string    $basePath = '' ,
    string    $file     = 'config.toml' ,
    ?callable $init     = null
) : array
```

| Paramètre | Rôle |
|---|---|
| `$basePath` | Répertoire de base du fichier de configuration. |
| `$file` | Nom du fichier de config, avec ou sans l'extension `.toml` (défaut `config.toml`). |
| `$init` | `callable(array): array` optionnel pour post-traiter / initialiser la config chargée. |

Retourne la configuration sous forme de tableau (vide si le fichier n'existe pas).
Lève `Devium\Toml\TomlError` si le fichier existe mais ne peut pas être analysé.

## Utilisation

```php
use function oihana\init\initConfig;

// Charge <basePath>/config.toml
$config = initConfig( __DIR__ . '/config' );

// Nom de fichier personnalisé (extension optionnelle)
$config = initConfig( __DIR__ . '/config' , 'app.toml' );

// Post-traite la config chargée avec un callback
$config = initConfig( __DIR__ . '/config' , 'config.toml' , function( array $config ): array
{
    $config[ 'app' ][ 'timezone' ] ??= 'UTC' ;
    return $config ;
} );
```

Pour un `config.toml` tel que :

```toml
[app]
name     = "My App"
timezone = "Europe/Lisbon"
```

`initConfig()` retourne `[ 'app' => [ 'name' => 'My App', 'timezone' => 'Europe/Lisbon' ] ]`.

## Voir aussi

- [Conteneur & définitions](container.md) — injecter la configuration dans vos définitions DI.
- [Runtime](runtime.md) — appliquer des valeurs de config comme le fuseau horaire et la limite mémoire.
- Retour à l'[index de la documentation](README.md).
