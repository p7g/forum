<?php
namespace forum\models;

class User {
    public static function from_array(array $data): User {
        $user = (new static())
            ->set_name($data['name'])
            ->set_email($data['email'])
            ->set_signature($data['signature'])
            ->set_date_of_birth(new \DateTime($data['date_of_birth']));
        if (isset($data['id'])) {
            $user->set_id($data['id']);
        }
        return $user;
    }

    /** @var int|null */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $email;
    /** @var string */
    private $signature;
    /** @var \DateTime */
    private $date_of_birth;

    public function get_id(): ?int {
        return $this->id;
    }

    public function set_id(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function get_name(): string {
        return $this->name;
    }

    public function set_name(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function get_email(): string {
        return $this->email;
    }

    public function set_email(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function get_signature(): string {
        return $this->signature;
    }

    public function set_signature(string $signature): self {
        $this->signature = $signature;
        return $this;
    }

    public function get_date_of_birth(): \DateTime {
        return $this->date_of_birth;
    }

    public function set_date_of_birth(\DateTime $date_of_birth): self {
        $this->date_of_birth = $date_of_birth;
        return $this;
    }
}
