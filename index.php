<?php
    require_once 'mysql.php';

    try {
        $sql = "SELECT * FROM tasks ORDER BY due_date ASC";
        $stmt = $pdo->query($sql);
        $all_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Could not fetch tasks: " . $e->getMessage());
    }

    $todo_tasks = [];
    $inprogress_tasks = [];
    $done_tasks = [];

    foreach ($all_tasks as $task) {
        if ($task['status'] == 'To Do') {
            $todo_tasks[] = $task;
        } elseif ($task['status'] == 'In Progress') {
            $inprogress_tasks[] = $task;
        } elseif ($task['status'] == 'Done') {
            $done_tasks[] = $task;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Task & Assignment Planner</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .kanban-col { min-height: 70vh; background-color: #ffffff; border-radius: 8px; padding: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .task-card { border-left: 5px solid #6c757d; transition: transform 0.2s; }
        .task-card:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .priority-high { border-left-color: #dc3545; }
        .priority-medium { border-left-color: #ffc107; }
        .priority-low { border-left-color: #198754; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1"><i class="bi bi-calendar-check-fill me-2"></i>Assignment Planner</span>
            <span class="navbar-text text-white-50 small">Ze CT Group</span>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold text-secondary">Task Dashboard</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                    <i class="bi bi-plus-lg me-1"></i> Add New Assignment
                </button>
            </div>
        </div>

        <div class="row g-3">
            
            <div class="col-lg-4">
                <div class="kanban-col">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0 text-danger"><i class="bi bi-list-task me-2"></i>To Do</h5>
                        <span class="badge bg-danger rounded-pill"><?php echo count($todo_tasks); ?></span>
                    </div>
                    <hr>
                    
                    <?php if (empty($todo_tasks)): ?>
                        <p class="text-muted text-center my-4 small">No tasks to do!</p>
                    <?php else: ?>
                        <?php foreach ($todo_tasks as $task): ?>
                            <div class="card task-card priority-<?php echo $task['priority']; ?> mb-3">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-secondary text-capitalize btn-sm"><?php echo $task['priority']; ?></span>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>Due: <?php echo date('M d', strtotime($task['due_date'])); ?></small>
                                    </div>
                                    <h6 class="card-title fw-bold mb-1"><?php echo $task['title']; ?></h6>
                                    <p class="card-text text-muted small mb-3"><?php echo $task['description']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="newstatus.php?id=<?php echo $task['id']; ?>&action=delete" class="btn btn-sm btn-outline-danger" title="Delete">Delete<i class="bi bi-trash"></i></a>
                                        <a href="newstatus.php?id=<?php echo $task['id']; ?>&action=start" class="btn btn-sm btn-success" title="Move to In Progress">Start <i class="bi bi-arrow-right-short"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="kanban-col">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0 text-warning"><i class="bi bi-gear-fill me-2"></i>In Progress</h5>
                        <span class="badge bg-warning text-dark rounded-pill"><?php echo count($inprogress_tasks); ?></span>
                    </div>
                    <hr>

                    <?php if (empty($inprogress_tasks)): ?>
                        <p class="text-muted text-center my-4 small">No tasks in progress.</p>
                    <?php else: ?>
                        <?php foreach ($inprogress_tasks as $task): ?>
                            <div class="card task-card priority-<?php echo $task['priority']; ?> mb-3">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-secondary text-capitalize btn-sm"><?php echo $task['priority']; ?></span>
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>Due: <?php echo date('M d', strtotime($task['due_date'])); ?></small>
                                    </div>
                                    <h6 class="card-title fw-bold mb-1"><?php echo $task['title']; ?></h6>
                                    <p class="card-text text-muted small mb-3"><?php echo $task['description']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="newstatus.php?id=<?php echo $task['id']; ?>&action=delete" class="btn btn-sm btn-outline-danger" title="Delete">Delete<i class="bi bi-trash"></i></a>
                                        <a href="newstatus.php?id=<?php echo $task['id']; ?>&action=finish" class="btn btn-sm btn-success" title="Mark as Done">Finish <i class="bi bi-check-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="kanban-col">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0 text-success"><i class="bi bi-check-circle-fill me-2"></i>Done</h5>
                        <span class="badge bg-success rounded-pill"><?php echo count($done_tasks); ?></span>
                    </div>
                    <hr>
                    
                    <?php if (empty($done_tasks)): ?>
                        <p class="text-muted text-center my-4 small">No completed tasks yet.</p>
                    <?php else: ?>
                        <?php foreach ($done_tasks as $task): ?>
                            <div class="card task-card priority-<?php echo $task['priority']; ?> mb-3 opacity-75">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-secondary text-capitalize btn-sm"><?php echo $task['priority']; ?></span>
                                        <small class="text-text-muted text-decoration-line-through">Completed</small>
                                    </div>
                                    <h6 class="card-title fw-bold mb-1 text-decoration-line-through"><?php echo $task['title']; ?></h6>
                                    <p class="card-text text-muted small mb-3"><?php echo $task['description']; ?></p>
                                    <div class="text-end">
                                        <a href="newstatus.php?id=<?php echo $task['id']; ?>&action=delete" class="btn btn-sm btn-outline-danger" title="Delete">Delete<i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addTaskModalLabel">New Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="insert_task.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Task Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Example: Do my Tinkercad assignment" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Briefly explain the task..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small fw-bold">Priority</label>
                                <select name="priority" class="form-select">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small fw-bold">Due Date</label>
                                <input type="date" name="due_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>