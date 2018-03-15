<!DOCTYPE html>
<html lang="en">
<head>
  <title>Creation Center</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/proposalviews.css" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php
  include "menu.php";
  include "details.php";

  function totalPrice($list) 
  {
    //var_dump(is_float(27.25));
    //$pass = var_dump(is_float($list));
    
    $total = 0.0;
    $pass = true;

    for($k = 0; $k < count($list); $k++)
      {
        if(!is_numeric($list[$k]))
        {
          $pass = false;
        }
      }
    
    if($pass)
    {
      
        for($k = 0; $k < count($list); $k++)
        {
          $total += $list[$k];
        }
      }
      else
      {
        echo "<br>List does not contain a dollar amount.";
      }

      return $total;
  }



    if(isset($_POST['addMe']))
    {

      if(!empty($_POST["detail"]) && !empty($_POST["price"]))
      {

        $passingID = "";
        $startDate = "";

        if($_POST["passingID"] != "" && $_POST["date"] != "")
        {
          $passingID = $_POST["passingID"];
          $startDate = $_POST["date"];
        }


        $servername = "helios.vse.gmu.edu";
        $username = "jcaldwe4";
        $password = "psitow";
        $dbName = "jcaldwe4";

        $conn = new mysqli($servername, $username, $password, $dbName);
        if ($conn->connect_error){
            die("Connection failed:" . $conn->connect_error);
        }

        $detailsList = $_POST["detail"];
        $priceList = $_POST["price"];
        $dlist = new SplDoublyLinkedList();

        $detailCount = count($detailsList);
        $priceCount = count($priceList);
        $innerCount = 0;

        // $sql = "SELECT * FROM Customer WHERE cust_fname LIKE '%$searchq%' OR cust_lname LIKE '%$searchq%'";


        $sql = "INSERT INTO Proposal(prop_start, cust_id) VALUES ('$startDate', '$passingID')";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $prop_id = "SELECT prop_id FROM Proposal WHERE prop_id=(SELECT max(prop_id) FROM Proposal)";

        $proj_id = "SELECT proj_id FROM Project WHERE proj_id=(SELECT max(proj_id) FROM Project)";

        $projIdCount = 0;
        $propIdCount = 0;

        $query1 = mysqli_query($conn, $proj_id);
        $count1 = mysqli_num_rows($query1);

        $query2 = mysqli_query($conn, $prop_id);
        $count2 = mysqli_num_rows($query2);


        while($row = mysqli_fetch_array($query1))
        {
          $projIdCount = $row["proj_id"];
        }

        while($row = mysqli_fetch_array($query2))
        {
          $propIdCount = $row["prop_id"];
        }

        $projIdCount++;
        //$propIdCount++;

        while($innerCount < $detailCount)
        {
          $dlist->add($innerCount, new Details($detailsList[$innerCount], $priceList[$innerCount]));
          //$projIdCount++;
          $innerCount++;
        }

        foreach ($dlist as $value)
        {

          $desc = $value->getDescription();
          $price = $value->getPrice();


          $projInsert = "INSERT INTO Project(proj_desc, proj_cost) VALUES ('$desc', '$price')";
          $jobInsert = "INSERT INTO Joblist(prop_id, proj_id) VALUES ('$propIdCount', '$projIdCount')";

          if ($conn->query($projInsert) === TRUE) {
              //echo "New record created successfully";
          } else {
              //echo "Error: " . $sql . "<br>" . $conn->error;
          }

          if ($conn->query($jobInsert) === TRUE) {
              //echo "New record created successfully";
          } else {
              //echo "Error: " . $sql . "<br>" . $conn->error;
          }

          $projIdCount++;

            //echo $value->getDescription() . " - " . $value->getPrice() . "<br>";
            // echo sprintf("%s\n", $value->getDescription() . " - " . $value->getPrice() . "<br>");
        }

        $conn->close();

        $myOutput = "Proposal successfully added!";


      }
    }

  ?>



<!-- Menu Up-->
<!-- Data-->

<script>
function myCreateFunction() {
    var table = document.getElementById("theTable");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    cell1.innerHTML = "<input type=\"text\" name=\"detail[]\">";
    cell2.innerHTML = "<input type=\"number\" step=\"0.00\" name=\"price[]\">";
}

function myDeleteFunction() {
  if(document.getElementById("theTable") != 2)
  {
    document.getElementById("theTable").deleteRow(-1);
  }
  else
  {
    alert("Reached Max Delete");
  }
}

</script>



<div class="container-fluid">
<br><br>
<h3>Creating a Proposal</h3>
<br>

<?php

if(isset($_POST['addMe'])) {
    echo "<div style=\"color:green;\"><i>$myOutput</i></div>";
}

  if(!empty($_POST["custID"]))
  {
    $transfer = $_POST["custID"];
  }
  else
  {
    $transfer = "";
  }

?>


<div class="customInput">
<div class="container">

  
  <form method="post" action="addproposals.php">
    
    <div class="row">
      <div class="col-25">
        <label for="date">Start Date</label>
      </div>
      <div class="col-75">
        <input type="date" name="date"> <?php //echo $errorJ;?>
        <input type="hidden" name="passingID" value="<?php echo $transfer?>"/>
      </div>
    </div>
    <hr>


    <table id="theTable">
      <tr>
        <th>Description</th>
        <th>Price</th>
      </tr>
      <tr>
        <td><input type="text" name="detail[]"></td>
        <td><input type="number" step="0.00" name="price[]"></td>
      </tr>
    </table>

    <br>
    <button class="btn btn-primary" type="button" onclick="myCreateFunction()">Add Detail</button>
    <button class="btn btn-primary" type="button" onclick="myDeleteFunction()">Delete Detail</button>
    <br>

    <br><br>
    <div class="row">
      <input type="submit" name="addMe" value="Submit">
    </div>
  </form>



</div>
</div>

<br>

</div>


</body>
</html>