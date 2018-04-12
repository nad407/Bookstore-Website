<?php

    session_start();

    include 'Navigation.php';
    
    $firstName=null;
    $lastName=null;
    $email=null;
    $message=null;
    $submit=false;
    $reply=false;
   
    
    if(isset ($_POST['submit'])){
        $firstName= htmlspecialchars($_POST['firstname']);
        $lastName= htmlspecialchars($_POST['lastname']);
        $email= htmlspecialchars($_POST['email']);
        $message= htmlspecialchars($_POST['message']);
        $details="$firstName $lastName ($email) has sent the following message: \" $message \" ";
        if(isset ($_POST['reply'])){
           $details .= "A reply was requested";
        }else{
            $details .= "A reply was NOT requested";
        }
        printf("%s %s, your message has been submitted! <br>", $firstName, $lastName);
        
        printf("Here is a copy of your sent message:<br><br>%s", $details);
        
    }   
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contact Us</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, 
        initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="Content/bootstrap.css" rel="stylesheet" />
        <link href="Content/Site.css" rel="stylesheet" />
        <link href="Background.css" rel="stylesheet" />
    </head>
    <body>
        <div class="row"></div>
        <div class="row">
            <div class="col-sm-4 text-center"></div>
            <div class="col-sm-4 text-center">
                
                <div class="ml-3 panel-primary">
                    <div class = "panel-heading">
                        <h3 class = "panel-title">Contact Us</h3>
                    </div>  
                    <div class=" panel panel-body">
                        <form class="form-horizontal" method="POST" action="ContactUs.php">
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
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="message">Message: </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="message" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="reply">Would you like a reply? </label>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="form-control" name="reply">
                                </div>
                            </div>
                            
                            <input type="submit" class="btn btn-info" name="submit" value="Submit">
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center"></div>
        </div>
    </body>
</html>
