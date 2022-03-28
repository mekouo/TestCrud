<?php 
include "config.php";

//write the query to get data from users table

$sql = "SELECT * FROM contact";

//execute the query

$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
	<title>View Page</title>
	 <!-- to make it looking good im using bootstrap -->
	 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">



<script type="text/javascript">

function testConfirmDialog()  {

     
           if (confirm("voulez-vous continuer?")) {
                return true;
             } else {
                  return false; 
                } 
            }


</script>




</head>
<body>
	<div class="container">
		<h2>Contacts</h2>
<table class="table">
	<thead>
		<tr>
		<th>ID</th>
		<th>Nom</th>
		<th>Prenom</th>
	
	</tr>
	</thead>
	<tbody>	
		<?php
			if ($result->num_rows > 0) {
				//output data of each row
				while ($row = $result->fetch_assoc()) {
		?>

					<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['nom']; ?></td>
					<td><?php echo $row['prenom']; ?></td>				
					<td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
					<a onclick="testConfirmDialog()" class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
					</tr>	
					
		<?php		}
			}
		?>
	        	
	</tbody>
</table>
	</div>

  



   </body>
</html>