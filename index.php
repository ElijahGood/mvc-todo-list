<?php
/* m!W#YuuXHuh5uc4UicFw */
define('ROOT', dirname(__FILE__));

chmod("/dayside/index.php", 0755);

require_once(ROOT.'/Debug.php');
require_once(ROOT.'/mvc/Model.php');
require_once(ROOT.'/mvc/Controller.php');

session_start();

// $model = new Model();
$controller = new Controller();

//mini-router
$request = $_SERVER['REQUEST_URI'];
if ($request == '/') {
    $_SESSION['current_page'] = 1;
    $controller->getAllTasks(0);
} else if ($request == '/add') {
    $controller->addAction();
} else if ($request == '/login') {
    $controller->loginAction();
} else if ($request == '/logout') {
    $controller->logoutAction();
} else if ($request == '/done') {
    $controller->doneAction();
} else if ($request == '/update') {
    $controller->updateAction();
}
/*
else if ($request == '/dayside/index.php') {
    header('Location /dayside/index.php');
} */

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
    $_SESSION['current_page'] = $page;
    $controller->getAllTasks(($page - 1) * 3);
}

?>