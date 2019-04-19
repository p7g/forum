<?php
require getcwd() . '/autoload.php';

use function lib\test\test;
use lib\iter;

test('iter\collect', function ($test) {
    function gen() {
        yield 1;
        yield 2;
        yield 3;
    }

    $test->assert_strict_equal(
        iter\collect(gen()),
        [1, 2, 3],
        'Collected generator equals equivalent array literal',
    );
});

test('yahooooo', function () {});

test('should fail', function ($test) {
    $test->assert(false, 'whoops');
});
