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

<div class="container-fluid">
<?php
$CustomerID = $_POST["delete"];

$servername = "helios.vse.gmu.edu";
$username = "jcaldwe4";
$password = "psitow";
$dbName = "jcaldwe4";

$refresh = "<br><br><div><i><button class=\"btn btn-primary\"><a href=\"customer.php\">Refresh</a></button></i></div>";
echo "$refresh";

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM Customer WHERE cust_ID=$CustomerID";

$output = "";

if ($conn->query($sql) === TRUE) {
    $output = "<div style=\"color:green;\"><i>Customer was successfully deleted.</i></div>";
} else {
    $output = "Error deleting record: " . $conn->error;
}

echo $output;

$conn->close();

?>
</div>


</body>
</html>