<?php

define('ROOT', dirname(__FILE__));

// include('./views/header.php');

require_once(ROOT.'/Debug.php');
require_once(ROOT.'/Model.php');
require_once(ROOT.'/Controller.php');

session_start();

// $model = new Model();
$controller = new Controller();
// $model->addTask('user123', 'user123@gmail.com', 'Dont forget to eat your lunch!');

//mini-router
$request = $_SERVER['REQUEST_URI'];
if ($request == '/') {
    $controller->getAllTasks(0);
} else if ($request == '/index.php') {
    $controller->addAction();
    // debug($_SERVER['REQUEST_URI']);
} else if ($request == '/index.php?page=*') {
    $page = $_GET['page'];
    $controller->getAllTasks($page);
} else {
    debug($request);
    header('Location: ./views/404.php');
}
