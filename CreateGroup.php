<?php
session_start();
require_once("connect_to_db.php");
if ($_POST) {
   //echo '<script>alert("Inpost")</script>';
    $query = "insert into Groups (GrpName) values ('".$_POST['grpname']."')";
           if (mysqli_query($conn, $query)) {
             echo '<script>alert("Group Created")</script>';
           } else {
             echo "Error: " . $query . "<br>" . mysqli_error($conn);
           }
}

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
    <a href="AddUsertoGroup.php">Add Users to Groups</a>
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
            <input type="text" placeholder="Enter Group Name" name="grpname" id="gname" required>
            <button type="submit" class="registerbtn">Create Group</button>
        </div>
    </form>
</section>


</form>

</body>
</html>