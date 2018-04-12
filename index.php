<?php
//session_start();

//include 'database.php';
include 'Navigation.php';
include 'Search.php';



$bookID = null;
$bookName = null;
$bookAuthor = null;


try{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    printf("We had a problem: %s\n", $e->getMessage());
}

$sql= "SELECT id, name, author FROM Books";
$selectResults = $pdo->prepare($sql);
$selectResults->bindParam(':id', $bookID, PDO::PARAM_INT); 
$selectResults->bindParam(':name', $bookName, PDO::PARAM_STR);
$selectResults->bindParam(':author', $bookAuthor, PDO::PARAM_STR);
$selectResults->execute();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Book List</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, 
        initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="Content/bootstrap.css" rel="stylesheet" />
        <link href="Content/Site.css" rel="stylesheet" />
        <link href="Background.css" rel="stylesheet">
    </head>
    <body>
            <div class="col-sm-4 ">
                <div class="col-sm-12">
                    <div class="panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Search</h3>
                        </div>
                        <div class="panel panel-body">
                            <form method="POST" action="index.php">
                                <div class="form-group">
                                    <label class="control-label col-sm" for="titleSearch">Book Title: </label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" name="titleSearch">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm" for="authorSearch">Author: </label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" name="authorSearch">
                                    </div>
                                </div>
                                <input type="submit" name="search" value="Search">
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-left">
                <table class="table table-hover">
                        <?php
                        if($searchResults && $count>0){?>
                            <?php //unset($_SESSION['errMsg2']);?>
                            <thead>
                                <tr> 
                                    <th class="text-center"> Title </th>
                                    <th class="text-center"> Author </th>
                                    <th class="text-center"> Add to Wishlist </th>
                                </tr>
                            </thead>
                            <tbody>
                                <h3 class="text-center"><b>Search Results</b></h3>
                                <?php echo "We found $count matching book(s)<br><br>";?>
                                <?php while ($row = $searchResults->fetch(PDO::FETCH_ASSOC)) {?>
                                    <tr>
                                        <td><?php echo htmlentities($row['name']); ?></td>
                                        <td><?php echo htmlentities($row['author'])."<br>";?></td>
                                        <td>
                                            <a href="ReserveBooks.php?id=<?php echo $row['id']?>"><span class="glyphicon glyphicon-heart"></span></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody> 
                        <?php }else if(!$searchResults && $selectResults){?>
                            <thead>
                                    <tr> 
                                        <th class="text-center"> Book ID </th>
                                        <th class="text-center"> Title </th>
                                        <th class="text-center"> Author </th>
                                    </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = $selectResults->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td class="text-center"> <?php echo $row['id']; ?>
                                    <td class="text-center"> <?php echo htmlentities($row['name']); ?> 
                                    <td class="text-center"> <?php echo htmlentities($row['author'])."<br>";?>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
                <?php if ($searchResults && $count==0){ ?>
                    <div id="errMsg2"><br>
                    <?php if(!empty($_SESSION['errMsg2'])) { echo $_SESSION['errMsg2']; } ?>
                    </div> 
                    <br>
                    <a href="index.php">View all books</a>
                <?php } else if($searchResults && $count>0){ ?>
                    <br>
                    <a href="index.php">View all books</a>
                <?php } ?>
            </div>
            <div class="col-sm-4" style="position:fixed;right:20px;">
                <!-- <img src="images/book.gif" alt="book" style="width:300px;"> --> 
            </div>
        
    </body>
</html>
