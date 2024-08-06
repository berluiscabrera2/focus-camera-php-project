<?php

require_once __DIR__ . '/../vendor/autoload.php';

use FocusCamera\Database\DatabaseConnection;
use FocusCamera\Models\RetailCustomer;
use FocusCamera\Models\CorporateCustomer;
use FocusCamera\Managers\CustomerManager;

function printHeader($text) {
    echo PHP_EOL . "=== $text ===" . PHP_EOL;
}

function printCustomerDetails($customer) {
    echo "  ID: " . $customer->getId() . PHP_EOL;
    echo "  Name: " . $customer->getName() . PHP_EOL;
    echo "  Email: " . $customer->getEmail() . PHP_EOL;
    echo "  Type: " . $customer->getType() . PHP_EOL;
    if ($customer instanceof CorporateCustomer) {
        echo "  Company: " . $customer->getCompanyName() . PHP_EOL;
    }
    echo PHP_EOL;
}

// Create database connection
$dbPath = __DIR__ . '/../data/customers.sqlite';
$dbConnection = new DatabaseConnection($dbPath);

// Create CustomerManager instance
$customerManager = new CustomerManager($dbConnection);

echo "Focus Camera Customer Management System" . PHP_EOL;

// Create a new retail customer
printHeader("Creating a Retail Customer");
$retailCustomer = new RetailCustomer(null, 'Maria Garcia', 'maria@example.com');
$customerManager->createCustomer($retailCustomer);
echo "Retail customer created successfully" . PHP_EOL;
printCustomerDetails($retailCustomer);

// Create a new corporate customer
printHeader("Creating a Corporate Customer");
$corporateCustomer = new CorporateCustomer(null, 'Jamal Washington', 'jamal@company.com', 'WarnerBros Inc.');
$customerManager->createCustomer($corporateCustomer);
echo "Corporate customer created successfully" . PHP_EOL;
printCustomerDetails($corporateCustomer);

// Retrieve a customer
printHeader("Retrieving a Customer");
$retrievedCustomer = $customerManager->getCustomerById(1);
if ($retrievedCustomer) {
    echo "Customer retrieved successfully" . PHP_EOL;
    printCustomerDetails($retrievedCustomer);
} else {
    echo "No customer found with ID 1" . PHP_EOL;
}

// Update a customer
if ($retrievedCustomer) {
    printHeader("Updating a Customer");
    $oldName = $retrievedCustomer->getName();
    $retrievedCustomer->setName('Maria L. Garcia');
    $customerManager->updateCustomer($retrievedCustomer);
    echo "Customer updated successfully" . PHP_EOL;
    echo "Name changed from '$oldName' to '{$retrievedCustomer->getName()}'" . PHP_EOL;
    printCustomerDetails($retrievedCustomer);
}

// Delete a customer
printHeader("Deleting a Customer");
$customerToDelete = $customerManager->getCustomerById(2);
if ($customerToDelete) {
    $customerManager->deleteCustomer(2);
    echo "Customer deleted successfully" . PHP_EOL;
    echo "Deleted customer details:" . PHP_EOL;
    printCustomerDetails($customerToDelete);
} else {
    echo "No customer found with ID 2 to delete" . PHP_EOL;
}

// List all customers
printHeader("Listing All Customers");
$allCustomers = $customerManager->getAllCustomers();
if (count($allCustomers) > 0) {
    foreach ($allCustomers as $customer) {
        printCustomerDetails($customer);
    }
} else {
    echo "No customers found in the database" . PHP_EOL;
}

echo "CRUD Operations Completed" . PHP_EOL;