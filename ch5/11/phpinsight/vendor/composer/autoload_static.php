<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita61d03f9932c0c51c4ede30cbf0a487f
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPInsight' => 
            array (
                0 => __DIR__ . '/..' . '/jwhennessey/phpinsight/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInita61d03f9932c0c51c4ede30cbf0a487f::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}