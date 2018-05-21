<!DOCTYPE html>
<html lang="en">
<head>
  <title>Creation Center</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/proposalviews.css" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php
  include "menu.php";
?>

<br>

<div class="container-fluid">
    <table style="overflow:auto;">
    <tr>
    <th style="float:right;border-bottom:none;">
        <form method="post" action="editcustomer.php">
        <button class="btn btn-primary" type="submit" name="submit">Edit Customer</button>
        <input type="hidden" name="edit" value="<?php $_POST['search']?>"/>
        </form>
      	
    </th>
    <th style="float:right;border-bottom:none;">
      	<form method="post" action="addproposals.php">
        <button class="btn btn-primary" type="submit" name="submit">Create Proposals</button>
        <input type="hidden" name="add" value="<?php $_POST['search']?>"/>
    	</form>
    </th>
    
    </tr>
  </table>
</div>




<table id="myTable2">
	<tr>
	<th>Proposal #</th>     
	<th>Start Date</th>
	<th>Amount</th>
	</tr>
        
<?php  
	//$result = "";
//<button class="btn btn-primary" type="button"><a href="addproposal.php">Add Proposal</a></button>
//<button class="btn btn-primary" type="button"><a href="editcustomer.php">Edit Customer</a></button>
	$name = "";
	$servername = "helios.vse.gmu.edu";
	$username = "eorella4";
	$password = "ydoogh";
	$dbName = "eorella4";
	$conn = new mysqli($servername, $username, $password, $dbName);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if(isset($_POST['submit'])) {
			$search = $_POST['search'];
			$search = preg_replace("#[^0-9a-z]#i","",$search);
			$sql = "SELECT Proposal.prop_id, prop_start, cust_fname, cust_lname, proj_cost FROM Proposal JOIN Customer ON Proposal.cust_id = Customer.cust_id INNER JOIN Joblist ON Proposal.prop_id = Joblist.prop_id JOIN Project ON Project.proj_id = Joblist.proj_id WHERE Customer.cust_id LIKE '%$search%' ORDER BY prop_start ASC, cust_fname;";
			$query = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($query);

			while($row = mysqli_fetch_array($query)) 
			{
				
				$name = $row["cust_fname"]. " " .$row["cust_lname"];	
				$originalDate = $row["prop_start"];

				echo "<tr><td>". $row["prop_id"]. "</td>". "<td>". $newDate=date("m/d/Y", Strtotime($originalDate)). "</td>". "<td>". "$". $row["proj_cost"]. "</td>" . "<td>" .
				"<form method=\"post\">
    			<input type=\"submit\" name=\"submit\" value=\"Show\" />
    			<input type=\"hidden\" name=\"search\" value=".$row["prop_id"]."/>
    			</form>". "</td></tr>";
			}			
		}

?>

<div class="container-fluid">
<h3><i>  	
  	<?php

		if($name == "")
		{
			echo "<i>No Proposals Entered Yet.</i>";
		}
		else
		{
			echo "<i>" . $name . "</i>";
		}

	?>
</i></h3><hr>
</div>



</table>

<br><br><br><br>
