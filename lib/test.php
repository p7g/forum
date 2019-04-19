<?php
namespace lib\test;

use lib\console;

$tests = [];

function test(string $description, callable $case): void {
    global $tests;
    $tests[] = [$description, $case];
}

function run_tests(bool $continue_on_fail = false): bool {
    global $tests;
    $passed_all = true;
    foreach ($tests as $test) {
        try {
            echo "{$test[0]}: ";
            $test[1](new TestHelper());

            console\with_colour(
                console\COLOUR_GREEN,
                'OK' . PHP_EOL,
            );
        } catch (\AssertionError $e) {
            $passed_all = false;

            console\with_colour(
                console\COLOUR_RED,
                'Failed' . PHP_EOL . PHP_EOL,
            );

            echo $e->__toString(), PHP_EOL;

            if (!$continue_on_fail) {
                break;
            }
        }
    }
    if (!$passed_all) {
        echo PHP_EOL, 'Some tests failed', PHP_EOL;
    }

    return $passed_all;
}

// if this file is being run directly
if (isset($argv[0]) && \realpath($argv[0]) === __FILE__) {
    $options = \getopt('', ['silent', 'continue-on-fail'], $argindex);
    $args = \array_slice($argv, $argindex);

    $silent = isset($options['silent']);
    $continue_on_fail = isset($options['continue-on-fail']);

    if ($silent) {
        \ob_start();
    }

    // expand glob patterns
    $queue = \array_reduce($args, function ($acc, $arg) {
        return \array_merge($acc, \glob($arg, \GLOB_BRACE));
    }, []);

    // recursively find files
    $files = [];
    while ($arg = \array_shift($queue)) {
        $path = \realpath($arg);
        if (\is_dir($path)) {
            foreach (\scandir($path) as $child) {
                if ($child === '..' || $child === '.') {
                    continue;
                }
                $queue[] = "$arg/$child";
            }
            continue;
        }
        if ($path === false) {
            echo "Invalid path: $arg", PHP_EOL;
        }
        $files[] = $path;
    }

    // enable assertions and assertion errors
    \ini_set('zend.assertions', 1);
    \ini_set('assert.exception', 1);
    \assert_options(\ASSERT_ACTIVE, true);
    \assert_options(\ASSERT_BAIL, false);
    \assert_options(\ASSERT_WARNING, false);

    // require all the files
    foreach ($files as $file) {
        require $file;
    }

    $result = run_tests($continue_on_fail);

    if ($silent) {
        \ob_clean();
    }

    exit((int) !$result);
}
