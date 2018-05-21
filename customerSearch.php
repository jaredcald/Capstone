<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    	<?php
            $servername = "helios.vse.gmu.edu";
            $username = "jcaldwe4";
            $password = "psitow";
            $dbName = "jcaldwe4";

            $conn = new mysqli($servername, $username, $password, $dbName);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            else echo "Connected successfully<br><br>";
        ?>

        <form action="customerSearch.php" method="post">
            Search: <input type="text" name="search" placeholder ="Search for Customer...">
        <input type="submit" value ="Search">
        </form>
        
        <?php  
            $output = "";
        	
        	// collect
        	if(isset($_POST['search'])){
        		$searchq = $_POST['search'];
        		$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
        		$sql = "SELECT * FROM Customer WHERE cust_fname LIKE '%$searchq%' OR cust_lname LIKE '%$searchq%'";
        		$query = mysqli_query($conn, $sql);
        		$count = mysqli_num_rows($query);
        		if($searchq == ""){
        			$output = "No Search Entered";
        		}
        		else{
        			if($count == 0){
        			$output = "No Results";
        			}
        			else{
        				while($row = mysqli_fetch_array($query)){
        					$fname = $row['cust_fname'];
        					$lname = $row['cust_lname'];
        					$id = $row['cust_id']; 
        			
        					$output .= '<div>'.$fname.'  '.$lname.'</div>';
        				}
        			}
        		}
        	}
        	echo "$output";
        ?>
    </body>
</html>
