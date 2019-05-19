<?php

require_once(ROOT.'/mvc/Model.php');

class Controller extends Model {

    function addAction() {
        if (isset($_POST['username']) && isset($_POST['user_email'])&& isset($_POST['task_text'])) {
            $user_name = htmlspecialchars($_POST['username']);
            $user_email = htmlspecialchars($_POST['user_email']);
            
            //add validation forusername and email regex

            $task_text = htmlspecialchars($_POST['task_text']);
            if (!empty($user_name) && !empty($user_email) && !empty($task_text)) {
                $this->addTask($user_name, $user_email, $task_text);
            } else {
                echo "<script>alert(\"Fill all fields, please.\");</script>";
                header('Location: /');
            }
        }
    }

    function updateAction() {
        if (isset($_POST['submit_editing'])) {
            if (isset($_POST['new_text'])) {
                $id = intval($_POST['submit_editing']);
                $newText = htmlspecialchars($_POST['new_text']);
                // debug($_POST['new_text']);
                $this->changeTastText($id, $newText);
                header('Location: /');
            }
        }
    }

    function doneAction() {
        if (isset($_SESSION['user_loggued_in'])) {
            $id = intval($_POST['done']);
            $this->changeTaskStatus($id);
            header('Location: /');
        }

    }

    function loginAction() {
        $view = new View('login.php', NULL);
        // debug('');
        if (isset($_POST['login_try'])) {
            
			$username = $_POST['username'];
			$password = $_POST['passwd'];
			if ($username === 'admin') {
				if ($password === '123') {
                    $_SESSION['user_loggued_in'] = $username;
					header("Location: /");
				} else {
					echo "<script>alert(\"Invalid password. Try again.\");</script>";
				}				
			} else {
				echo "<script>alert(\"Invalid username. Try again.\");</script>";
			}
		}
    }

    public function logoutAction() {
        unset($_SESSION['user_loggued_in']);
        header('Location: /');
    }
}