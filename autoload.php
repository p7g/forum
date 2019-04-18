<?php
namespace _autoload;

function autoloader(string $prefix, string $directory): \Closure {
    return function (string $classname) use ($prefix, $directory): void {
        $prefix_len = \strlen($prefix);

        if (\strncmp($classname, $prefix, $prefix_len) !== 0 ) {
            return;
        }

        $rest = \str_replace('\\', '/', \substr($classname, $prefix_len));

        $file = "$directory$rest.php";
        if (\file_exists($file)) {
            include $file;
        }
    };
}

\spl_autoload_register(autoloader('lib', __DIR__ . '/lib'));
\spl_autoload_register(autoloader('forum', __DIR__));

const FUNCTION_FILES = [
    'config',
    'db',
    'http',
    'import',
    'json',
    'view',
];

foreach (FUNCTION_FILES as $file) {
    require "lib/$file.php";
}
