<?php

/**
 * Use an HTML form to create a new entry in the
 * target table.
 *
 */
require("libs/config.php");
$page = easy_decrypt($_GET["id"]);
$pageDetails = getPageDetailsByName($page);
include("header.php");


if (isset($_POST['submit']))
{
	

	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_target = array(
			"aeid" => $_POST['aeid'],
			"target_id"  => $_POST['target_id'],
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"target",
				implode(", ", array_keys($new_target)),
				":" . implode(", :", array_keys($new_target))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_target);
	}

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
	<blockquote><?php echo $_POST['target_id']; ?> successfully added.</blockquote>
<?php 
} ?>

<h2>Add a Target</h2>

<form method="post">
	<label for="aeid">AEID</label>
	<input type="text" name="aeid" id="aeid">
	<label for="target_id">Target_ID</label>
	<input type="text" name="target_id" id="target_id">
	<input type="submit" name="submit" value="Submit">
</form>


