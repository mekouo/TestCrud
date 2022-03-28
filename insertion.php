<?php 
include "config.php";

// if the form's submit button is clicked, we need to process the form
	if (isset($_POST['save'])) {
		// get variables from the form
		$first_name = $_POST['name'];
		$last_name = $_POST['prenom'];
		

		//write sql query

		$sql = "INSERT INTO `contact`(`nom`, `prenom`) VALUES ('$first_name','$last_name')";

		// execute the query

		$result = $conn->query($sql);

		if ($result == TRUE) {
			echo "New record created successfully.";
		}else{
			echo "Error:". $sql . "<br>". $conn->error;
		}

		$conn->close();

	}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Formulaire d'enregistrement de Contact</h1>
        <form action="" method="POST" class="shadow-lg p-3">

            <div class="form-group">
                <label for="name">Nom :</label>
                <input id="name" name="name" type="text" class="form-control form-control-lg">
            </div>
            <br>
            <div class="form-group">
                <label for="prenom">Prenom :</label>
                <input id="prenom" name="prenom" type="text" class="form-control form-control-lg">
            </div>
            <br>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary" name="save">Enregistrer</button> &nbsp;
                <a href="./view.php">Liste des contacts</a>
               
            </div>

        </form>
    </div>
</body>
</html>