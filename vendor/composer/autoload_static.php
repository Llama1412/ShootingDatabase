<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit114dcb825c72eeab64d19220b6c07a82
{
    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit114dcb825c72eeab64d19220b6c07a82::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
