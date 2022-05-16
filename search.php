<?php
session_start();
include "config.php";
if (!isset($_SESSION['id'])) {
    header('Location: /');
    exit;
}

$afficher_profil = $conn->query("SELECT * 
FROM contact
 WHERE id <> ?",
array($_SESSION['id'])); 
$afficher_profil = $afficher_profil->fetchAll();


/*ORDER BY id DESC");
if (isset($_GET['s']) AND !empty($_GET['s'])) {
    $recherche=htmlspecialchars($_GET['s']);
    $allusers= $conn->query('SELECT nom FROM contact WHERE nom LIKE "%'.$recherche.'%" ORDER BY id DESC ');
    $allusers= $allusers->fetch_all();
}*/

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
        <form action="" method="GET" class="shadow-lg p-3">

            <div class="form-group">
             Recherche : <input id="s" name="s" type="search" class="form-control form-control-lg" placeholder="Rechercher un utilisateur">
                
            </div>
            <br>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary" name="save">Rechercher</button> &nbsp;
            </div>
        </form>
     </div>
     <div>
         <section class="afficher_utilisateur">
            <?php
                if (count($allusers)> 0) {
                   while ($user =  $allusers->fetch()) {
                       ?>
                       <p><?= $user['nom'];?> </p>
                       <?php                      
                   }           
                }else {
                    ?>
                    <p>Aucun utilisateur trouvé</p>
                    <?php
                }
            
            ?>
         </section>
     </div>
</body>
</html>