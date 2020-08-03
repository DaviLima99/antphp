<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit95d74d756ef62715c642933994352af5
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
            'Antcli\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Antcli\\' => 
        array (
            0 => __DIR__ . '/../..' . '/cli/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit95d74d756ef62715c642933994352af5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit95d74d756ef62715c642933994352af5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}