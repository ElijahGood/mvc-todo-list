<?php

require_once(ROOT.'/View.php');

class Model {

    private $pdo;
    private $currentUser;

    // var $page_num = 1;
    // var $num_of_recodrs = 3;
    // var $offset = ($page_num - 1) * $num_of_recodrs;

    
    public function __construct() {
        $db_config = require ROOT.'/config/database.php';
        $this->pdo = new PDO('mysql:host='.$db_config['host'].';dbname='.$db_config['name'].'', $db_config['user'], $db_config['password']);
    }


    public function getAllTasks($start_id) {
        echo "here we go!";
        $id = intval($start_id);
        $stmt = "SELECT * FROM tasks";
        $query = $this->pdo->prepare($stmt);
        $query->execute();
        $allTasks = $query->fetchAll();
        if ($allTasks) {
            // debug($allTasks);
            $view = new View('main.php', $allTasks);

            // foreach ($allTasks as $item) {
            //     echo $item['task_text']."\r\n";
               
            // }
        }
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