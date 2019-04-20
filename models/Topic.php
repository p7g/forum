<?php
namespace forum\models;

class Topic {
    /** @var string */
    private $name;
    /** @var string */
    private $description;

    public function get_name(): string {
        return $this->name;
    }

    public function set_name(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function get_description(): string {
        return $this->description;
    }

    public function set_description(string $description): self {
        $this->description = $description;
        return $this;
    }
}
