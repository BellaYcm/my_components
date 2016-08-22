<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit433381a8433ba1800b07ca1ab66cfdcc
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Routing\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Routing\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/routing',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Symfony\\Component\\HttpFoundation' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/http-foundation',
            ),
            'Symfony\\Component\\ClassLoader' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/class-loader',
            ),
            'SessionHandlerInterface' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit433381a8433ba1800b07ca1ab66cfdcc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit433381a8433ba1800b07ca1ab66cfdcc::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit433381a8433ba1800b07ca1ab66cfdcc::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}