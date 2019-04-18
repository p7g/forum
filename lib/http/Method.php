<?php
namespace lib\http;

final class Method {
    private static $instances = [];

    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';
    public const HEAD = 'HEAD';
    public const OPTIONS = 'OPTIONS';

    private $value;

    private function __construct(string $value) {
        $this->value = $value;
    }

    public static function __callStatic(string $name, array $args): self {
        $class = self::class;

        if (!\defined("$class::$name")) {
            throw new \InvalidArgumentException("No Method $name found");
        }

        if (isset(self::$instances[$name])) {
            return self::$instances[$name];
        }

        $instance = new $class($name);
        self::$instances[$name] = $instance;
        return $instance;
    }

    public static function from_value(string $value): self {
        if (isset(self::$instances[$value])) {
            return self::$instances[$value];
        }

        switch ($value) {
        case self::GET:
            $instance = self::GET();
            break;
        case self::POST:
            $instance = self::POST();
            break;
        case self::PUT:
            $instance = self::PUT();
            break;
        case self::PATCH:
            $instance = self::PATCH();
            break;
        case self::DELETE:
            $instance = self::DELETE();
            break;
        case self::HEAD:
            $instance = self::HEAD();
            break;
        case self::OPTIONS:
            $instance = self::OPTIONS();
            break;
        default:
            throw new \InvalidArgumentException(
                "No constant found with value $value");
        }

        self::$instances[$value] = $instance;
        return $instance;
    }
}
