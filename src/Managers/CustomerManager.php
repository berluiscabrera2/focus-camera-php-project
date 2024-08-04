<?php

namespace FocusCamera\Managers;

use FocusCamera\Database\DatabaseConnection;
use FocusCamera\Models\Customer;
use FocusCamera\Models\RetailCustomer;
use FocusCamera\Models\CorporateCustomer;
use PDO;
use InvalidArgumentException;

class CustomerManager {
    private $db;

    public function __construct(DatabaseConnection $db) {
        $this->db = $db->getConnection();
    }

    public function createCustomer(Customer $customer): bool {
        $sql = "INSERT INTO customers (name, email, type, company_name) VALUES (:name, :email, :type, :company_name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $customer->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $customer->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':type', $customer->getType(), PDO::PARAM_STR);
        $stmt->bindValue(':company_name', $customer instanceof CorporateCustomer ? $customer->getCompanyName() : null, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getAllCustomers(): array {
        $sql = "SELECT * FROM customers";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map([$this, 'createCustomerObject'], $results);
    }

    public function getCustomerById(int $id): ?Customer {
        $sql = "SELECT * FROM customers WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return $this->createCustomerObject($result);
    }

    public function updateCustomer(Customer $customer): bool {
        $sql = "UPDATE customers SET name = :name, email = :email, type = :type, company_name = :company_name WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $customer->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':name', $customer->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $customer->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':type', $customer->getType(), PDO::PARAM_STR);
        $stmt->bindValue(':company_name', $customer instanceof CorporateCustomer ? $customer->getCompanyName() : null, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteCustomer(int $id): bool {
        $sql = "DELETE FROM customers WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    private function createCustomerObject(array $data): Customer {
        if ($data['type'] === 'Retail') {
            return new RetailCustomer($data['id'], $data['name'], $data['email']);
        } elseif ($data['type'] === 'Corporate') {
            return new CorporateCustomer($data['id'], $data['name'], $data['email'], $data['company_name'] ?? '');
        }
        throw new InvalidArgumentException("Unknown customer type");
    }
}