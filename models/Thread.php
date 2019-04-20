<?php
namespace forum\models;

class Thread {
    /** @var string */
    private $name;
    /** @var bool */
    private $pinned;
    /** @var int */
    private $author_id;

    public function get_name(): string {
        return $this->name;
    }

    public function set_name(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function is_pinned(): bool {
        return $this->pinned;
    }

    public function set_pinned(bool $pinned): self {
        $this->pinned = $pinned;
        return $this;
    }

    public function get_author_id(): int {
        return $this->author_id;
    }

    public function set_author_id(int $author_id): self {
        $this->author_id = $author_id;
        return $this;
    }
}
