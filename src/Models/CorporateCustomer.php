<?php

namespace FocusCamera\Models;

use InvalidArgumentException;

class CorporateCustomer extends Customer {
    protected $companyName;

    public function __construct(?int $id, string $name, string $email, string $companyName) {
        parent::__construct($id, $name, $email);
        $this->setCompanyName($companyName);
    }

    public function getCompanyName(): string {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): void {
        if (empty($companyName)) {
            throw new InvalidArgumentException("Company name cannot be empty");
        }
        $this->companyName = htmlspecialchars(trim($companyName), ENT_QUOTES, 'UTF-8');
    }

    public function getType(): string {
        return 'Corporate';
    }
}