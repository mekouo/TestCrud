<?php 
include "config.php";

// if the form's update button is clicked, we need to process the form
	if (isset($_POST['update'])) {
		$firstname = $_POST['name'];
		$user_id = $_POST['user_id'];
		$lastname = $_POST['prenom'];
		

		// write the update query
		$sql = "UPDATE `contact` SET `firstname`='$firstname',`prenom`='$lastname' WHERE `id`='$user_id'";

		// execute the query
		$result = $conn->query($sql);

		if ($result == TRUE) {
			echo "Record updated successfully.";
		}else{
			echo "Error:" . $sql . "<br>" . $conn->error;
		}
	}


// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id'])) {
	$user_id = $_GET['id'];

	// write SQL to get user data
	$sql = "SELECT * FROM `contact` WHERE `id`='$user_id'";

	//Execute the sql
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		
		while ($row = $result->fetch_assoc()) {
			$first_name = $row['nom'];
			$lastname = $row['prenom'];
			$id = $row['id'];
		}

	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/bootstrap-4.5.0-dist/css/bootstrap.css">
</head>
<body>
		<h2>Modifier le Contact </h2>
		<form action="" method="POST">
		  <fieldset>
		    <legend>Informations personnelles:</legend>
		    Nom:<br>
		    <input type="text" name="name" value="<?php echo $first_name; ?>">
		    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
		    <br>
		    Prenom:<br>
		    <input type="text" name="prenom" value="<?php echo $lastname; ?>">
		    <br>
		   
		    <input type="submit" value="Update" name="update">
		  </fieldset>
		</form>

		</body>
		</html>




	<?php
	} else{
		// If the 'id' value is not valid, redirect the user back to view.php page
		header('Location: view.php');
	}

}
?>