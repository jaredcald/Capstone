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
?>


<!-- Menu Up-->
<!-- Data-->

<script>
function myCreateFunction() {
    var table = document.getElementById("theTable");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = "<input type=\"text\" name=\"detail\">";
    cell2.innerHTML = "<input type=\"number\" step=\"0.00\" name=\"price\">";
}

function myDeleteFunction() {
  if(document.getElementById("theTable").rowIndex != 1)
  {
    document.getElementById("theTable").deleteRow(-1);
  }
}
function myFunction(x) {
  alert("Row index is: " + x.rowIndex);
}
</script>


<div class="container-fluid">
<br><br>
<h3>Creating a Proposal</h3>
<br>


<div class="customInput">
<div class="container">
  
  <form method="post">
    
    <div class="row">
      <div class="col-25">
        <label for="date">Start Date</label>
      </div>
      <div class="col-75">
        <input type="date" name="date"> <?php //echo $errorJ;?>
      </div>
    </div>
    <hr>


    <table id="theTable">
      <tr>
        <th>Description</th>
        <th>Price</th>
      </tr>
      <tr>
        <td><input type="text" name="detail"></td>
        <td><input type="number" step="0.00" name="price"></td>
      </tr>
    </table>

    <br>
    <button class="btn btn-primary" type="button" onclick="myCreateFunction()">Add Detail</button>
    <button class="btn btn-primary" type="button" onclick="myDeleteFunction()">Delete Detail</button>
    <br>

    <br><br>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>

</div>
</div>

<br>

</div>


</body>
</html>