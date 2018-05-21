  	<?php
            $servername = "helios.vse.gmu.edu";
            $username = "eorella4";
            $password = "ydoogh";
            $dbName = "eorella4";

            $conn = new mysqli($servername, $username, $password, $dbName);

            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }
            // else echo "Connected successfully<br><br>";
        ?>

        
        <form class="example" action="customer.php" method="post" style="float:left;max-width:450px;">
            <input type="text" placeholder="Search.." name="search">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
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
        			$output = "<br><br><br><br>No Search Entered";
        		}
        		else{
        			if($count == 0){
        			$output = "<br><br><br><br>No Results";
        			}
        			else{
                        $output = "<br><br><br><br>";
        				while($row = mysqli_fetch_array($query)){
        					$id = $row['cust_id']; 
                            $fname = $row['cust_fname'];
        					$lname = $row['cust_lname'];
                            $email = $row['cust_email'];
        					
        			
        					$output .= '<div>'.$fname .' '.$lname . ' ' . $email .'</div>';
        				}
        			}
        		}
        	}
        	echo "$output";
        ?>