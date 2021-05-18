<?php
extract($_GET);
$username = $_GET['username'];
$password = $_GET['password'];
$email = $_GET['email'];
$desc = $_GET['desc'];

$myArray = array();
$myFile = fopen("config.txt", "r") or die("Unable to open file");
$no_of_lines = 0;
while (true)
{
    // Get the current line in the file.
    $line = fgets($myFile);

    // If this is the end of the file, stop.
    if (!$line)
        break;

    // Save the information about this blog entry.
    $myArray[$no_of_lines++] = explode(',',$line);
}
$connection = mysqli_connect($myArray[0][0], $myArray[0][1], $myArray[0][2], $myArray[0][3]);

if (mysqli_connect_errno())
{
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if($desc === "login")
{
    $sql = "select username, aes_decrypt(password,'key') from registration where username = '".$username."' and aes_decrypt(password,'key') ='".$password."'";
    $statement = mysqli_stmt_init($connection);
    if(mysqli_stmt_prepare($statement, $sql))
    {
        if(mysqli_stmt_execute($statement))
        {
            if(mysqli_stmt_bind_result($statement, $user, $pass));
            {
                mysqli_stmt_fetch($statement);
                if($user === $username && $pass === $password)
                {
                    echo "Valid Password!";
                }
                else{
                    echo "Invalid Login";
                }
            }
        }

        mysqli_stmt_close($statement);
    }
    $connection->close();
}
else{
    $sql = "Insert into Registration values('".$username."', aes_encrypt('".$password."', 'key'),'".$email."')";
    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
}

?>