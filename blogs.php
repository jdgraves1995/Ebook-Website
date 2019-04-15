<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Example 3</title>
    <link href="admin.css" rel="stylesheet" />
</head>
<body>
<?php
$myArray = array();
$myFile = fopen("blogs.txt", "r") or die("Unable to open file");
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

$myArray = array_reverse($myArray);

for($int = 0; $int < count($myArray); $int++)
{
   
    echo ("<h1 align='center'>".$myArray[$int][1]. "!</h1>");
    echo ("<h2 align='center'>by ".$myArray[$int][0]. " on ". $myArray[$int][4]."</h2></br>");
    echo ("<div class='div3'><img src='images/blog".$myArray[$int][2]."'></div></br>");
    echo ("<p align='center'>".$myArray[$int][3]. "</p></br>");
	echo("<hr style='size: 10em;'>");
}


fclose($myFile);

?>
</body>