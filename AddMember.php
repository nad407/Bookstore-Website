<?php
    //require 'database.php';
    include 'Navigation.php';

    $firstName = null;
    $lastName = null;
    $email = null;
    $username=null;
    $pw = null;
    $reEnterPw = null;
    $tc = false;
    $submit = false;
    $errorMsg=null;
    $matchingPWs=false;
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if(isset($_POST['submit'])){
        if($_POST['pw']===$_POST['re-enterPW']){
            $matchingPWs = true;
            $pw = $_POST['pw'];
            $hashedPW = password_hash($pw, PASSWORD_DEFAULT);
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg = "Invalid email format."; 
            }else{
                $firstName = $_POST['firstname'];
                $lastName = $_POST['lastname'];
                $username = $_POST['username'];
                
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //check if username already exists
                $query1 = "SELECT * FROM Members WHERE username LIKE :username";
                $checkUsername = $pdo->prepare($query1);
                $checkUsername ->bindParam(':username', $username, PDO::PARAM_STR);
                $checkUsername ->execute();
                $count = $checkUsername->rowCount();
                if($count>0){
                    $errorMsg = "Username already exists.";
                    Database::disconnect();
                }else{               
                    $query2 = "INSERT INTO Members (name, surname, email, username, password) values(?, ?, ?, ?, ?)";
                    $query2 = $pdo->prepare($query2);
                    $query2->execute(array($firstName, $lastName, $email, $username, $hashedPW));
                    Database::disconnect();
                    header("Location: Login.php");
                }
            }
        }else{
            $matchingPWs = false;
            $errorMsg = "Passwords do not match.";
        }       
    }    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Member</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, 
        initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="Content/bootstrap.css" rel="stylesheet" />
        <link href="Content/Site.css" rel="stylesheet" />
        <link href="Background.css" rel="stylesheet" />
    </head>
    <body>
        <!--Displaying error message when adding a new member has failed-->
        <?php if(isset($errorMsg)){ ?>
        <div class="row>">
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $errorMsg ?>
            </div>
        </div>
        <?php unset($errorMsg); }?>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel-primary">
                    <div class = "panel-heading">
                        <h3 class = "panel-title text-center">Enter your details</h3>
                    </div>
                    <div class="panel panel-body">
                        <form class="form-horizontal" action="AddMember.php" method="POST">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="firstname">First Name: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="firstname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="lastname">Last Name: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="lastname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="email">Email: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="username">Username: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="pw">Password: </label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="pw" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="re-enterPW">Re-Enter Password: </label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="re-enterPW" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="tc">I accept the terms and conditions</label>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="form-control" name="tc" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <input type="submit" class="btn btn-info" name="submit" value="Submit">
                                </div>
                                <div class="col-sm-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>    
    </body>
</html>
    
