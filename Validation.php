<?php
extract($_GET);
$value = $_GET['username'];
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
         $sql = 'SELECT  username FROM Registration WHERE username = ?';
    $statement = mysqli_stmt_init($connection);
    if(mysqli_stmt_prepare($statement, $sql))
    {
        mysqli_stmt_bind_param($statement, "s", $value);

        if(mysqli_stmt_execute($statement))
        {
            if(mysqli_stmt_bind_result($statement, $username));
            {
                mysqli_stmt_fetch($statement);
                if($username === null)
                {
                    echo "Username Does not exist";

                }
                else{
                    echo "Valid Entry";
                }

            }
        }
        else{
            mysqli_stmt_error($statement);
        }

        mysqli_stmt_close($statement);
    }

}
else{
    $sql = 'SELECT  username FROM Registration WHERE username = ?';
    $statement = mysqli_stmt_init($connection);
    if(mysqli_stmt_prepare($statement, $sql))
    {
        mysqli_stmt_bind_param($statement, "s", $value);

        if(mysqli_stmt_execute($statement))
        {
            if(mysqli_stmt_bind_result($statement, $username));
            {
                mysqli_stmt_fetch($statement);
                if($username == null)
                {
                    echo "Valid Entry";

                }
                else{
                    echo "Username already in Use!";
                }

            }
        }
        else{
            mysqli_stmt_error($statement);
        }

        mysqli_stmt_close($statement);
    }
}


mysqli_close($connection)

?>