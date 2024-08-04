<?php

namespace FocusCamera\Models;

use InvalidArgumentException;

abstract class Customer {
    protected $id;
    protected $name;
    protected $email;

    public function __construct(?int $id, string $name, string $email) {
        $this->id = $id;
        $this->setName($name);
        $this->setEmail($email);
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setName(string $name): void {
        if (empty($name)) {
            throw new InvalidArgumentException("Name cannot be empty");
        }
        $this->name = htmlspecialchars(trim($name), ENT_QUOTES, 'UTF-8');
    }

    public function setEmail(string $email): void {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format");
        }
        $this->email = htmlspecialchars(trim($email), ENT_QUOTES, 'UTF-8');
    }

    abstract public function getType(): string;
}