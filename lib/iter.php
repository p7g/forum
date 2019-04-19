<?php
namespace lib\iter;

/**
 * Collect an iterable (like a Generator) into an array.
 *
 * @param iterable $iter The iterable to collect
 * @return array
 */
function collect(iterable $iter): array {
    $collected = [];

    foreach ($iter as $k => $v) {
        $collected[$k] = $v;
    }

    return $collected;
}

/**
 * Map a function over a Generator without evaluating the whole thing.
 *
 * @param iterable $iter The iterable or generator to map over
 * @param callable $fn The callable to apply to each value. This function
 * receives the current value, followed by the current key
 * @return iterable A Generator that yields the result of the map function
 */
function map(iterable $iter, callable $fn): iterable {
    foreach ($iter as $k => $v) {
        yield $k => $fn($v, $k);
    }
}

/**
 * Lazily filter a Generator or other iterable
 *
 * @param iterable $iter The iterable to filter
 * @param callable $pred The predicate to determine if a value is kept. This
 * function receives the current value, followed by the current key
 * @return iterable A Generator containing only the values for which the
 * predicate returned true(ish)
 */
function filter(iterable $iter, callable $pred): iterable {
    foreach ($iter as $k => $v) {
        if ($pred($v, $k)) {
            yield $k => $v;
        }
    }
}

/**
 * Reduce an iterable into a single value, with an optional default value.
 *
 * @param iterable $iter The iterable to reduce
 * @param callable $fn The reducer function, which receives the accumulator,
 * the current value, and the current key
 * @param mixed $init An optional initial value. If not given (or null is
 * given), the first value in the iterable will be used as initial value.
 */
function reduce(iterable $iter, callable $fn, $init = null) {
    $first = true;
    foreach ($iter as $k => $v) {
        if ($first) {
            $first = false;
            if ($init === null) {
                $init = $v;
                continue;
            }
        }

        $init = $fn($init, $v, $k);
    }
    return $init;
}
