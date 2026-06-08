<?php
    require_once 'mysql.php'; 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = htmlspecialchars(trim($_POST['title']));
        $description = htmlspecialchars(trim($_POST['description']));
        $priority = htmlspecialchars(trim($_POST['priority']));
        $due_date = htmlspecialchars(trim($_POST['due_date']));
        
        $status = 'To Do'; 

        if (empty($title) || empty($due_date)) {
            die("Please fill in all required fields.");
        }

        try {
            $sql = "INSERT INTO tasks (title, description, priority, status, due_date) 
                    VALUES (:title, :description, :priority, :status, :due_date)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':priority', $priority);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':due_date', $due_date);
            
            if ($stmt->execute()) {
                header("Location: index.php?success=1");
                exit();
            } else {
                echo "Something went wrong. Please try again.";
            }
            
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    } else {
        header("Location: index.php");
        exit();
    }
?>