<?php
    $id = $_GET['id_no'];
    $description = $_GET['desc'];
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



    $sql = 'SELECT image, item_name, price, inventory FROM product WHERE item_no = ?';
    $statement = mysqli_stmt_init($connection);
    if(mysqli_stmt_prepare($statement, $sql))
    {
        mysqli_stmt_bind_param($statement, "i", $id);

        if(mysqli_stmt_execute($statement))
        {
            if(mysqli_stmt_bind_result($statement, $image, $item, $price, $inventory));
            {
                mysqli_stmt_fetch($statement);
                if($inventory == 0)
                {
                    $inventory = "Out of Stock";
                }
            }
        }

        mysqli_stmt_close($statement);
    }
    else
    {

    }

    mysqli_close($connection)

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="JavaScript.js"></script>
    <title></title>
    <style>
        .special {
            background-color: #b8b8b8;
        }

        h1 {
            text-align: center;
        }

        .p1 {
            text-align: center;
            font-family: 'Lucida Calligraphy';
        }

        .div1 {
            width: 150px;
            margin: 0 auto;
        }

        .div2 {
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        .img1 {
            width: 150px;
            height: 200px;
        }

        img {
            border-style: inset;
            border-width: thick;
            border-color: gray;
            border-width: 15px;
        }
    </style>
</head>
<body class="special">
    <p id="catalog"><?php echo $id?></p>
    <form action="http://localhost:8090" method="post">
        <h1 id="title"><?php echo $item ?></h1>
        <div class="div1">
            <img id="image" class="img1" src="images/<?php echo $image ?>" />
        </div>
        <p class="p1"><?php echo $description ?></p>
        <br />
        <div class="div2">
            <p id="price">Price: <?php print $price ?></p>
            <?php
            if($inventory === "Out of Stock")
            {
                echo "<h2 align='center'> Out of Stock! </h2>";
                echo "</form>";
            }
            else{
                echo "Quantity:";
                echo "<input type='text' id='quant' title='Max of 2 digits' required='required' pattern='[0-9]{1,2}' style='width:80px;' onchange='subtract(".$inventory.")' />";
                echo "<br />";
                echo "<br />";
                echo "</div>";
                echo "</form>";
                echo "<p align='center'>";
                echo "<input type='image' value='submit' src='images/BuyNow.png' onclick='getInfo()' />";
                echo "</p>";
                echo "<p align='center'>";
                echo "<a href='store_index.html'>Continue Shopping</a>";
                echo "</p>";

            }
            ?>
        
</body>
</html>