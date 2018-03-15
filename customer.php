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

<!-- Menu Up-->
<!-- Data-->

<div class="container-fluid">
   
  
  <br>

  <form class="example" action="customer.php" method="post" style="float:left;max-width:450px;">
            <input type="text" placeholder="Search.." name="search">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
        </form>

  <br><br><br><br>

  <table style="overflow:auto;">
    <tr>
      <th style="border-bottom:none;"><h3><i>Customer List</i></h3></th>
      <th style="float:right;border-bottom:none;">
        <button class="btn btn-primary" type="button"><a href="addcustomer.php">Add Customer</a></button>
      </th>
    </tr>
  </table>
  <hr>


<?php
  $servername = "helios.vse.gmu.edu";
  $username = "jcaldwe4";
  $password = "psitow";
  $dbName = "jcaldwe4";

  $conn = new mysqli($servername, $username, $password, $dbName);
  if ($conn->connect_error){
      die("Connection failed:" . $conn->connect_error);
  }
  //echo "Connected successfully";

  ?>

  <table>
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th></th>
  </tr>

  <?php

  $sql = "SELECT cust_id, cust_fname, cust_lname, cust_email FROM Customer";
  $result = $conn->query($sql);
  $output = "";

  if(!isset($_POST['search']) || $_POST['search'] == "")
  {
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){

        echo "<tr><td>" . $row["cust_fname"].
        "<td>" . $row["cust_lname"]. "</td><td>" . $row["cust_email"] . "</td><td>" . 
        "<form method=\"post\" action=\"proposallist.php\">
          <input type=\"submit\" name=\"submit\" value=\"Show\" />
          <input type=\"hidden\" name=\"search\" value=".$row["cust_id"]." />
          </form>". "</td></tr>"; 
        
      }
    }
    else{
      echo "0 results";
    }
  }
  else
  {
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
    $sql = "SELECT * FROM Customer WHERE cust_fname LIKE '%$searchq%' OR cust_lname LIKE '%$searchq%'";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    
    if($count == 0)
    {
      $refresh = "<div style=\"color:red;\"><i>$searchq was not found.<br><button class=\"btn btn-primary\"><a href=\"customer.php\">Refresh</a></button></i></div>";
      echo "$refresh";
    }
    else
    {
      
      while($row = mysqli_fetch_array($query))
      {
        
        $output .= "<tr><td>" . $row["cust_fname"].
          "<td>" . $row["cust_lname"]. "</td><td>" . $row["cust_email"] . "</td><td>" . 
          "<form method=\"post\" action=\"proposallist.php\">
            <input type=\"submit\" name=\"submit\" value=\"Show\" />
            <input type=\"hidden\" name=\"search\" value=".$row["cust_id"]." />
            </form>". "</td></tr>"; 
      }

      $refresh = "<div><i><button class=\"btn btn-primary\"><a href=\"customer.php\">Refresh</a></button></i></div>";

      echo "$refresh";
    }

    echo "$output";

    

  }

  $conn->close();

?>

  </table>

<br><br><br><br>

</body>
</html>