<?php
/*
 * Ezekiel Iyanobor
 */
require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);
include("header.php");


?>
<?php
/* Displays all successful messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Success</title>
  <?php include 'css1/css.html'; ?>
</head>
<body>
<div class="form">
    <h1><?= 'Success'; ?></h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];    
    else:
        header( "location: index1.php" );
    endif;
    ?>
    </p>
    <a href="index1.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
