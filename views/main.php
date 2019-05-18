<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/product/">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title></title>
</head>
<body>
	<div>

<?php

    include(ROOT.'/views/header.php');

    $num_of_items_per_page = 3;
    
    echo '
        <div class="container">
            <h1>Task Manager</h1>
            <form class="add_item" action="index.php" method="post">
                <input type="text" name="username">
                <input type="text" name="user_email">
                <input type="text" name="task_text">
                <input type="submit" name="Add new task">
            <form>
            <table>
                <thead>
                    <tr>
                        <th>Done</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Task to do</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>';
                $sum_pages = 0;
                foreach ($mainData as $item) {
                    echo '
                    
                    <tr>
                        <td>'.$item['checked'].'</td>
                        <td>'.$item['user_name'].'</td>
                        <td>'.$item['user_email'].'</td>
                        <td>'.$item['task_text'].'</td>
                        <td>'.$item['date_time'].'</td>
                        
                    </tr>';
                    $sum_pages++;
                }
                $num_of_pages = ceil($sum_pages / $num_of_items_per_page);

           echo' </tbody>
           </table>';
            for ($page=1; $page<=$num_of_pages;$page++) {
                echo '<a href="index.php?page='. $page .'">'. $page .'</a>';
            }
        echo '</div>';
    // foreach ($tasksArray as item) {
    //     ;
    // }

?>
	</div>
</body>