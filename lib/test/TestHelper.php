<?php
namespace lib\test;

class TestHelper {
    public static function assert(bool $cond, string $description): void {
        \assert($cond, $description);
    }

    public static function assert_equal($a, $b, string $description): void {
        static::assert($a == $b, $description);
    }

    public static function assert_strict_equal($a, $b, string $desc): void {
        static::assert($a === $b, $desc);
    }

    public function __call(string $name, array $args) {
        return static::{$name}(...$args);
    }
}
