<?php
if(count($_POST) > 0)
{
    $First = $_POST['name_first'];
    $Last = $_POST['name_last'];
    $Email = $_POST['email'];
    $Address = $_POST['address1'];
    $Address2 = $_POST['address2'];
    $City = $_POST['city'];
    $State = $_POST['state'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $phone = $_POST['fax'];
    $credit = $_POST['cc'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $fax = $_POST['fax'];
    $mailOption = (isset($_POST['mailing']) ? 1 : 0);

    if(count($_COOKIE) < 0)
    {
        echo 'alert("Cart is empty")';
    }



    $select = mysqli_stmt_init($connection);

    $int = 0;
    foreach($_COOKIE as $key => $value)
    {

        $connection = mysqli_connect("localhost", "student", "hello", "student_space");
        if (mysqli_connect_errno())
        {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        $value1 = array();
        $value1[$int] = explode(',', $value);
        $quant = $value1[$int][0];
        $cata = $value1[$int][3];

        $sql = "update Product set inventory = (inventory - ".$quant.") where item_no = ".$cata." ";
        if(mysqli_query($connection, $sql)){
            echo "Record was updated successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. "
            . mysqli_error($connection);
        }
        $int++;
        mysqli_close($connection);

    }


    $connection = mysqli_connect("localhost", "student", "hello", "student_space");

    $sql = "Insert into Customer values(".$credit.",".$month.",".$year.",'".$First."','".$Last."','".$Email."','".$Address."','".$Address2."','".$City."','".$State."',".$zip.",'".$country."','".$phone."','".$fax."',".$mailOption.")";
    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();

    $connection = mysqli_connect("localhost", "student", "hello", "student_space");

    $sql = "Insert into orders1 values(".$quant.",".$cata.",".$credit.",'".date("Y/m/d")."')";
    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
	
	setcookie('key', "", time() - 3600);

    header("Location: index.html");
    die();
}
?>