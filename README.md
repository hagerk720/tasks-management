# Task Management API Documentation

## Introduction

This project is a Task Management API built with Laravel, providing functionality for task creation, assignment, and status management. Authentication is handled via Laravel Sanctum.

## Features

-   User authentication (login via Sanctum)
-   Task creation and assignment
-   Task status updates
-   Task filtering and retrieval
-   Role-based access control (Manager, User)

## Installation and Setup

### Prerequisites

Ensure you have the following installed:

-   Docker & Docker Compose (for containerized setup)
-   PHP 8.1+
-   Composer
-   Laravel 10+
-   MySQL

### Steps to Run with Docker

1.  Clone the repository:

    ```sh
    git clone https://github.com/hagerk720/tasks-management.git
    cd tasks-management
    ```

2.  Copy the `.env` file:

    ```sh
    cp .env.example .env
    ```

    and update credential

    ```env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=task_management
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

3.  Build and start the Docker containers:

        ```sh
        docker-compose up -d --build
        ```

    wait the image of laravel_db fully running in docker desktop"ready for connections"

4.  Run migrations and seeders:

    ```sh
    docker-compose exec app composer install
    docker-compose exec app php artisan migrate --seed
    docker-compose exec app php artisan key:generate
    ```

5.  Access the application at `http://localhost:8080`

6.  Access the Swagger documentation at `http://localhost:8080/api/documentation`

7.  Access phpMyAdmin (Optional)
    If you're using phpMyAdmin, visit:
    🔗 http://localhost:8081

Use these credentials:

Username: root
Password: root

### Steps to Run Locally

1. Clone the repository:

    ```sh
    git clone https://github.com/hagerk720/tasks-management.git
    cd tasks-management
    ```

2. Install dependencies:

    ```sh
    composer install
    ```

3. Copy the `.env` file:

    ```sh
    cp .env.example .env
    ```

4. Generate application key:

    ```sh
    php artisan key:generate
    ```

5. Set up the database in `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task_management
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Run database migrations and seeders:

    ```sh
    php artisan migrate --seed
    ```

7. Start the development server:

    ```sh
    php artisan serve
    ```

## Running Swagger Documentation


1. Generate Swagger documentation:

    ```bash
    php artisan l5-swagger:generate
    ```

2. Access the Swagger UI at:
    - Locally: `http://localhost:8000/api/documentation`
    - Docker: `http://localhost:8080/api/documentation`

## API Endpoints

### Authentication

-   **Login**: `POST /login`
    -   For Manager:
        ```json
        {
            "email": "admin@manager.com",
            "password": "123456"
        }
        ```
    -   For User:
        ```json
        {
            "email": "user@test.com",
            "password": "123456"
        }
        ```

### Tasks (Authenticated Routes)

-   **Create Task**: `POST /tasks`
-   **Update Task**: `PUT /tasks/{taskId}`
-   **Assign Task**: `PATCH /tasks/{taskId}/assign`
-   **Update Task Status**: `PATCH /tasks/{taskId}/status`
-   **Get All Tasks**: `GET /tasks`
-   **Get Task Details**: `GET /tasks/{taskId}`

## Available Users for Login

| Name          | Email             | Password |
| ------------- | ----------------- | -------- |
| Admin Manager | admin@manager.com | 123456   |
| Normal User   | user@test.com     | 123456   |
| Normal User 2 | user2@test.com    | 123456   |

## Task Statuses

| Status    | Description                     |
| --------- | ------------------------------- |
| To Do     | Task is created but not started |
| Pending   | Task is in progress             |
| Completed | Task is finished                |
| Canceled  | Task is canceled                |

## User Roles

| Role    | Description                                         |
| ------- | --------------------------------------------------- |
| Manager | Can create and assign tasks, manage statuses        |
| User    | Can view and update tasks statuses assigned to them |

## ERD Diagram

![bandicam 2025-03-07 20-29-56-887](https://github.com/user-attachments/assets/79e75c01-2898-41e7-8c65-44824eb28446)

## Postman Collection

You can import the Postman collection from the following file: [Postman Collection](tasks_management.postman_collection.json)


![bandicam 2025-03-09 23-47-35-080](https://github.com/user-attachments/assets/81b39373-bfec-4674-91c6-ef1e86960d26)
