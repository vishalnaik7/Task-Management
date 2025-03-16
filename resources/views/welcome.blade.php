  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .badge.bg-warning { color: #000; }
        .badge.bg-success { color: #fff; }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Task Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item" id="loginNavItem">
                        <a class="nav-link" href="#" id="loginNavLink" data-bs-toggle="modal" data-bs-target="#authModal">Login</a>
                    </li>
                     
                    <li class="nav-item" id="logoutNavItem" style="display: none;">
                        <a class="nav-link" href="#" id="logoutNavLink">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login/Sign Up Modal -->
    <div class="modal fade" id="authModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authModalTitle">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs mb-3" id="authTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="loginTab" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="registerTab" href="#">Sign Up</a>
                        </li>
                    </ul>

                    <!-- Login Form -->
                    <form id="loginForm">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <!-- Register Form (Initially Hidden) -->
                    <form id="registerForm" class="d-none">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="registerName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="registerEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Sign Up</button>
                    </form>

                    <div id="authMessage" class="mt-3 text-center"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Task Management</h2>

        <!-- Search & Filter Section -->
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by Title">
                    </div>
                    <div class="col-md-3">
                        <select id="priorityFilter" class="form-select">
                            <option value="">All Priorities</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="statusFilter" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Task Form -->
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"><input type="text" id="title" class="form-control" placeholder="Title"></div>
                    <div class="col-md-3"><input type="text" id="description" class="form-control" placeholder="Description"></div>
                    <div class="col-md-2">
                        <select id="priority" class="form-select">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="col-md-2"><input type="date" id="due_date" class="form-control"></div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100" onclick="createTask()">Add Task</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Table -->
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="taskList"></tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-3" id="pagination"> 
            </ul>
        </nav>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editTaskModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editTaskId">
                    <input type="text" id="editTitle" class="form-control mb-2" placeholder="Title">
                    <input type="text" id="editDescription" class="form-control mb-2" placeholder="Description">
                    <select id="editPriority" class="form-select mb-2">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                    <input type="date" id="editDueDate" class="form-control mb-2">
                    <select id="editStatus" class="form-select">
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updateTask()">Update Task</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this task?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script> 

const API_BASE = "http://127.0.0.1:8000/api";
const API_URL = `${API_BASE}/tasks`; 
 
function getAuthHeader() {
    const token = localStorage.getItem("token");
    return {
        "Authorization": `Bearer ${token}`,
        "Content-Type": "application/json"
    };
}

function fetchTasks(page = 1) {
    let searchQuery = $("#searchInput").val();
    let priority = $("#priorityFilter").val();
    let status = $("#statusFilter").val();

    let url = `${API_URL}?page=${page}`;
    if (searchQuery) url += `&search=${searchQuery}`;
    if (priority) url += `&priority=${priority}`;
    if (status) url += `&status=${status}`;

    $.ajax({
        url: url,
        method: "GET",
        headers: getAuthHeader(),
        success: function(response) { 
            let rows = "";
            response.data.forEach(task => {
                let statusClass = task.status === 'Pending' ? 'bg-warning' : 'bg-success';
                rows += `
                    <tr>
                        <td>${task.title}</td>
                        <td>${task.description || 'N/A'}</td>
                        <td>${task.priority}</td>
                        <td>${task.due_date}</td>
                        <td><span class="badge ${statusClass}">${task.status}</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="showEditModal(${task.id}, '${task.title}', '${task.description}', '${task.priority}', '${task.due_date}', '${task.status}')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="showDeleteConfirmationModal(${task.id})">Delete</button>
                        </td>
                    </tr>
                `;
            });
            $("#taskList").html(rows); 
            updatePagination(response);
        } 
    });
} 
 
function updatePagination(response) {
    let paginationHtml = "";
    const currentPage = response.current_page;
    const lastPage = response.last_page; 
    if (currentPage > 1) {
        paginationHtml += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="fetchTasks(${currentPage - 1})">Previous</a>
            </li>
        `;
    } 
    for (let i = 1; i <= lastPage; i++) {
        paginationHtml += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="fetchTasks(${i})">${i}</a>
            </li>
        `;
    }

     
    if (currentPage < lastPage) {
        paginationHtml += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="fetchTasks(${currentPage + 1})">Next</a>
            </li>
        `;
    }

    $("#pagination").html(paginationHtml);
}

 
function createTask() {
    let task = {
        title: $("#title").val(),
        description: $("#description").val(),
        priority: $("#priority").val(),
        due_date: $("#due_date").val(),
        status: "Pending"
    };

    $.ajax({
        url: API_URL,
        method: "POST",
        headers: getAuthHeader(),
        data: JSON.stringify(task),
        success: function() {
            $("#title, #description, #due_date").val(""); // Clear form fields
            fetchTasks();
            Swal.fire({
                icon: 'success',
                title: 'Task Created',
                text: 'Your task has been successfully created.',
            });
        },
        error: function(xhr) {
            if (xhr.status === 401) { 
                Swal.fire({
                    icon: 'error',
                    title: 'Unauthorized',
                    text: 'Please log in to create a task.',
                    showCancelButton: true,
                    confirmButtonText: 'Log In',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) { 
                        document.getElementById("loginNavLink").click();
                    }
                });
            } else if (xhr.status === 422) { 
                let errors = xhr.responseJSON.errors;
                let errorMessages = "";
                for (let field in errors) {
                    errorMessages += `${errors[field].join("<br>")}<br>`;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errorMessages,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred.',
                });
            }
        }
    });
} 
 
function showEditModal(id, title, description, priority, dueDate, status) {
    $("#editTaskId").val(id);
    $("#editTitle").val(title);
    $("#editDescription").val(description);
    $("#editPriority").val(priority);
    $("#editDueDate").val(dueDate);
    $("#editStatus").val(status);
    $("#editTaskModal").modal("show");
}
 
function updateTask() {
    let id = $("#editTaskId").val();
    let task = {
        title: $("#editTitle").val(),
        description: $("#editDescription").val(),
        priority: $("#editPriority").val(),
        due_date: $("#editDueDate").val(),
        status: $("#editStatus").val()
    };

    $.ajax({
        url: `${API_URL}/${id}`,
        method: "PUT",
        headers: getAuthHeader(),
        data: JSON.stringify(task),
        success: function() {
            $("#editTaskModal").modal("hide");
            fetchTasks();
            Swal.fire({
                icon: 'success',
                title: 'Task Updated',
                text: 'Your task has been successfully updated.',
            });
        },
        error: function(xhr) {
            if (xhr.status === 422) { 
                let errors = xhr.responseJSON.errors;
                let errorMessages = "";
                for (let field in errors) {
                    errorMessages += `${errors[field].join("<br>")}<br>`;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errorMessages,
                });
            } else if (xhr.status === 404) {
                Swal.fire({
                    icon: 'error',
                    title: 'Task Not Found',
                    text: 'The task you are trying to update does not exist.',
                });
            }  
        }
    });
}

function showDeleteConfirmationModal(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteTask(id);
        }
    });
}

// Delete a task
function deleteTask(id) {
    $.ajax({
        url: `${API_URL}/${id}`,
        method: "DELETE",
        headers: getAuthHeader(),
        success: function() {
            fetchTasks();
            Swal.fire({
                icon: 'success',
                title: 'Task Deleted',
                text: 'Your task has been successfully deleted.',
            });
        },
    });
}


function updateNavbar() {
    const token = localStorage.getItem("token");
    if (token) {
        $("#loginNavItem").hide();
        $("#registerNavItem").hide();
        $("#logoutNavItem").show();
    } else {
        $("#loginNavItem").show();
        $("#registerNavItem").show();
        $("#logoutNavItem").hide();
    }
}


$("#loginForm").submit(function(e) {
    e.preventDefault();
    let credentials = {
        email: $("#loginEmail").val(),
        password: $("#loginPassword").val()
    };
    $.post(`${API_BASE}/login`, credentials, function(response) {
        localStorage.setItem("token", response.token); // Save the token
        $("#authModal").modal("hide");
        window.location.reload(); // Refresh the page to update the UI
    }).fail(function(xhr) {
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: xhr.responseJSON.error,
        });
    });
});


$("#registerForm").submit(function(e) {
    e.preventDefault();
    let user = {
        name: $("#registerName").val(),
        email: $("#registerEmail").val(),
        password: $("#registerPassword").val()
    };

    $.post(`${API_BASE}/register`, user, function(response) {
        Swal.fire({
            icon: 'success',
            title: 'Registration Successful',
            text: 'Please log in.',
        });
        $("#loginTab").click();
    }).fail(function(xhr) {
        // Handle validation errors
        if (xhr.status === 422) { // 422 is the status code for validation errors
            let errors = xhr.responseJSON.errors;
            let errorMessage = '';
            for (let field in errors) {
                errorMessage += `${errors[field].join('<br>')}\n`;
            }
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: errorMessage, // Use `html` to render line breaks
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: xhr.responseJSON.message || 'An error occurred. Please try again.',
            });
        }
    });
});

// Handle logout
$("#logoutNavLink").click(function() {
    localStorage.removeItem("token"); // Remove the token
    window.location.reload(); // Refresh the page to update the UI
});

 
$(document).ready(function() {
    updateNavbar();
    fetchTasks(); 
    $("#searchInput").on("input", function() {
        fetchTasks(1); 
    }); 
    $("#priorityFilter").on("change", function() {
        fetchTasks(1); 
    }); 
    $("#statusFilter").on("change", function() {
        fetchTasks(1); 
    }); 
    $("#loginTab").click(function() {
        $("#loginForm").removeClass("d-none");
        $("#registerForm").addClass("d-none");
        $("#authModalTitle").text("Login");
        $(this).addClass("active");
        $("#registerTab").removeClass("active");
    });

    $("#registerTab").click(function() {
        $("#registerForm").removeClass("d-none");
        $("#loginForm").addClass("d-none");
        $("#authModalTitle").text("Sign Up");
        $(this).addClass("active");
        $("#loginTab").removeClass("active");
    });
});
    </script>
</body>
</html>
