<?php

session_start();

include 'Navigation.php';

$_SESSION=array();
session_destroy();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log Out</title>
        <link href="Content/bootstrap.css" rel="stylesheet" />
        <link href="Content/Site.css" rel="stylesheet" />
        <link rel="stylesheet" href="Background.css"/>
    </head>
    <body>
        <div class="row">
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php echo "You have been logged out. Go back to "; ?>
                <a href="index.php">Homepage</a>
            </div>
        </div>
    </body>
</html>

