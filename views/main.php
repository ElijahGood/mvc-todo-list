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
    
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    } else {
        $sort = 'ASC';
    }

    $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';

    echo '
        <div class="container">
            <h1>Task Manager</h1>
            <form class="add" action="add" method="post">
                <input type="text" name="username">
                <input type="text" name="user_email">
                <input type="text" name="task_text">
                <input type="submit" name="Add new task">
            </form>

            <div class="tableview" style="display: table;">
                    <div class="tableview-row" style="display:table-row;">
                        <div class="rTableHead" style="display: table-cell;">
                            <a href="index.php?page='.$_SESSION['current_page'].'&&order=checked&&sort='.$sort.'">Done</a>
                        </div>
                        <div class="rTableHead" style="display: table-cell;">
                            <a href="index.php?page='.$_SESSION['current_page'].'&&order=user_name&&sort='.$sort.'">Username</a>
                        </div>
                        <div class="rTableHead" style="display: table-cell;">
                            <a href="index.php?page='.$_SESSION['current_page'].'&&order=user_email&&sort='.$sort.'">Email</a>
                        </div>
                        <div class="rTableHead" style="display: table-cell;">
                            <span>Task to do</span>
                        </div>';
                        if (isset($_SESSION['user_loggued_in'])) {
                            echo '
                            <div class="rTableHead" style="display: table-cell;">
                                <span>Created</span>
                            </div>
                            <div class="rTableHead" style="display: table-cell;">
                                <span>Mark as done</span>
                            </div>';
                        } else {
                            echo '<div class="rTableHead" style="display: table-cell;">
                                <span>Created</span>
                            </div>';
                        }
                        
                    echo '</div>';
                $sum_pages = $_SESSION['total_num_of_tasks'];
                foreach ($mainData as $item) {
                    echo '

                    <div class="tableview-row" style="display:table-row;">
                        <div class="rTableCell" style="display: table-cell;">
                            '; if ($item['checked'] == 1){ echo "&#x2714";} else {echo "&#x2718";} echo '
                        </div>
                        <div class="rTableCell" style="display: table-cell;">'.$item['user_name'].'</div>
                        <div class="rTableCell" style="display: table-cell;">'.$item['user_email'].'</div>';
                        if (isset($_SESSION['user_loggued_in']) && $_SESSION['user_loggued_in'] === 'admin'){
                            echo '
                            <div class="rTableCell" style="display: table-cell;">
                                <form action="update" method="post">
                                    <textarea name="new_text" name="new_text">'.$item['task_text'].'</textarea>
                                    <button type="submit" name="submit_editing" value="'.$item['id'].'">Edit</button>
                                </form>  
                            </div>
                            <div class="rTableCell" style="display: table-cell;">
                                '.$item['date_time'].'
                            </div>
                            <div class="rTableCell" style="display: table-cell;">
                                <form action="done" method="post">
                                    <button type="submit" name="done" value="'.$item['id'].'">Mark as done</button>
                                </form>
                            </div>';
                        } else {
                            echo '
                            <div class="rTableCell" style="display: table-cell;">
                                '.$item['task_text'].'
                            </div>
                            <div class="rTableCell" style="display: table-cell;">
                                '.$item['date_time'].'
                            </div>';
                        }
                    echo '
                    </div>';
                }
                $num_of_pages = ceil($sum_pages / $num_of_items_per_page);

           echo'
           </div>';
            for ($page=1; $page<=$num_of_pages;$page++) {
                echo '<a href="index.php?page='. $page .'">'. $page .'</a>';
            }
        echo '</div>';

?>
	</div>
</body>