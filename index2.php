<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body, html {
    height: 100%;
    margin: 0;
}

.bg {
    /* The image used */
    background-image: url("images/books.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;  
    position:relative;
}
/* Centered text */
.title {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 50px;
    font-family: 'Poppins', sans-serif;
    font-family: 'Indie Flower', cursive
    
}

.banner{
    background:black;
    width:100%;
    height: 15%;
    postion:absolute;
    margin-top: auto;
    margin-bottom: auto;
}
    
a{
    text-decoration: none;
    color: white
}
</style>
</head>
<body>        
    
    <div class="bg" ></div>
    <div class="banner" ></div>
    <div class="title"><a href="BookList.php">Welcome to the Library</a></div>

</body>
</html>


