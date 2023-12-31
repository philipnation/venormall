<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2bd709d2d9f76beb048129459e40d904
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'Orhanerday\\OpenAi\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Orhanerday\\OpenAi\\' => 
        array (
            0 => __DIR__ . '/..' . '/orhanerday/open-ai/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'UltraMsg\\WhatsAppApi' => __DIR__ . '/..' . '/ultramsg/whatsapp-php-sdk/ultramsg.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2bd709d2d9f76beb048129459e40d904::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2bd709d2d9f76beb048129459e40d904::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2bd709d2d9f76beb048129459e40d904::$classMap;

        }, null, ClassLoader::class);
    }
}
