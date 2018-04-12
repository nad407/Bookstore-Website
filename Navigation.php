<?php
    require 'database.php';
    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Library</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" >
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">LIBRARY</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Our Books</a></li>
                  <li><a href="ContactUs.php">Contact Us</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right"> 
                <?php if(isset($_SESSION['loggedIn'])){
                    $loggedIn=$_SESSION['loggedIn'];
                    
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    $query="SELECT username FROM Members WHERE id LIKE :id";
                    $loggedInUsername = $pdo->prepare($query);
                    $loggedInUsername ->bindParam(':id', $loggedIn['id'], PDO::PARAM_INT);
                    $loggedInUsername ->execute();
                    $row=$loggedInUsername->fetch(PDO::FETCH_ASSOC);
                    $username=$row['username'];
                    
                    Database::disconnect();
                ?>
                    
                   
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php echo "Welcome $username "; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li> <a class="dropdown-item" href="MyAccount.php">My Account</a></li>
                                <li> <a class="dropdown-item" href="MyWishlist.php">My Wishlist</a></li>
                            </ul>
                    </li>
                    
                    <li><a href="LogOut.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
                <?php }else { ?>  
                  <li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
                  <li><a href="AddMember.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <?php } ?>
                </ul>
            </div>
        </nav>
    </body>
</html>

