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
<div class="row main-row">
    <div class="8u">
        <section class="left-content">
            <h2><?php echo stripslashes($pageDetails["page_title"]); ?></h2>
            <?php echo stripslashes($pageDetails["page_desc"]); ?>
        </section>
    
    </div>
    
</div>
<?php
include("footer.php");
?>