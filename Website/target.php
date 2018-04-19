<?php
/*
 *Ezekiel Iyanobor
 */

require("libs/config.php");
$page = easy_decrypt($_GET["id"]);
$pageDetails = getPageDetailsByName($page);
include("header.php");
?>
<?php
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing this page!";
  header("location: error.php");    
}
?>



<div class="row main-row">
    <div class="8u">
        <section class="left-content">
             <h2><?php echo stripslashes($pageDetails["page_title"]); ?></h2>
            <?php echo stripslashes($pageDetails["page_desc"]); ?>
        </section>
    <head>
 <meta charset = "UTF-8">
 <title>target.php</title>
 <style type = "text/css">
  table, th, td {border: 1px solid black};
 </style>
 </head>

<form method="POST">
        <input type="text" name="search" />
        <select name="table" id="table">
            <option selected value="default">Choose</option>
            <option value="name">Name</option>
            <option value="id">ID</option>
        </select>
        <input type="submit" name="submit" value="Search" />
    </form>


 <?php
    if(isset($_POST['submit'])){
            $dropdown = $_POST['table'];
            $connection = new PDO($dsn, $username, $password, $options);

            $search = $_POST['search'];
            if($dropdown == "name"){
                $esql = "SELECT * FROM target WHERE intended_target_official_full_name LIKE '%".$search."%'";
                $statement1 = $connection->prepare($esql);
                $statement1->execute();
    
                $tresult = $statement1->fetchAll();
   
				if ($tresult && $statement1->rowCount() > 0) 
				{ ?>
					<h2>Target</h2>

					<table>
						<thead>
							<tr>
								<th>Intended Target Official Full Name</th>
								<th>Intended Target Gene Name</th>
								<th>Intended Target Official Symbol</th>
								<th>Intended Target Gene Symbol</th>
								<th>Technological Target Official Full Name</th>
								<th>Technological Target Gene Name</th>
								<th>Technological Target Official Symbol</th>
								<th>Technological Target Gene Symbol</th>
							</tr>
						</thead>
						<tbody>
				<?php 
					foreach ($tresult as $row) 
					{ ?>
						<tr>
							<td><?php echo escape($row["intended_target_official_full_name"]); ?></td>
							<td><?php echo escape($row["intended_target_gene_name"]); ?></td>
							<td><?php echo escape($row["intedned_target_official_symbol"]); ?></td>
							<td><?php echo escape($row["intedned_target_gene_symbol"]); ?></td>
							<td><?php echo escape($row["technological_target_official_full_name"]); ?></td>
							<td><?php echo escape($row["technological_target_gene_name"]); ?></td>
							<td><?php echo escape($row["technological_target_official_symbol"]); ?></td>
							<td><?php echo escape($row["technological_target_gene_symbol"]); ?></td>
						</tr>
					<?php 
					} ?>
					</tbody>
				</table>
				<?php
				}
			}
			if($dropdown == "id"){
                $esql = "SELECT * FROM target WHERE target_id LIKE '".$search."'";
                $statement1 = $connection->prepare($esql);
                $statement1->execute();
    
                $tresult = $statement1->fetchAll();
   
				if ($tresult && $statement1->rowCount() > 0) 
				{ ?>
					<h2>Target</h2>

					<table>
						<thead>
							<tr>
								<th>Intended Target Official Full Name</th>
								<th>Intended Target Gene Name</th>
								<th>Intended Target Official Symbol</th>
								<th>Intended Target Gene Symbol</th>
								<th>Technological Target Official Full Name</th>
								<th>Technological Target Gene Name</th>
								<th>Technological Target Official Symbol</th>
								<th>Technological Target Gene Symbol</th>
							</tr>
						</thead>
						<tbody>
				<?php 
					foreach ($tresult as $row) 
					{ ?>
						<tr>
							<td><?php echo escape($row["intended_target_official_full_name"]); ?></td>
							<td><?php echo escape($row["intended_target_gene_name"]); ?></td>
							<td><?php echo escape($row["intedned_target_official_symbol"]); ?></td>
							<td><?php echo escape($row["intedned_target_gene_symbol"]); ?></td>
							<td><?php echo escape($row["technological_target_official_full_name"]); ?></td>
							<td><?php echo escape($row["technological_target_gene_name"]); ?></td>
							<td><?php echo escape($row["technological_target_official_symbol"]); ?></td>
							<td><?php echo escape($row["technological_target_gene_symbol"]); ?></td>
						</tr>
					<?php 
					} ?>
					</tbody>
				</table>
				<?php
				}
			}
		}
		?>
 <body>
 <p>
 <?php
  try {
  $con= new PDO('mysql:host=localhost;dbname=chemtox', "root", "");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "SELECT * FROM target";
  //first pass just gets the column names
  print "<table>";
  $result = $con->query($query);
  //return only the first row (we only need field names)
  $row = $result->fetch(PDO::FETCH_ASSOC);
  print " <tr>";
  foreach ($row as $field => $value){
   print " <th>$field</th>";
  } // end foreach
  print " </tr>";
  //second query gets the data
  $data = $con->query($query);
  $data->setFetchMode(PDO::FETCH_ASSOC);
  foreach($data as $row){
   print " <tr>";
   foreach ($row as $name=>$value){
   print " <td>$value</td>";
   } // end field loop
   print " </tr>";
  } // end record loop
  print "</table>";
  } catch(PDOException $e) {
   echo 'ERROR: ' . $e->getMessage();
  } // end try
 ?>
 </p>
 </body>
    </div>
  
</div>
<?php
include("footer.php");
?>
