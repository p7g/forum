<?php
namespace lib\http;

class Request {
    private $headers = [];
    private $body = null;
    private $query = [];

    public function get_headers(): array {
        return $this->headers;
    }

    public function get_header(string $name): string {
        $lower = \mb_strtolower($name);
        if (!isset($this->headers[$lower])) {
            throw new \Error("Header $name is not set");
        }
        return $this->headers[$lower];
    }

    public function set_headers(array $headers): self {
        $this->headers = $headers;
        return $this;
    }

    public function set_header(string $name, string $value): self {
        $this->headers[\mb_strtolower($name)] = $value;
        return $this;
    }

    public function get_body() {
        return $this->body;
    }

    public function set_body($body): self {
        $this->body = $body;
        return $this;
    }

    public function get_query(string $name): ?string {
        return $this->query[$name] ?? null;
    }

    public function get_query_all(): array {
        return $this->query;
    }

    public function set_query(string $name, string $value): self {
        $this->query[$name] = $value;
        return $this;
    }

    public function set_query_all(array $query): self {
        $this->query = $query;
        return $this;
    }

    public function json(): object {
        return \json_decode(\stream_get_contents($this->get_body()));
    }
}
