<?php

$servername = "utacloud";
$username = "axt1312_ashwini";
$password = "Ashwinidbpass8";
$dbname = "axt1312_Spshare";
   try {
      $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "connection successful"
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>
