<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit39b70fd8db687602170dc784ff702283
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        'eee1afd8f38c52a8d46f7c5bbb92afdd' => __DIR__ . '/..' . '/deployer/deployer/src/Support/helpers.php',
        '135133ad0ca20ef21cc262b30da9a000' => __DIR__ . '/..' . '/deployer/deployer/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Process\\' => 26,
            'Symfony\\Component\\Console\\' => 26,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'D' => 
        array (
            'Deployer\\Component\\Version\\' => 27,
            'Deployer\\Component\\PharUpdate\\' => 30,
            'Deployer\\Component\\PHPUnit\\' => 27,
            'Deployer\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Deployer\\Component\\Version\\' => 
        array (
            0 => __DIR__ . '/..' . '/deployer/phar-update/src/Version',
        ),
        'Deployer\\Component\\PharUpdate\\' => 
        array (
            0 => __DIR__ . '/..' . '/deployer/phar-update/src',
        ),
        'Deployer\\Component\\PHPUnit\\' => 
        array (
            0 => __DIR__ . '/..' . '/deployer/phar-update/src/PHPUnit',
        ),
        'Deployer\\' => 
        array (
            0 => __DIR__ . '/..' . '/deployer/deployer/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit39b70fd8db687602170dc784ff702283::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit39b70fd8db687602170dc784ff702283::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit39b70fd8db687602170dc784ff702283::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
