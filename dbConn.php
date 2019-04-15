<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Example 3</title>
</head>
<body>

<?php
  $database = mysqli_connect( "localhost:3306", "student", "hello" ); //Use at all other statements. First parameter.
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $res = mysqli_select_db($database, "student_space");
  //Can also check the result - set to 0 if failure

  if ($res == 0)
  {
    print("Cannot select workspace<BR/>");
    //Display any error info for last statement
    echo "Error info:".mysqli_errno($database) . ": " . mysqli_error($database). "<BR/>";
    exit;
  }

  //Query String
  $query = "select * from test1";

  //Invoke query
  $res = mysqli_query($database, $query );

  //Fetch the rows
  //Get all data
  //Retrieves the actual name from the column index
  while(true)
  {
   $name = mysqli_fetch_field($res);
    if (!$name)
      break;
    print("columnName: $name->name");
  }

  while(true)
  {
    $row = mysqli_fetch_row($res);

    if ($row == 0)
    break;

    //Print out row (hashmap)
    for ($i = 0; $i < count($row); $i++)
    {
      $index = key($row);
      $value = $row[$index];
      print("$index --> $i -->  $value<BR>");
      next($row);
    }
  }

  $query = "delete from lodging";

  //Execute query
  $res = mysqli_query($database, $query );

  //Check the result
  if ($res == 0)
  {
    print(mysqli_error($database)." ".mysqli_errno($database)."<BR/>");
    print("Result value: ".(int)$res."<BR/>");
  }
?>

</body>
</html>