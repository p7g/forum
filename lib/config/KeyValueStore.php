<?php
namespace lib\config;

use lib\json;

/**
 * A class for storing key-value pairs with checked lookups.
 */
class KeyValueStore {
    /** @var array */
    protected $config = [];

    /**
     * Populate the config array from a JSON file
     *
     * @param string $filename The name of the file to load
     * @return void
     */
    public static function from_json(string $filename) {
        return new static(json\parse_file($filename, true));
    }

    /**
     * Create a new key value store with the given initial contents
     *
     * @param array $initial The initial contents of the key value store
     */
    public function __construct(array $initial = []) {
        $this->config = $initial;
    }

    /**
     * Get entire inner array
     *
     * @return array An associative array
     */
    public function all(): array {
        return $this->config;
    }

    /**
     * Check if the configuration has a value at the specified key.
     *
     * @param string $key The key to check
     * @return bool True if the key exists
     */
    public function has(string $key): bool {
        return isset($this->config[$key]);
    }

    /**
     * Set the value of a configuration field
     *
     * @param string $key The key to set the value of
     * @param mixed $value The value to assign to the given key
     * @return $this
     */
    public function set(string $key, $value): self {
        $this->config[$key] = $value;
    }

    /**
     * Delete a field from the configuration
     *
     * @param string $key The key to delete from the configuration
     * @return $this
     */
    public function delete(string $key): self {
        unset($this->config[$key]);
    }

    /**
     * Get a value from the internal config array without checking if it exists
     *
     * @param string $key The key to get
     * @return mixed The value at the specified key
     */
    public function get_unchecked(string $key) {
        return $this->config[$key];
    }

    /**
     * Get a value from the configuration, throwing an Error if it is not set
     *
     * @param string $key The key to get
     * @return mixed The value at that key
     */
    public function get(string $key) {
        if (!$this->has($key))
            throw new \Error("No value for key $key found");
        return $this->get_unchecked($key);
    }

    /**
     * Get a value at the given key, returning the given default if the key is
     * not set.
     *
     * @param string $key The key to get
     * @param mixed $default The value to return if the key is not set
     * @return mixed
     */
    public function get_or(string $key, $default) {
        if (!$this->has($key))
            return $default;
        return $this->get_unchecked($key);
    }

    /**
     * Get a value at the given key, returning the result of the given callable
     * if the value does not exist
     *
     * @param string $key The key to get
     * @param callable $else The callable to invoke when the key is not found
     * @return mixed
     */
    public function get_or_else(string $key, callable $else) {
        if (!$this->has($key))
            return $else();
        return $this->get_unchecked($key);
    }
}
