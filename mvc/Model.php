<?php

require_once(ROOT.'/mvc/View.php');

class Model {

    private $pdo;
    private $currentUser;
    
    public function __construct() {
        $db_config = require ROOT.'/config/database.php';
        $this->pdo = new PDO('mysql:host='.$db_config['host'].';dbname='.$db_config['name'].'', $db_config['user'], $db_config['password']);
    }


    public function getAllTasks($start_id) {
    
        $_SESSION['total_num_of_tasks'] = $this->getSumOfItems();
        $id = intval($start_id);

        //dealing with sorting
        if (isset($_GET['sort']) && $_GET['order']) {
            $order = $_GET['order'];
            $sort = $_GET['sort'];
            $stmt = "SELECT * FROM (SELECT * FROM tasks LIMIT :id, 3) AS T1 ORDER BY $order $sort";
        } else {
            $stmt = "SELECT * FROM tasks LIMIT :id, 3";
        }
        $query = $this->pdo->prepare($stmt);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $allTasks = $query->fetchAll();
        if ($allTasks) {
            $view = new View('main.php', $allTasks);
        }
    }

    public function changeTaskStatus($id) {
        $stmt = "UPDATE tasks SET checked = ((checked - 1) * (-1)) WHERE tasks.id = $id";
        $query = $this->pdo->prepare($stmt);
        $query->execute();
    }

    public function changeTastText($id, $newText) {
        $stmt = "UPDATE tasks SET task_text = '$newText' WHERE id = $id";
        $query = $this->pdo->prepare($stmt);
        $query->execute();
    }

    public function getSumOfItems() {
        $stmt = "SELECT * FROM tasks";
        $query = $this->pdo->prepare($stmt);
        $query->execute();
        $totalNumOfItems = $query->fetchAll(); ;
        return (count($totalNumOfItems));
    }

    public function addTask($user_name, $user_email, $task_text) {
        if (isset($user_name) && isset($user_email)&& isset($task_text)) {
            $cur_date = date("Y-m-d H:i:s");
            $stmt = "INSERT INTO tasks (user_name, user_email, task_text, date_time)
                    VALUES ('$user_name', '$user_email', '$task_text', '$cur_date')";
            $query = $this->pdo->prepare($stmt);
            $query->bindParam(':user_name', $user_name, PDO::PARAM_STR);
            $query->bindParam(':user_email', $user_email, PDO::PARAM_STR);
            $query->bindParam(':task_text', $task_text, PDO::PARAM_STR);
            $query->execute();
        }
        header("Location: /");
    }
}