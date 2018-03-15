<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Customer</title>
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


<div class="container-fluid">
<?php

$firstname = $lastname = $street = $city = $state = $zip = $email = $phone = $date = "";
$id = $_POST['passer'];

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$street = $_POST["street"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$email = $_POST["email"];
$phone = $_POST["phonenumber"];
$date = $_POST["date"];


$refresh = "<br><br><div><i><button class=\"btn btn-primary\"><a href=\"customer.php\">Refresh</a></button></i></div>";
echo "$refresh";
$myOutput = "";

if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["street"]) && !empty($_POST["city"]) && !empty($_POST["zip"]) && !empty($_POST["email"]) && !empty($_POST["phonenumber"]) && !empty($_POST["date"])) {

    $servername = "helios.vse.gmu.edu";
    $username = "jcaldwe4";
    $password = "psitow";
    $dbName = "jcaldwe4";

    $conn = new mysqli($servername, $username, $password, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE Customer 
				SET cust_fname = '$firstname', cust_lname = '$lastname', cust_address = '$street',
				cust_city = '$city', cust_state = '$state', cust_zip = '$zip', cust_email = '$email', cust_phone = '$phone', cust_date = '$date'
				WHERE cust_id = $id";



    if ($conn->query($sql) === TRUE) {
        $myOutput = "<div style=\"color:green;\"><i>Customer successfully updated!</i></div>";
    } else {
        $myOutput = "<div style=\"color:red;\"><i>Error: " . $sql . "<br>" . $conn->error . "</i></div>";
    }

    echo $myOutput;

    $conn->close();
}
else{
    $myOutput = "<div style=\"color:red;\"><i>Error: Update was not successful!</i></div>";
    echo $myOutput;
}

?>
</div>
