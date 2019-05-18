<?php

require_once(ROOT.'/Model.php');

class Controller extends Model {

    //<input type="text" name="username">
    // <input type="text" name="user_email">
    // <input type="text" name="task_text">
    function addAction() {
        if (isset($_POST['username']) && isset($_POST['user_email'])&& isset($_POST['task_text'])) {
            $user_name = $_POST['username'];
            $user_email = $_POST['user_email'];
            $task_text = $_POST['task_text'];
            if (!empty($user_name) && !empty($user_email) && !empty($task_text)) {
                $this->addTask($user_name, $user_email, $task_text);
            } else {
                echo "<script>alert(\"Fill all fields, please.\");</script>";
                header('Location: /');
            }
        }
    }

    function deleteAction() {
        // $username = $_POST[''];
    }

    function doneAction() {
        // $username = $_POST[''];
    }

    function loginAction() {

    }
}