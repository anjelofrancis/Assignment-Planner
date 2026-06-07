# Assignment-Planner

A clean, web-based task management system designed to help students organize, track, and prioritize their academic units and assignments. Built using **PHP, MySQL, and Bootstrap 5**.

---

## System Features
* **Dynamic Dashboard:** Visual columns separating assignments into **To Do**, **In Progress**, and **Done** states.
* **Task Insertion Modal:** Seamless pop-up form to input assignment titles, detailed descriptions, due dates, and priority levels.
* **Priority Color Coding:** Real-time visual tracking where high-priority tasks highlight in red, medium in yellow, and low in green.
* **Status Progression Logic:** Easy control buttons to instantly transition tasks between columns or completely delete records.
* **Dynamic Counter Badges:** Automatic badge tallies at the top of each column showing exact active item counts.

---

## Tech Stack & Architecture
* **Backend:** PHP 8.x
* **Database:** MySQL (Structured with PDO prepared statements for protection against SQL Injections)
* **Frontend UI:** HTML5, CSS3, Bootstrap 5, Bootstrap Icons

---

## Group Members & Contributions
As required for our group project submission, responsibilities were divided cleanly into three core structural roles:

1.  **Baristone Shikuku — Database & Connection Architect**
    * Designed the MySQL schema and configured the local data tables.
    * Wrote the core `mysql.php` utilizing secure PDO parameters.
    * Co-authored backend processing scripts to handle database inputs.
2.  **Anjelo Francis Oyolla — Frontend & UI Designer**
    * Created the main dashboard grid structure and Kanban board views.
    * Designed and embedded the responsive Bootstrap "New Assignment" form modal.
    * Handled the custom CSS style rules for priority colour coding and aesthetic visual transforms.
3.  **Caleb Kipruto — Logic & State Controller**
    * Wrote the dynamic array classification loops to correctly group tasks by status column.
    * Developed the state-management logic in `newstatus.php` for moving and deleting items.
    * Implemented server-side field inputs sanitization (`htmlspecialchars`).

---

## How to Run the Project Locally

### Prerequisites
* Ensure you have a local server environment installed, such as **XAMPP**.

### Installation Steps
1.  **Clone or Download the Repository:**
    ```bash
    git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
    ```
2.  **Move to Web Root:** Place the project folder into your server's web directory (e.g., `C:/xampp/htdocs/phpAssignment/`).
3.  **Set Up the Database:**
    * Open your browser and navigate to `http://localhost/phpmyadmin/`.
    * Create a brand new database named `task_manager`.
    * Go to the **SQL** tab and execute the following query to set up the schema:
    ```sql
    CREATE TABLE tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        priority ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
        status ENUM('To Do', 'In Progress', 'Done') DEFAULT 'To Do',
        due_date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```
4.  **Launch Server Modules:** Open your XAMPP Control Panel and start **Apache** and **MySQL**.
5.  **Run the App:** Open your web browser and go to `http://localhost/phpAssignment/`.

---

## Video Presentation & Demo
A detailed video walkthrough demonstrating code implementation, layout structure, and system operation can be viewed here:
**[YouTube Link nitaeka hapa]**
