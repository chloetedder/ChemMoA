<h2>Search</h2>
    <form method="POST">
        <input type="text" name="search" />
        <select name="table" id="table">
            <option selected value="all">All Tables</option>
            <option value="experiment">Experiment Table</option>
            <option value="target">Target Table</option>
            <option value="citation">Citation Table</option>
        </select>
        <input type="submit" name="searchSubmit" value="Search" />
    </form>


<?php
    if(isset($_POST['searchSubmit'])){
            $dropdown = $_POST['table'];
            $connection = new PDO($dsn, $username, $password, $options);

            $search = $_POST['search'];
            if($dropdown == "all"){
                $esql = "SELECT * FROM assay WHERE  aeid LIKE '%".$search."%'
                OR assay_source_name LIKE '%".$search."%'
                OR assay_source_long_name LIKE '%".$search."%'
                OR assay_name LIKE '%".$search."%'
                OR organism LIKE '%".$search."%'
                OR tissue LIKE '%".$search."%'
                ";
                $statement1 = $connection->prepare($esql);
                $statement1->execute();
    
                $eresult = $statement1->fetchAll();
   

                $tsql = "SELECT * FROM target WHERE
                intended_target_official_full_name LIKE '%".$search."%'
                OR intended_target_gene_name LIKE '%".$search."%'
                OR intended_target_official_symbol LIKE '%".$search."%'
                OR intended_target_gene_symbol LIKE '%".$search."%'
                OR technological_target_official_full_name LIKE '%".$search."%'
                OR technological_target_gene_name LIKE '%".$search."%'
                OR technological_target_official_symbol LIKE '%".$search."%'
                OR technological_target_gene_symbol LIKE '%".$search."%'
                ";
                
                $statement2 = $connection->prepare($tsql);
                $statement2->execute();
    
                $tresult = $statement2->fetchAll();

                $csql = "SELECT * FROM citation WHERE
                pmid LIKE '%".$search."%'
                OR doi LIKE '%".$search."%'
                OR title LIKE '%".$search."%'
                OR author LIKE '%".$search."%'
                ";
                
                $statement3 = $connection->prepare($csql);
                $statement3->execute();
    
                $cresult = $statement3->fetchAll();
                
                    //need to look at code to see if need to have bindparm of results
                    
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
            
            
        if($dropdown == "experiment"){
            $esql = "SELECT * FROM assay WHERE  aeid LIKE '%".$search."%'
                OR assay_source_name LIKE '%".$search."%'
                OR assay_source_long_name LIKE '%".$search."%'
                OR assay_name LIKE '%".$search."%'
                OR organism LIKE '%".$search."%'
                OR tissue LIKE '%".$search."%'
                ";
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
            
                    
            

        if($dropdown == "target"){
            $tsql = "SELECT * FROM target WHERE
            intended_target_official_full_name LIKE '%".$search."%'
            OR intended_target_gene_name LIKE '%".$search."%'
            OR intended_target_official_symbol LIKE '%".$search."%'
            OR intended_target_gene_symbol LIKE '%".$search."%'
            OR technological_target_official_full_name LIKE '%".$search."%'
            OR technological_target_gene_name LIKE '%".$search."%'
            OR technological_target_official_symbol LIKE '%".$search."%'
            OR technological_target_gene_symbol LIKE '%".$search."%'
            ";
            
            $statement2 = $connection->prepare($tsql);
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
            
        if($dropdown == "citation"){
            $csql = "SELECT * FROM citation WHERE
            pmid LIKE '%".$search."%'
            OR doi LIKE '%".$search."%'
            OR title LIKE '%".$search."%'
            OR author LIKE '%".$search."%'
            ";
            
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
    else{
            echo "<p>Please enter a search query</p>";
        }
?>
