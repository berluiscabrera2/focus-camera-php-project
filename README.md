# Focus Camera Junior Dev PHP Project

This project is a simple CRUD application for managing customer entities, developed as part of the Focus Camera junior developer application process.

## Setup

1. Make sure you have PHP 7.4 or higher installed.
2. Install Composer if you haven't already (https://getcomposer.org/).
3. Clone this repository.
4. Navigate to the project directory and run `composer install` to install dependencies.
5. Ensure the `data` directory is writable by your web server.

## Running the Project

To run the project, navigate to the project directory in your terminal and execute:

php public/index.php

This will run the sample CRUD operations and output the results to the console.

## Project Structure

- `src/`: Contains the source code for the project.
  - `Database/`: Database connection class.
  - `Models/`: Customer models.
  - `Managers/`: CustomerManager for CRUD operations.
- `public/`: Contains the entry point for the application.
- `data/`: Stores the SQLite database file.
