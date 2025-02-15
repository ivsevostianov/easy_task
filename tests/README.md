# Tests Documentation

## Purpose

This test suite validates two main user stories:
1. Task Creation - validating that users can create and manage tasks
2. Task List Viewing - ensuring proper access control and display of tasks

## Test Files

### Unit Tests (`tests/Unit/`)
* **NameValidationTest.php**
  * Validates task name format
  * Ensures proper validation rules for task titles

### Feature Tests (`tests/Feature/`)
* **TaskTest.php**
  * Tests task creation (happy & unhappy paths)
  * Tests task viewing access control

## Running Tests

### All tests:
```bash
docker-compose exec web php artisan test
```

### Specific test file:
```bash
docker-compose exec web php artisan test tests/Feature/TaskTest.php
```

### Specific test method:
```bash
docker-compose exec web php artisan test --filter test_user_can_create_task
```

## Test Coverage

* Task creation validation
* Database persistence
* Access control (users can only see their own tasks)
* Input validation
* Error handling

## Key Test Cases

### Task Creation
* Creating tasks with valid titles
* Handling invalid title inputs
* Verifying database persistence
* Validating required fields

### Task List Viewing
* Viewing task lists with proper authorization
* Verifying user can only see their own tasks
* Testing pagination and sorting
* Handling empty task lists

### Error Handling
* Invalid input validation
* Unauthorized access attempts
* Database operation failures
* Form submission errors

## Best Practices

* Each test focuses on a single piece of functionality
* Tests are independent and can run in any order
* Clear naming conventions for test methods
* Proper use of test data factories
* Comprehensive assertions for each test case
