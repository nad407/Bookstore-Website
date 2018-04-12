<?php
session_start();

include 'Navigation.php';
//require 'database.php';

$errorMsg=null;

if(isset($_POST['login'])){
    if(empty($_POST['username'])|| empty($_POST['pw'])){
        $_SESSION['errMsg']="Username or Password not specified.";
    }else{
        $loginUsername= $_POST['username'];
        $loginPassword= $_POST['pw'];
        $hashLoginPw = password_hash($loginPassword, PASSWORD_DEFAULT);

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * from Members where username LIKE :loginUsername";
        $userResults = $pdo->prepare($sql);
        $userResults->bindParam(':loginUsername', $loginUsername, PDO::PARAM_STR);
        $userResults->execute();
        $count = $userResults->rowCount();
        
        if($count==1){
            $row=$userResults->fetch(PDO::FETCH_ASSOC);
            if(password_verify($loginPassword,$row['password'])){
                    $_SESSION['loggedIn']=$row;
                    header("location:index.php");
            }else{
                    $errorMsg="Wrong Password";
            }
        }else if($count==0){
            $errorMsg="Username not found";
        }      
    }      
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log in</title>
        <link href="Content/bootstrap.css" rel="stylesheet" />
        <link href="Content/Site.css" rel="stylesheet" />
        <link href="Background.css" rel="stylesheet" />
    </head>
    <body>
        <?php if (isset($errorMsg)){?>
        <div class="row">
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $errorMsg; ?>
            </div>
        </div>
        <?php unset($errorMsg); } ?>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel-primary">
                    <div class="panel-heading text-center">Log In</div>
                    <div class="panel panel-body">
                        <form class="form-horizontal" method="POST" action="Login.php">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="username">Username: </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="password">Password: </label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="pw" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <input type="submit" class="btn btn-info" name="login" value="Login">
                                </div>
                                <div class="col-sm-4"></div>
                            </div>
                        </form>
                        <?php 
                        if (!empty($_SESSION['errMsg'])){
                            echo $_SESSION['errMsg'];
                        }
                        unset($_SESSION['errMsg']);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>    
    </body>
</html>

