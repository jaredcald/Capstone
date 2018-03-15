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

<SCRIPT LANGUAGE="JavaScript">
    function addDashes(f)
    {
        f_val = f.value.replace(/\D[^\.]/g, "");
        f.value = f_val.slice(0,3)+"-"+f_val.slice(3,6)+"-"+f_val.slice(6);
    }
</SCRIPT>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function () {

        $('#phonenumber').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        })

    });
</script>

<?php

$firstname = $lastname = $street = $city = $state = $zip = $email = $phone = $date = "";
$message = "";

    $path = "states.txt";
    $state = fopen($path, 'r');
    $data = fread($state, filesize($path));
    fclose($state);
    $lines =  explode(PHP_EOL,$data);

    $id = $_POST['edit'];

    $id = preg_replace("#[^0-9a-z]#i", "", $id);


    $servername = "helios.vse.gmu.edu";
    $username = "jcaldwe4";
    $password = "psitow";
    $dbName = "jcaldwe4";

    $conn = new mysqli($servername, $username, $password, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_select = "SELECT * FROM Customer WHERE cust_id LIKE '%$id%'";
    $select_query = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_assoc($select_query);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Edit"])) {
        if (empty($_POST["fname"]) || !preg_match("/^[a-zA-Z ]*$/",$_POST["fname"])) {
            $message = "Error! Invalid input.";
        }
        else {
            $FirstName = $_POST["fname"];
        }

        if (empty($_POST["lname"]) || !preg_match("/^[a-zA-Z ]*$/",$_POST["lname"]))  {
            $message = "Error! Invalid input.";
        }
        else {
            $LastName = $_POST["lname"];
        }

        if (empty($_POST["street"])) {
            $message = "Error! Invalid input.";
        }
        else {
            $Street = $_POST["street"];
        }

        if (empty($_POST["city"])) {
            $message = "Error! Invalid input.";
        }
        else {
            $City = $_POST["city"];
        }

        if (empty($_POST["state"])) {
            $message = "Error! Invalid input.";
        }
        else {
            $State = $_POST["state"];
        }

        if (empty($_POST["zip"])|| strlen($_POST["zip"]) < 5) {
            $message = "Error! Invalid input.";
        }
        else {
            $Zip = $_POST["zip"];
        }

        if (!check_email_address($_POST["email"])) {
            $message = "Error! Invalid input.";
        }
        else {
            $Email = $_POST["email"];
        }

        if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST["phone"])) {
            $errorI = "Error! Invalid input.";
        }
        else {
            $Phone = $_POST["phone"];
        }

        if (empty($_POST["date"])) {
            $message = "Error! Invalid input.";
        }
        else {
            $Date = $_POST["date"];
        }
    }

}

?>
<div class="container-fluid">
    <br><br>
    <h3><i>Edit Customer</i></h3>
    <hr>

    <div class="customInput">
        <div class="container">
            <form method="post" action="updatelog.php">

                <div class="row">
                    <div class="col-25">
                        <label for="date">Date</label>
                    </div>
                    <div class="col-75">
                        <input type="date" name="date" value = "<?php echo htmlspecialchars($row['cust_date']); ?>"> <?php echo $message;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label>Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="firstname" name="firstname" placeholder="First Name"  value = "<?php echo htmlspecialchars($row['cust_fname']); ?>"><?php echo $message;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <div class="spacer"></div>
                    </div>
                    <div class="col-75">
                        <input type="text" id="lastname" name="lastname" placeholder="Last Name" value ="<?php echo htmlspecialchars($row['cust_lname']); ?>"><?php echo $message;?>
                    </div>
                </div>

                <div class="spacer"></div>


                <div class="row">
                    <div class="col-25">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-75">
                        <input type="email" id="email" name="email" placeholder="Email" value = "<?php echo htmlspecialchars($row['cust_email']); ?>"><?php echo $message;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="phone">Phone Number</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="phonenumber" name="phonenumber" placeholder="Phone Number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" maxlength="12"  value = "<?php echo htmlspecialchars($row['cust_phone']); ?>">
                        <br><i>(Format: 703-123-4477)</i><?php echo $message;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="street" placeholder="Street Address" value = "<?php echo htmlspecialchars($row['cust_address']); ?>"><?php echo $message;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <div class="spacer"></div>
                    </div>
                    <div class="col-75">
                        <input type="text" id="city" name="city" placeholder="City" value = "<?php echo htmlspecialchars($row['cust_city']); ?>"><?php echo $message;?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <div class="spacer"></div>
                    </div>
                    <div class="col-75">
                        <select class="classic" name="state"><?php echo $message;?>
                            <?php
                            echo   "<option value=".$row["cust_state"].">".$row["cust_state"]."</option>";
                            foreach($lines as $line) {
                                if($line != $row["cust_state"]) {
                                    echo '<option value="'. urlencode($line).'">'.$line.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <div class="spacer"></div>
                    </div>
                    <div class="col-75">
                        <input type="text" id="zip" name="zip" placeholder="Zip" value = "<?php echo htmlspecialchars($row['cust_zip']); ?>"><?php echo $message;?>
                    </div>
                </div>

                <div class="spacer"></div>

                <br>

                <div class="row">
                    <table>
                        <tr>
                            <th style="float:left;border-bottom:none;">
                                <button class="btn btn-primary" type="submit" name="update" >Update</button>
                                <input type="hidden" name="passer" value="<?php echo $id;?>" >
                    </form></th>

                            <th style="float:right;border-bottom:none;">
                                <form method="post" action="deleteResults.php">
                                    <button class="btn btn-primary" type="submit" name="delete">Delete</button>
                                    <input type="hidden" name="delete" value="<?php echo $id;?>" >
                                </form>
                            </th>
                        </tr>
                    </table>
                </div>
    </div>
</div>


<hr>
</div>

<?php

function check_email_address($email) {

    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {

        return false;
    }

    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if
        (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
            $local_array[$i])) {
            return false;
        }
    }

    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false;
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if
            (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
↪([A-Za-z0-9]+))$",
                $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}
?>
<br />
<br />



</body>
</html>