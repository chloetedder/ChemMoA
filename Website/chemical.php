<?php
/*
 * Ezekiel Iyanobor
 */
require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);
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

<form method="POST">
        <input type="text" name="search" />
        <select name="table" id="table">
            <option selected value="default">Choose</option>
            <option value="name">Name</option>
            <option value="id">ID</option>
            <option value="smiles">SMILES</option>
        </select>
        <input type="submit" name="submit" value="Search" />
    </form>

<?php
    if(isset($_POST['submit'])){
            $dropdown = $_POST['table'];
            $connection = new PDO($dsn, $username, $password, $options);

            $search = $_POST['search'];
            if($dropdown == "name"){
                $esql = "SELECT * FROM chemical WHERE  Substance_Name LIKE '".$search."'";
                $statement1 = $connection->prepare($esql);
                $statement1->execute();
    
                $eresult = $statement1->fetchAll();
   

                
                    if ($eresult && $statement1->rowCount() > 0) 
                    { ?>
                        <h2>Chemical</h2>

                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID (Substance_CASRN)</th>
                                    <th>Structure_SMILES</th>
                                    <th>Structure_lnChl</th>
                                    <th>Structure_Formula</th>
                                    <th>Structure_MolWt</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php 
                        foreach ($eresult as $row) 
                        { ?>
                            <tr>
                                <td><?php echo escape($row["Substance_Name"]); ?></td>
                                <td><?php echo escape($row["Substance_CASRN"]); ?></td>
                                <td><?php echo escape($row["Structure_SMILES"]); ?></td>
                                <td><?php echo escape($row["Structure_lnChl"]); ?></td>
                                <td><?php echo escape($row["Structure_Formula"]); ?></td>
                                <td><?php echo escape($row["Structure_MolWt"]); ?></td>
                            </tr>
                        <?php 
                        } ?>
                        </tbody>
                    </table>
                    <?php
                    }
                }

                if($dropdown == "id"){
                    $esql = "SELECT * FROM chemical WHERE  Substance_CASRN LIKE '".$search."'";
                    $statement1 = $connection->prepare($esql);
                    $statement1->execute();
        
                    $eresult = $statement1->fetchAll();
       
    
                    
                        if ($eresult && $statement1->rowCount() > 0) 
                        { ?>
                            <h2>Chemical</h2>
    
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>ID (Substance_CASRN)</th>
                                        <th>Structure_SMILES</th>
                                        <th>Structure_lnChl</th>
                                        <th>Structure_Formula</th>
                                        <th>Structure_MolWt</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php 
                            foreach ($eresult as $row) 
                            { ?>
                                <tr>
                                    <td><?php echo escape($row["Substance_Name"]); ?></td>
                                    <td><?php echo escape($row["Substance_CASRN"]); ?></td>
                                    <td><?php echo escape($row["Structure_SMILES"]); ?></td>
                                    <td><?php echo escape($row["Structure_lnChl"]); ?></td>
                                    <td><?php echo escape($row["Structure_Formula"]); ?></td>
                                    <td><?php echo escape($row["Structure_MolWt"]); ?></td>
                                </tr>
                            <?php 
                            } ?>
                            </tbody>
                        </table>
                        <?php
                        }
                    }
                    if($dropdown == "smiles"){
                        $esql = "SELECT * FROM chemical WHERE  Structure_SMILES LIKE '%".$search."%'";
                        $statement1 = $connection->prepare($esql);
                        $statement1->execute();
            
                        $eresult = $statement1->fetchAll();
           
        
                        
                            if ($eresult && $statement1->rowCount() > 0) 
                            { ?>
                                <h2>Chemical</h2>
        
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>ID (Substance_CASRN)</th>
                                            <th>Structure_SMILES</th>
                                            <th>Structure_lnChl</th>
                                            <th>Structure_Formula</th>
                                            <th>Structure_MolWt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php 
                                foreach ($eresult as $row) 
                                { ?>
                                    <tr>
                                        <td><?php echo escape($row["Substance_Name"]); ?></td>
                                        <td><?php echo escape($row["Substance_CASRN"]); ?></td>
                                        <td><?php echo escape($row["Structure_SMILES"]); ?></td>
                                        <td><?php echo escape($row["Structure_lnChl"]); ?></td>
                                        <td><?php echo escape($row["Structure_Formula"]); ?></td>
                                        <td><?php echo escape($row["Structure_MolWt"]); ?></td>
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
                    

<div class="row main-row">
    <div class="8u">
        <section class="left-content">
             <h2><?php echo stripslashes($pageDetails["page_title"]); ?></h2>
            <?php echo stripslashes($pageDetails["page_desc"]); ?>
        </section>
    <head>
 <meta charset = "UTF-8">
 <title>chemical.php</title>
 <style type = "text/css">
  table, th, td {border: 1px solid black};
 </style>
 </head>
 <body>
 <p>
 <?php 
  try {
  $con= new PDO('mysql:host=localhost;dbname=chemtox', "root", "");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "SELECT * FROM chemical";
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
