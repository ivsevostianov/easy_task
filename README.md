# Laravel Task Management Project

This project is a simple Laravel application that demonstrates:

* User Registration and Authentication (using Laravel's built-in auth scaffolding)
* Task Management (CRUD operations for tasks)
* Error Handling (custom error pages and a route to simulate a 500 error)

## Features

* **Registration & Login**: Users can register with a name, email, and password, then log in to access protected routes.
* **Task Management**: Authenticated users can create, read, update, and delete tasks.
* **Error Simulation**: A route (/simulate-500) triggers a 500 error to display the custom 500 page.
* **Form Validation**: Real-time client-side validation for registration fields (name, email, password, etc.).
* **Testing**: Includes Feature and Unit tests for user registration, name validation, and more.

## Prerequisites

* Docker and Docker Compose installed on your machine.

## Getting Started

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/your-laravel-repo.git
   cd your-laravel-repo
   ```

2. **Copy the .env.example to .env**:
   ```bash
   cp .env.example .env
   ```
   Make sure to update any necessary environment variables in .env (database, mail settings, etc.) if needed.

3. **Build and Start the Docker Containers**:
   ```bash
   docker-compose up -d
   ```
   This command builds and starts your application container, along with any other services (e.g., a MySQL container).

4. **Install Composer Dependencies**:
   You can either install dependencies on your local machine (and mount them in the container), or run it inside the container. For example, if your main PHP container is named app:
   ```bash
   docker exec -it app composer install
   ```

5. **Generate an Application Key**:
   ```bash
   docker exec -it app php artisan key:generate
   ```

6. **Run Migrations**:
   ```bash
   docker exec -it app php artisan migrate
   ```

7. **Access the Application**:
   Open your browser and go to http://localhost:8000 (or whichever port you set in your docker-compose.yml).
   You should see the welcome or login page.

## Usage

* **Register**: Visit /register or click "My Account" (depending on your front-end) to sign up for a new account.
* **Login**: Visit /login to sign in.
* **Tasks**: Once logged in, go to /tasks to create, view, edit, or delete tasks.
* **Simulate 500 Error**: Visit /simulate-500 to see the custom 500 error page.

## Running Tests

**Run All Tests**:
```bash
docker exec -it app php artisan test
```
or
```bash
docker exec -it app ./vendor/bin/phpunit
```

**Test Files**:
* Feature Tests: Located in tests/Feature/
* Unit Tests: Located in tests/Unit/

You should see a summary of passed/failed tests in your terminal.

## What This Project Is Meant to Do

### Demonstrate a Basic Laravel Application
Show how to set up user registration, login, tasks CRUD, and error handling with minimal boilerplate.

### Provide Client-Side Validation
Illustrate how to validate form fields in real-time (name, email, password, etc.) using JavaScript.

### Illustrate Testing
Show how to write unit and feature tests using Laravel's testing framework to ensure the core functionalities (e.g., registration, name validation, error handling) work correctly.

### Dockerize a Laravel App
Demonstrate how to run a Laravel project in Docker containers (PHP-FPM, Nginx/Apache, MySQL/Postgres, etc.).

## Troubleshooting

* **Port Conflicts**: If you have another service on port 8000, update the docker-compose.yml to use a different port.
* **Database Connection Issues**: Ensure your .env variables match the Docker service names (e.g., DB_HOST=db if your database container is named db).
* **Class Already Declared Errors**: Make sure there are no duplicate class declarations in app/Providers or other folders. If in doubt, run composer dump-autoload.

## License

This project is open-sourced under the MIT license.
