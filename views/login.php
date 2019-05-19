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

        if (isset($_SESSION['user_loggued_in'])) {
            header('Location: /');
        } else {
            echo '
            <div class="main-container" style="text-align: center;height: 86vh;">
                <br>
                <span style="font-size:23px;">Log in action</span>
                <br>
                <br>
                <form name="login"  method="post" >
                    <div style="text-align: center;">Username:
                    <input type="text" name="username"></div>
                    <div style="text-align: center;">Password:
                    <input type="password" name="passwd"></div>
                    <br>
                    <div style="text-align: center;  font-weight: bold;">
                        <input type="submit" name="login_try" value="Sign in"/>
                    </div>
                </form>
            </div>';
        }
        ?>
        </div>
    </body>
</html>