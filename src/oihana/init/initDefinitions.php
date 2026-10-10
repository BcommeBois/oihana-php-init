<?php

namespace oihana\init;

use Exception ;

use oihana\files\enums\RecursiveFilePathsOption;
use function oihana\files\recursiveFilePaths;
use function oihana\files\requireAndMergeArrays;

/**
 * Initialize all DI container definitions by loading and merging PHP definition files.
 *
 * This function scans $basePath recursively for .php files, requires each file,
 * and merges the resulting arrays into a single definitions array. It is intended
 * to assemble service definitions for a DI container.
 *
 * Behavior:
 * - Only files with the "php" extension are considered.
 * - Files are discovered recursively in subdirectories.
 * - Each file must return an array; non-array returns may cause merge issues or exceptions in requireAndMergeArrays.
 * - The arrays are merged deeply by default : when two files carry the same key and both values
 *   are arrays, the arrays are merged key by key, recursively. With `$recursive` set to `false`,
 *   the merge is flat : the value of the last file wins, whatever its type. A flat merge is the
 *   right one for container definitions, where a key is an entry and the last definition of an
 *   entry replaces the previous one, as PHP-DI itself does with several sources ; it is also far
 *   cheaper, since a deep merge copies the whole accumulated array at every file.
 *
 * @param string $basePath  Absolute or relative path to the root directory containing definition files.
 * @param bool   $recursive Merge the arrays deeply (default) ; `false` merges them flat, the last value of a key wins.
 * @return array Merged definitions array.
 * @throws Exception If a required file cannot be read/included or merging fails.
 *
 * @see recursiveFilePaths()
 * @see requireAndMergeArrays()
 * @see initContainer()
 *
 * @example
 * ```php
 * use DI\ContainerBuilder;
 * use function oihana\init\initDefinitions;
 *
 * // Load all container definitions from the 'definitions' directory
 * $definitions = initDefinitions(__DIR__ . '/../../definitions');
 *
 * // The same, merged flat : the last definition of an entry wins, and nothing is merged deeply
 * $definitions = initDefinitions(__DIR__ . '/../../definitions', recursive: false);
 *
 * // Example: pass the definitions to your container builder
 * $containerBuilder = new ContainerBuilder() ;
 *
 * $containerBuilder->addDefinitions( $definitions ) ;
 *
 * $containerBuilder->build() ;
 * ```
 */
function initDefinitions( string $basePath , bool $recursive = true ) : array
{
    return requireAndMergeArrays
    (
        filePaths   : recursiveFilePaths( $basePath , [ RecursiveFilePathsOption::EXTENSIONS => [ 'php' ] ] ) ,
        recursive   : $recursive ,
        allowedBase : $basePath
    ) ;
};