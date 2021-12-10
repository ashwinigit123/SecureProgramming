<?php
session_start();
require_once("connect_to_db.php");
if ($_POST) {
    //echo '<script>alert("Inpost")</script>';
    $query1 = "select * from Users WHERE Uname='".$_POST['users']."'";
    $result = mysqli_query($conn, $query1) or die('error getting data');
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $usrID = $row['Uid'];
        //echo $usrID;
        //echo '<script>alert('.$usrID.')</script>';
    }
    $query2 = "select * from Groups WHERE GrpName='".$_POST['grpname']."'";
    $result2 = mysqli_query($conn, $query2) or die('error getting data');
    while($row = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
        $grpid = $row['GrpId'];
        //echo $usrID;
        //echo '<script>alert('.$grpid.')</script>';
    }
      
    $query = "insert into User_Grp (UId,GrpId) values ('".$usrID."','".$grpid."')";
    if (mysqli_query($conn, $query)) {
     echo '<script>alert("User Added Sucessfully")</script>';
    } else {
     echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
    mysqli_close($con);
 ?>
<html>
    
<head lang="en">
	<script src="https://kit.fontawesome.com/2b6ffe8aac.js" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<link rel="stylesheet" href="CSS/spshare.css">
	<title>SpShare</title>
</head>
<style>
fieldset{
  border: 1px solid rgb(255,232,57);
  width: 600px;
  margin:auto;
}


</style>
<body id="wrapper">
    <form action=" " method="post">
	<!--side menu -->
	<div class="sidenav">

	<div class="sidenav_heading">
			<h2>Menu</h2>
	</div>
	<a href="AdminHome.php">Home</a>
	<a href="ActivateUser.php">Activate Users</a>
	<a href="CreateGroup.php">Create Groups</a>
	<a href="logout.php">Logout</a>
	</div>


	<!-- Top Div -->
	<section id="top-area">
	<div class="top_div">
    <?php 
	          echo "hello,".$_SESSION['userid'];
	    ?>
		</div>
</div>
<div class="top_div_name">SpShare</div>
</section>

<section id="content-area">
	<div class="heading">
			<h2>Create New Group</h2>
	</div>
    <form action=" " method="post">
        <div class="container">
            <label for="grpname"><b>Group Name</b></label>
             
          <?php
           echo "<select name='grpname'  required>";
            echo "<option value=''>Select A group</option>";
            require_once("connect_to_db.php");
            
            if($conn){
              $sql = "SELECT * FROM axt1312_Spshare.Groups";
        	    //echo "hey";
        	    $result = $conn->query($sql);
        	    while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['GrpName']."'>".$row['GrpName']."</option>";
    
        	    }
            }
             echo "</select>";
             mysqli_close($con);
          ?>
        <br>
         <label for="users"><b>Users</b></label>
        <?php
           echo "<select name='users'  required>";
            echo "<option value=''>Select A User</option>";
            require_once("connect_to_db.php");
            
            if($conn){
              $sql = "SELECT * FROM Users where status=1";
        	    //echo "hey";
        	    $result = $conn->query($sql);
        	    while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['Uname']."'>".$row['Uname']."</option>";
        	    }
            }
             echo "</select>";
             mysqli_close($con);
          ?>
        <br>
        
            <button type="submit" class="registerbtn">Add User to Group</button>
        </div>
    </form>
</section>


</form>

</body>
</html>