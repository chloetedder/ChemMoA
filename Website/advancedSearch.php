<?php

require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);
include("header.php");


?>


     <form method="POST">
        <select id="table2" name="table2">
            <option value="default">Choose Table</option>
            <option value="experiment">Experiment Table</option>
            <option value="target">Target Table</option>
            <option value="citation">Citation Table</option>
        </select>
        <input type="submit" name="submit" value="AdvancedSearch" />
         <div id="experiment">
        <span>ID<input name="id" type="text"/></span>
        <span>Name<input name="name" type="text"/></span>
        <span>Organism<input name="organism" type="text"/></span>
        <span>Tissue<input name="tissue" type="text"/></span>
             </div>
        
         <div id="target">
         <span name="targetN">Name<input name="targetName" type="text"/></span>
             </div>
         
        <div id="citation">
        <span>Pmid<input name="pmid" type="text"/></span>
        <span>Doi<input name="doi" type="text"/></span>
        <span>Title<input name="title" type="text"/></span>
        <span>Author<input name="author" type="text"/></span>
         </div>
    </form>
    
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            function showTab(name){
                let newname = "#" + name;
                let names = ["default","experiment","citation","target"];
                for(let x = 0; x < names.length; x++){
                    if(name == names[x]){
                        $(newname).show();
                    }
                    else{
                        let temp = "#" + names[x];
                        $(temp).hide();
                    }
                }
            }
            
            $('#table2').change(function(){
                showTab($(this).val());
            });
            $('#experiment').hide();
            $('#target').hide();
            $('#citation').hide();
            showTab($('#table2').val());
        });
        
    
    </script>
    
   

<?php
    if(isset($_POST['submit'])){
        $selected_val = $_POST['table2'];
        $connection = new PDO($dsn, $username, $password, $options);

        if($selected_val == "experiment"){
           

            $name = $_POST['name'];
            $organism = $_POST['organism'];
            $id = $_POST['id'];
            $tissue = $_POST['tissue'];
            $esql = "SELECT * FROM assay WHERE 
            (assay_source_name LIKE '%".$name."%' 
            OR assay_source_long_name LIKE '%".$name."%' 
            OR assay_name LIKE '".$name."%') AND (tissue LIKE '".$tissue."%') AND 
            (organism LIKE '".$organism."%') AND (aeid LIKE '".$id."%')";

            $statement1 = $connection->prepare($esql);
            $statement1->execute();
    
            $eresult = $statement1->fetchAll();
                           
            if ($eresult && $statement1->rowCount() > 0) 
                    { ?>
                        <h2>Experiment</h2>

                        <table>
                            <thead>
                                <tr>
                                    <th>Aeid</th>
                                    <th>Assay Source Name</th>
                                    <th>Assay Source Long Name</th>
                                    <th>Assay Name</th>
                                    <th>Organism</th>
                                    <th>Tissue</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php 
                        foreach ($eresult as $row) 
                        { ?>
                            <tr>
                                <td><?php echo escape($row["aeid"]); ?></td>
                                <td><?php echo escape($row["assay_source_name"]); ?></td>
                                <td><?php echo escape($row["assay_source_long_name"]); ?></td>
                                <td><?php echo escape($row["assay_name"]); ?></td>
                                <td><?php echo escape($row["organism"]); ?></td>
                                <td><?php echo escape($row["tissue"]); ?></td>
                            </tr>
                        <?php 
                        } ?>
                        </tbody>
                    </table>
                    <?php
                    }
                    
        }
        if($selected_val == "target"){
            $targetName = $_POST['targetName'];
            if(!(empty($targetName))){
                $tsql = "SELECT * FROM target WHERE intended_target_official_full_name LIKE '%".$targetName."%'
                OR intended_target_gene_name LIKE '%".$targetName."%'
                OR intended_target_official_symbol LIKE '%".$targetName."%'
                OR intedned_target_gene_symbol LIKE '%".$targetName."%'
                OR technological_target_official_full_name LIKE '%".$targetName."%'
                OR technological_target_gene_name LIKE '%".$targetName."%'
                OR technological_target_official_symbol LIKE '%".$targetName."%'
                OR technological_target_gene_symbol LIKE '%".$targetName."%'";
            }
            $statement2 = $connection->prepare($tsql);
            $statement2->bindParam(':targetName', $targetName, PDO::PARAM_STR);
            $statement2->execute();
    
            $tresult = $statement2->fetchAll();            
            if ($tresult && $statement2->rowCount() > 0) 
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
        
        if($selected_val == "citation"){
           
            $pmid = $_POST['pmid'];
            $doi = $_POST['doi'];
            $title = $_POST['title'];
            $author = $_POST['author'];

            $csql = "SELECT * FROM citation WHERE 
            (pmid LIKE '%".$pmid."%') AND 
            (doi LIKE '%".$doi."%') AND
            (title LIKE '%".$title."%') AND 
            (author LIKE '%".$author."%')";

            $statement3 = $connection->prepare($csql);
            $statement3->execute();

            $cresult = $statement3->fetchAll();
            
             if ($cresult && $statement3->rowCount() > 0) 
                    { ?>
                        <h2>Citation</h2>

                        <table>
                            <thead>
                                <tr>
                                    <th>Pmid</th>
                                    <th>Doi</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php 
                        foreach ($cresult as $row) 
                        { ?>
                            <tr>
                                <td><?php echo escape($row["pmid"]); ?></td>
                                <td><?php echo escape($row["doi"]); ?></td>
                                <td><?php echo escape($row["title"]); ?></td>
                                <td><?php echo escape($row["author"]); ?></td>
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
<?php
include("footer.php");
?>