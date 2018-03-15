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

    <style>
        .myStyles{
            width: 85%;
            border: 1px solid #151515;
            border-radius: 4px;
            padding: 20px;
            margin: auto;
        }
    </style>
</head>
<body>

<?php
  include "menu.php";
?>

<?php

	$servername = "helios.vse.gmu.edu";
	$username = "jcaldwe4";
    $password = "psitow";
    $dbName = "jcaldwe4";

	$connection = new mysqli($servername, $username, $password, $dbName);
		if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
		}



    if(isset($_POST['propSearch'])) {
        $propSearch = $_POST['propSearch'];
        $propSearch = preg_replace("#[^0-9a-z]#i","",$propSearch);
        $sql = "SELECT Proposal.prop_id, Proposal.prop_start, Proposal.cust_id, Project.proj_id, Project.proj_desc, Project.proj_cost FROM Proposal JOIN Joblist ON Proposal.prop_id = Joblist.prop_id JOIN Project ON Project.proj_id = Joblist.proj_id WHERE Proposal.prop_id LIKE '$propSearch'";

        $query = mysqli_query($connection, $sql);
        $count = mysqli_num_rows($query);
        $proposal = "";
        $customer_id = "";

        while($row = mysqli_fetch_array($query)) {
            $originalDate = $row["prop_start"];
            //$originalDate2 = $row["prop_end"];
            $proposal = "Proposal #". " " .$row["prop_id"];
            $customer_id = $row["cust_id"];


            //echo "<tr>";
            //echo "<td>". $row["prop_id"]. "</td><td>" . $newDate=date("m/d/Y", Strtotime($originalDate)). "</td><td>". $row["proj_desc"]. "</td>". "<td>". $row["proj_cost"]. "</td>";

            //echo "<td>". $newDate=date("m/d/Y", Strtotime($originalDate)). "</td>". "<td>". $newDate=date("m/d/Y", Strtotime($originalDate2)). "</td>". "<td>". $row["proj_id"]. "</td>". "<td>". $row["proj_desc"]. "</td>". "<td>". $row["proj_cost"]. "</td>";

            //echo "</tr>";
            //echo "</tbody>";
        }


        $sql2 = "SELECT cust_fname, cust_lname, cust_email, cust_address, cust_state, cust_city, cust_zip, cust_phone FROM Customer WHERE cust_id = '$customer_id'";
        $query2 = mysqli_query($connection, $sql2);
        $count2 = mysqli_num_rows($query2);
        $output2 = "";


        while($row2 = mysqli_fetch_array($query2)) {

            $custFname = $row2["cust_fname"];
            $custLname = $row2["cust_lname"];
            $custEmail = $row2["cust_email"];
            $custAddress = $row2["cust_address"];
            $custState = $row2["cust_state"];
            $custCity = $row2["cust_city"];
            $custZip = $row2["cust_zip"];
            $custPhone = $row2["cust_phone"];

            $output2 .= $custFname . " " . $custLname
                . "<br>" . $custAddress
                . "<br>" . $custCity . ", " . $custState . ", " . $custZip
                . "<br>" . $custEmail
                . "<br>" . $custPhone;
        }
}

?>

<br>
<br>

<div class="container-fluid">
    <table style="overflow:auto;">
        <tr>
            <th style="float:right;border-bottom:none;">
                <form method="post" action="editProposal.php">
                    <button class="btn btn-primary" type="submit" name="submit">Edit Proposal</button>
                    <input type="hidden" name="edit" value="<?php echo $propSearch ?>" />
                </form>

            </th>
            <th style="float:right;border-bottom:none;">
                <form method="post" action="deleteProposal.php">
                    <button class="btn btn-primary" type="submit" name="submit">Delete Proposal</button>
                    <input type="hidden" name="custID" value="<?php echo $propSearch ?>" />
                </form>
            </th>
            <th style="float:right;border-bottom:none;">
                <form method="post" action="renderpdf.php">
                    <button class="btn btn-primary" type="submit" name="submit">Render to PDF</button>
                    <input type="hidden" name="custID" value="<?php echo $propSearch ?>" />
                </form>
            </th>
        </tr>
    </table>
</div>


<br>



<div class="container-fluid">
<h3><i>  	

</i></h3><hr>

    <div class="myStyles">
    <table id="myTable2">
        <tr>
            <th><img src="https://goo.gl/GYx5KF" alt="logo" style="width:200px;"></th>
            <th></th>
        </tr>
        <tr>
            <td>
                <?php

                if($proposal == "")
                {
                    echo "<i>No Proposals Entered Yet.</i>";
                }
                else
                {
                    echo "<i><h3>" . $proposal . "</h3></i>";
                    //echo "<i>" . $customer_id . "</i>";

                }
                ?>
            </td>
            <td><b>Date: </b><br>
                <?php
                $newDate = date("m/d/Y", Strtotime($originalDate));
                echo $newDate;
                ?>
            </td>
        </tr>
        <tr>
            <td>E&A Contractors
                <br> 2645 Conquest Place
                <br> Herndon, VA 20171
                <br> ea-contractors@hotmail.com
                <br>703-795-4861
            </td>
            <td>
                <?php
                echo $output2;
                ?>
            </td>
        </tr>
    </table>
        <br><br><hr>
        <table>
        <tr>
            <th>Description</th>
            <th>Price</th>
        </tr>
            <?php
            $sql3 = "SELECT Proposal.prop_id, Proposal.prop_start, Proposal.cust_id, Project.proj_id, Project.proj_desc, Project.proj_cost FROM Proposal JOIN Joblist ON Proposal.prop_id = Joblist.prop_id JOIN Project ON Project.proj_id = Joblist.proj_id WHERE Proposal.prop_id LIKE '$propSearch'";

            $query3 = mysqli_query($connection, $sql3);
            $count3 = mysqli_num_rows($query3);
            $total = 0.0;

            while($row = mysqli_fetch_array($query3)) {
                echo "<tr><td>". $row["proj_desc"]. "</td>". "<td> $". $row["proj_cost"]. "</td></tr>";
                $total += $row["proj_cost"];

            }

            ?>

            <td><b>Total: </b></td>
            <td><b>
                <?php
                    $formatTotal = number_format($total, 2, '.', '');
                    echo "$" . $formatTotal;
                ?>
                </b>
            </td>
        </tr>
    </table>
        <br><br>
</div>
</div>
<hr>

<br><br><br><br>
</body>
</html>