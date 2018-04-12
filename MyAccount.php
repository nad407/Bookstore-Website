<?php

session_start();

include 'Navigation.php';

if(isset($_SESSION['loggedIn'])){
    $loggedIn = $_SESSION['loggedIn'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Account </title>
        <link href="Background.css" rel="stylesheet" />
        <link href="Content/bootstrap.css" rel="stylesheet" />
        <link href="Content/Site.css" rel="stylesheet" />
    </head>
    <body>
        <div class="row"></div>
        <div class="row"></div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="panel-primary">
                <div class="panel-heading">
                    <h3 class = "panel-title text-center">Account Details</h3>
                </div>
                <div class="panel panel-body">
                    <p> Name: <?php echo htmlspecialchars($loggedIn['name']) ." ". htmlspecialchars($loggedIn['surname']);?> </p>
                    <p> Username: <?php echo htmlspecialchars($loggedIn['username']); ?> </p>
                    <p> Email: <?php echo htmlspecialchars($loggedIn['email']); ?> </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </body>
</html>

