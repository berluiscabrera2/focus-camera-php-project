# Focus Camera Simple Customer Management System

This is a basic CRUD (Create, Read, Update, Delete) application for managing customer entities, developed as part of the junior developer application process.


## Note to Focus Camera Staff

This project is a demonstration of basic PHP skills and understanding of key programming concepts. It's intentionally kept simple and doesn't include a frontend interface. The focus is on backend logic and code organization.

If you have any questions or need further clarification, please feel free to ask!


## Project Overview

This PHP-based application demonstrates:
- Basic CRUD operations for customer management
- Data validation and sanitization
- Dependency injection for database connections
- Inheritance in object-oriented programming

## Setup and Running the Application

1. Make sure you have PHP (version 7.4 or higher) installed on your system.
2. Clone this repository to your local machine.
3. Navigate to the project directory in your terminal.
4. Run `composer install` to set up the autoloader.
5. To run the application, use the command: `php public/index.php`

## Project Structure

- `public/index.php`: Main entry point, demonstrates default CRUD operations
- `src/Database/DatabaseConnection.php`: Handles database connection
- `src/Managers/CustomerManager.php`: Manages CRUD operations for customers
- `src/Models/`: Contains Customer, RetailCustomer, and CorporateCustomer classes

## Key Features

1. **Data Validation**: Customer data is validated before being saved or updated.
2. **SQL Injection Protection**: Prepared statements are used to prevent SQL injection.
3. **Dependency Injection**: The database connection is injected into the CustomerManager.
4. **Inheritance**: RetailCustomer and CorporateCustomer inherit from the base Customer class.
