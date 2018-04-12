<?php

session_start();

include 'Navigation.php';
//include 'Database.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Wish List</title>
        <link rel="stylesheet" href="Background.css"/>
    </head>
    <body>
        <?php
        $wishListBookId = urldecode($_GET['id']);

        if(isset($_SESSION['loggedIn'])){
            $loggedIn = $_SESSION ['loggedIn'];
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="INSERT into WISHLIST (membersId, booksId) values (?,?)";
            $userWishList = $pdo->prepare($sql);
            $userWishList->bindParam(':membersId', $loggedIn['id'] , PDO::PARAM_INT);
            $userWishList->bindParam(':booksId', $wishListBookId, PDO::PARAM_INT);
            $userWishList->execute(array($loggedIn['id'], $wishListBookId));
            Database::disconnect(); ?>
            <div class="row">
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo "You have added book $wishListBookId to your wish list.<br>"; ?>
                </div>
            </div>
            <?php
            $_GET=array(); //empty contents of GET
        }else{?>
            <div class="row">
                <div class="alert alert-warning fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <p> Kindly <a href="Login.php"> log in </a> or <a href="AddMember.php">sign up</a> to set up a wish list.</p>
                </div>
            </div>
        <?php }?>
    </body>
</html>


