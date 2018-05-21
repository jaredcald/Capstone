<?php
readfile("header.php");
?>

<?php
	$servername = "helios.vse.gmu.edu";
	$username = "ychung8";
	$password = "xostij";
	$dbName = "ychung8";
	$conn = new mysqli($servername, $username, $password, $dbName);
	
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
?>

<table id="myTable2">
		<thead>
			<tr>
			<th>Proposal #</th>     
			<th>Start Date</th>
			<th>Customer Name</th> 
			<th>Amount</th>
			<th></th>
			</tr>
		</thead>
        
<?php  
	$result = "";
		if(isset($_GET['search'])) {
			$search = $_GET['search'];
			$search = preg_replace("#[^0-9a-z]#i","",$search);
			$sql = "SELECT Proposal.prop_id, prop_start, cust_fname, cust_lname, proj_cost 
					FROM Proposal 
					JOIN Customer ON Proposal.cust_id = Customer.cust_id INNER JOIN Joblist ON Proposal.prop_id = Joblist.prop_id 
					JOIN Project ON Project.proj_id = Joblist.proj_id 
					WHERE cust_fname LIKE '%$search%' OR cust_lname LIKE '%$search%' 
					ORDER BY prop_start DESC;";
			$query = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($query);
				while($row = mysqli_fetch_array($query)) {
					$result .= "<td>". $row["prop_id"]. "</td>". "<td>". $row["prop_start"]. "</td>". "<td>". $row["cust_fname"]. " ". $row["cust_lname"]. "</td>". "<td>". $row["proj_cost"]. "</td>".

					"<td>
					<form method=\"get\" action=\"seach.php\">
					<button name=\"search\" type=\"submit\" value=".$row["cust_fname"]."/>Show</button>
					</form>
					". "</td>";

					echo "</tr>";
					echo "</tbody>";
				}			
		}
		echo "$result";
?>

</table>

<?php
readfile("footer.php");
?>
