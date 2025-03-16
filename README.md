# Mini Task Management System

This is a Mini Task Management System built using PHP and Laravel. It allows users to create, update, delete, and list tasks. Tasks can be assigned a priority and a due date. The system follows the MVC architecture and includes a REST API for task management.

## Features

- **Create Task**: Add a new task with a title, description, priority, due date, and status.
- **List Tasks**: Fetch all tasks with pagination.
- **View Task**: Fetch a single task by its ID.
- **Update Task**: Update task details such as title, priority, due date, and status.
- **Delete Task**: Remove a task from the system.
- **Validation**: Ensures proper validation for task creation and updates (e.g., title cannot be empty, due date must be in the future).
- **Pagination**: Tasks are paginated for better performance. 

## Database Design

The system uses a MySQL database with the following table structure:

### `tasks` Table

| Column Name   | Data Type               | Constraints                          |
|---------------|-------------------------|--------------------------------------|
| id            | INT                     | Primary Key, Auto Increment          |
| title         | VARCHAR(255)            | Not Null                             |
| description   | TEXT                    | Optional                             |
| priority      | ENUM('Low', 'Medium', 'High') | Not Null                     |
| due_date      | DATE                    | Not Null                             |
| status        | ENUM('Pending', 'Completed') | Not Null                      |
| created_at    | TIMESTAMP               | Default: CURRENT_TIMESTAMP           |
| updated_at    | TIMESTAMP               | Default: CURRENT_TIMESTAMP on update |

## API Endpoints

The following REST API endpoints are available:

- **POST /tasks**: Create a new task.
- **GET /tasks**: Fetch all tasks with pagination.
- **GET /tasks/{id}**: Fetch a single task by ID.
- **PUT /tasks/{id}**: Update task details.
- **DELETE /tasks/{id}**: Delete a task.

### Example Requests

#### Create a Task
```json
POST /tasks
{
  "title": "Complete Assignment",
  "description": "Finish the Mini Task Management System project.",
  "priority": "High",
  "due_date": "2023-12-31",
  "status": "Pending"
}
