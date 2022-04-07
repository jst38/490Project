<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdeb8a0be6932d3da81f60cb6c3b7b1e5
{
    public static $files = array (
        'decc78cc4436b1292c6c0d151b19445c' => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpseclib3\\' => 11,
        ),
        'P' => 
        array (
            'PhpAmqpLib\\' => 11,
            'ParagonIE\\ConstantTime\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpseclib3\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib',
        ),
        'PhpAmqpLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-amqplib/php-amqplib/PhpAmqpLib',
        ),
        'ParagonIE\\ConstantTime\\' => 
        array (
            0 => __DIR__ . '/..' . '/paragonie/constant_time_encoding/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdeb8a0be6932d3da81f60cb6c3b7b1e5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdeb8a0be6932d3da81f60cb6c3b7b1e5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdeb8a0be6932d3da81f60cb6c3b7b1e5::$classMap;

        }, null, ClassLoader::class);
    }
}
