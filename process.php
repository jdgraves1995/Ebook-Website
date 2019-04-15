<?php
extract($_POST);

if(count($_POST) > 0)
{

    $image = $_FILES["file"];
    $name = "images/blog".basename($image["name"]);
    $record = $_POST['text1'] . "," . $_POST['text2'] . "," . $image["name"] . ","  . $_POST['area'] . "," . date('m-d-y');

    $file = fopen('blogs.txt', 'a');
    if (!$file)
        exit("<h1>Error openning info </h1>");

    fwrite($file, $record . "\r\n");

    move_uploaded_file($image["tmp_name"], $name);
    fclose($file);


}


?>
