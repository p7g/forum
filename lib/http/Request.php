<?php
namespace lib\http;

/**
 * A class containing all details of the current request
 */
class Request {
    /** @var string[] */
    private $headers = [];
    /** @var mixed */
    private $body = null;
    /** @var string[] */
    private $query = [];

    /**
     * Get all request headers
     *
     * @return string[]
     */
    public function get_headers(): array {
        return $this->headers;
    }

    /**
     * Get a specific request header
     *
     * @param string $name The name of the header to get, case insensitive
     * @return string The value of the header
     */
    public function get_header(string $name): string {
        $lower = \mb_strtolower($name);
        if (!isset($this->headers[$lower])) {
            throw new \Error("Header $name is not set");
        }
        return $this->headers[$lower];
    }

    /**
     * Replace all request headers
     *
     * @param string[] $headers An associative array of headers
     * @return $this
     */
    public function set_headers(array $headers): self {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Set the value of one header.
     *
     * @param string $name The case-insensitive name of the header to set
     * @param string $value The value to set the header to
     * @return $this
     */
    public function set_header(string $name, string $value): self {
        $this->headers[\mb_strtolower($name)] = $value;
        return $this;
    }

    /**
     * Get the request body stream
     *
     * @return mixed
     */
    public function get_body() {
        return $this->body;
    }

    /**
     * Set the body of the request
     *
     * @param mixed $body The new body stream
     * @return $this
     */
    public function set_body($body): self {
        $this->body = $body;
        return $this;
    }

    /**
     * Get a value from the query string
     *
     * @param string $name The name of the query string value to get
     * @return string|null The value if it exists, otherwise null
     */
    public function get_query(string $name): ?string {
        return $this->query[$name] ?? null;
    }

    /**
     * Get the whole query string as an array
     *
     * @return string[]
     */
    public function get_query_all(): array {
        return $this->query;
    }

    /**
     * Set a value of the query string
     *
     * @param string $name The name of the value to set
     * @param string $value The new value
     * @return $this
     */
    public function set_query(string $name, string $value): self {
        $this->query[$name] = $value;
        return $this;
    }

    /**
     * Set the entire query string array
     *
     * @param string[] $query The new query string array
     * @return $this
     */
    public function set_query_all(array $query): self {
        $this->query = $query;
        return $this;
    }

    /**
     * Consume the body stream and parse it as JSON
     *
     * @return mixed The value of the parsed JSON
     */
    public function json() {
        return \json_decode(\stream_get_contents($this->get_body()));
    }
}
