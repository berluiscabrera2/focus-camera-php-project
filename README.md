# Focus Camera Simple Customer Management System

This is a basic CRUD (Create, Read, Update, Delete) application for managing customer entities, developed as part of the junior developer application process. The project is built in PHP and uses SQLite for data storage, with a single table named "customers".

## Note to Focus Camera Staff

This project is a demonstration of basic PHP skills and understanding of key programming concepts. It's intentionally kept simple and doesn't include a frontend interface. The focus is on backend logic and code organization.

If you have any questions or need further clarification, please feel free to ask!


## Setup and Running the Application

1. Clone this repository to your local machine.
2. Navigate to the project directory in your terminal.
3. Run `composer install` to set up the autoloader.
4. To run the application, use the command: `php public/index.php`

## Project Structure

- `public/index.php`: Main entry point, demonstrates default CRUD operations
- `src/Database/DatabaseConnection.php`: Handles database connection
- `src/Managers/CustomerManager.php`: Manages CRUD operations for customers
- `src/Models/`: Contains Customer, RetailCustomer, and CorporateCustomer classes
  - `Customer.php`: Base abstract class for all customer types
  - `RetailCustomer.php`: Represents individual retail customers
  - `CorporateCustomer.php`: Represents business or corporate customers

## Key Features

1. **Data Validation**: Customer data is validated before being saved or updated.
2. **SQL Injection Protection**: Prepared statements are used to prevent SQL injection.
3. **Dependency Injection**: The database connection is injected into the CustomerManager.
4. **Inheritance**: RetailCustomer and CorporateCustomer inherit from the base Customer class.
