<?php
  $db_host = "utacloud";
  $db_name = "axt1312_Spshare";
  $db_pass = "Ashwinidbpass8";
  $db_user = "axt1312_ashwini";
 
  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
 
  if (!$conn){
    die ('Failed to connect with server');
  }   
?>
