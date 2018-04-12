<?php

session_start();

include 'Navigation.php';

if(isset($_SESSION['loggedIn'])){
    $loggedIn=$_SESSION['loggedIn'];
}

$pdo= Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql="SELECT Books.name, Books.author FROM Books
      JOIN WishList ON Books.id=WishList.booksId
      WHERE WishList.membersId = :membersId";
$userWishList = $pdo->prepare($sql);
$userWishList->bindParam(':membersId', $loggedIn['id'] , PDO::PARAM_INT);
$userWishList->execute();
Database::disconnect();
$count = $userWishList->rowcount();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Wishlist</title>
        <link href="Content/bootstrap.css" rel="stylesheet" />
        <link href="Content/Site.css" rel="stylesheet" />
        <link rel="stylesheet" href="Background.css"/>
    </head>
    <body>
        <div class="row"></div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel panel-basic">
                    <?php echo"You have $count books in your wishlist.";?>
                </div>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($count>0){
                        foreach($userWishList as $wish): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($wish['name']); ?></td>
                            <td><?php echo htmlspecialchars($wish['author']); ?></td>
                        </tr>
                        <?php endforeach;
                    }             
                    if($count==0){
                        echo "Wishlist is empty.";
                    }
                    ?>
                    </tbody>
                </table>    
            </div>        
            <div class="col-sm-4"></div>
        </div>
    </body>
</html>