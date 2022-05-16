<?php

include "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    
     <div class="container">
        <form action="search.php" method="GET" class="shadow-lg p-3">

            <div class="form-group">
            Recherche : <input id="name" name="name" type="text" class="form-control form-control-lg">
            </div>
            <br>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary" name="save">Rechercher</button> &nbsp;
            </div>
        </form>
     </div>
</body>
</html>