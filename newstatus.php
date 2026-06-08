<?php
require_once 'mysql.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = (int)$_GET['id'];
    $action = $_GET['action'];

    try {
        switch ($action) {
            case 'start':
                $sql = "UPDATE tasks SET status = 'In Progress' WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                break;

            case 'finish':
                $sql = "UPDATE tasks SET status = 'Done' WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                break;

            case 'delete':
                $sql = "DELETE FROM tasks WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                break;
                
            default:
                break;
        }
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Error updating task status: " . $e->getMessage());
    }
    
} else {
    header("Location: index.php");
    exit();
}
?>