# Library Management API Take Home Exercise

This exercise is designed to assess your ability to build a robust, production-ready RESTful API using Laravel. It covers Laravel fundamentals, API design, testing, performance, security, and more. The goal is to demonstrate your skills in building a secure, maintainable, and high-performance API application.

---

## Overview

You are tasked with developing a **Library Management API** that allows users to browse books, borrow/return them, and enables administrators to manage the book catalog. The API should incorporate best practices in authentication, role-based access control, event-driven design, caching, error handling, logging, and automated testing.

---

## Functional Requirements

### 1. User Authentication & Authorization
- **User Registration & Login:**  
  - Implement endpoints for user registration and login using Laravel Sanctum (or JWT/Passport).
- **Role-Based Access Control:**  
  - Define at least two roles: **Admin** and **Regular User**.
  - **Admins**: Can create, update, and delete books.
  - **Regular Users**: Can view books and manage their own borrowings.

### 2. Books Management
- **CRUD Endpoints for Books:**
  - **List Books:**  
    - Provide a paginated list of books available to all users.
  - **View Book Details:**  
    - Return detailed information about a specific book.
  - **Create/Update/Delete Books:**  
    - Only admins can perform these operations.
- **Caching:**  
  - Implement caching for the list of books.
  - Ensure that the cache is invalidated or updated when changes are made to the catalog.

### 3. Borrowing & Returning Books
- **Borrow Book Endpoint:**
  - Allow a regular user to borrow a book.
  - Update the book's status (e.g., from available to borrowed).
  - Dispatch an event to simulate sending a notification (e.g., email or log entry).
- **Return Book Endpoint:**
  - Allow the user to return a borrowed book, updating the book’s status accordingly.

### 4. API Documentation
- Generate comprehensive API documentation using a tool such as Swagger/OpenAPI.
- Ensure that all endpoints, request formats, and responses are well-documented.

---

## Technical & Architectural Requirements

### Laravel Best Practices
- **Project Structure:**  
  - Follow Laravel’s recommended structure.
- **Dependency Injection & Service Providers:**  
  - Use dependency injection for services and repositories.
- **Middleware:**  
  - Implement middleware for authentication, role verification, and request logging.
- **Artisan Commands:**  
  - Develop and test any custom commands as needed.

### Database & Eloquent ORM
- **Migrations & Seeders:**  
  - Create migrations for users, roles, books, and borrowings.
  - Populate the database with sample data using seeders.
- **Eloquent Models & Relationships:**  
  - Define proper relationships (e.g., User hasMany Borrowings, Book hasMany Borrowings).

### Event-Driven Architecture & Queues
- **Events & Listeners:**  
  - Create an event that triggers when a book is borrowed.
  - Develop a listener that processes this event asynchronously (e.g., simulating a notification).
- **Queue Management:**  
  - Configure and use a queue driver (even if it is the sync driver for simplicity).

### Performance & Caching
- Implement caching for the books listing endpoint.
- Ensure that cache invalidation works correctly when data is modified.

### Security
- Validate all incoming data using Laravel’s validation features.
- Secure the API against vulnerabilities such as SQL injection, XSS, and CSRF.
- Simulate secure endpoints (e.g., enforce HTTPS where applicable).

### Error Handling & Logging
- Implement robust error handling with informative, secure error messages.
- Use Laravel’s logging capabilities to capture errors and important events.

### Testing & Quality Assurance
- **Unit Tests:**  
  - Test individual components (controllers, services, model methods).
- **Integration/Feature Tests:**  
  - Write tests to cover complete scenarios such as user registration, authentication, and book borrowing/returning.
- **Security & Performance Tests:**  
  - Validate role-based access, input validations, and response times under simulated load.
- Use Laravel’s built-in testing tools (PHPUnit, HTTP testing helpers) and consider static analysis tools (PHPStan, Psalm).

---

## Submission Requirements

Please submit your work via a public Git repository (e.g., GitHub, GitLab) including the following:

1. **Source Code:**
   - The complete Laravel application code.
2. **Documentation:**
   - A `README.md` file with:
     - An overview of the project.
     - Instructions on how to set up and run the application locally (installation, migrations, etc.).
     - Instructions for running the automated test suite.
     - A description of architectural or design decisions made.
   - Generated API documentation (Swagger/OpenAPI) as a file or accessible endpoint.
3. **Environment Setup:**
   - Optionally, include a Docker Compose file to streamline local development (web server, database, queue worker, etc.).
4. **Testing Suite:**
   - A comprehensive set of tests (unit, integration, and functional).
   - Instructions on how to run tests and, optionally, code coverage reports.
5. **Additional Artifacts:**
   - A Postman collection (or similar) for testing API endpoints.
   - Documentation for any extra features or configurations.

---

## Evaluation Criteria

- **Completeness:**  
  - Does your solution meet all functional and technical requirements?
- **Code Quality & Architecture:**  
  - Is your code well-structured, maintainable, and adherent to Laravel best practices?
  - Is dependency injection used appropriately? Are design patterns applied where needed?
- **Testing:**  
  - Are there comprehensive tests covering critical paths, edge cases, and error handling?
- **Security & Performance:**  
  - Are input validations in place? Is the API secured against common vulnerabilities?
  - Are caching and performance optimizations effectively implemented?
- **Documentation:**  
  - Is the README detailed enough to allow other developers to set up, run, and understand the project?
  - Is the API documentation clear and complete?

---

Good luck, and we look forward to reviewing your implementation!
