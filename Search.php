<?php  
    
    $titleSearch=null;
    $bookID=null;
    $authorSearch=null;
    $searchResults=false;
    
    if(isset($_POST['search'])){
        if(empty($_POST['titleSearch'])&& empty($_POST['authorSearch'])){ 
            
            $_SESSION['errMsg1']="Please enter a book title and/or author title.";
                
        }else{
            
            $titleSearch= trim($_POST['titleSearch']);
            $authorSearch=trim($_POST['authorSearch']);
            
            try{
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                printf("We had a problem: %s\n", $e->getMessage());
            }

            $query= "SELECT * FROM Books WHERE";
            
            if(!empty($_POST['titleSearch'])&& empty($_POST['authorSearch'])){
                $query .= " name LIKE :name";
                $searchResults = $pdo->prepare($query);
                $titleSearch="%".$titleSearch."%";
                $searchResults->bindParam(':name', $titleSearch, PDO::PARAM_STR);
               
            }
            
            if(empty($_POST['titleSearch'])&& !empty($_POST['authorSearch'])){
                $query .= " author LIKE :author";
                $searchResults = $pdo->prepare($query);
                $authorSearch="%".$authorSearch."%";
                $searchResults->bindParam(':author', $authorSearch, PDO::PARAM_STR);
            }
            
            if(!empty($_POST['titleSearch'])&& !empty($_POST['authorSearch'])){
                $query .= " name LIKE :name AND author LIKE :author";
                $searchResults = $pdo->prepare($query);
                $titleSearch="%".$titleSearch."%";
                $authorSearch="%".$authorSearch."%";
                $searchResults->bindParam(':name', $titleSearch, PDO::PARAM_STR);
                $searchResults->bindParam(':author', $authorSearch, PDO::PARAM_STR);
            }  
            
            $searchResults->execute();
            $count = $searchResults->rowCount();
            if($count==0){
                $_SESSION['errMsg2']="Sorry, no results were found.";
            }
           
        }
            
    }
?>