<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit31e4eef74dddc1fa33584b747ab5f794
{
    public static $prefixLengthsPsr4 = array (
        'x' => 
        array (
            'xingkong\\composertest\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'xingkong\\composertest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit31e4eef74dddc1fa33584b747ab5f794::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit31e4eef74dddc1fa33584b747ab5f794::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit31e4eef74dddc1fa33584b747ab5f794::$classMap;

        }, null, ClassLoader::class);
    }
}
