<?php
session_start();
require_once("connect_to_db.php");
if ($_POST) {
  // echo '<script>alert("Inpost")</script>';
    $sql = "UPDATE Users SET status=1 where status=0";
	$result = $conn->query($sql);
	$rowcount=mysqli_num_rows($result);

	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			echo '<script>alert("Users Sucessfully Activated")</script>';

		}
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
<body id="wrapper">
    <form action=" " method="post">
	<!--side menu -->
	<div class="sidenav">

	<div class="sidenav_heading">
			<h2>Menu</h2>
	</div>
	<a href="AdminHome.php">Home</a>
	<a href="CreateGroup.php">Create Groups</a>
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
			<h2>Activate the Users</h2>
	</div>
<table class="style-table">
	<thead>
		<tr class="style-row">
			<th>
			    Users
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		require_once("connect_to_db.php");
		$sql = "SELECT * FROM Users where status=0";
		$result = $conn->query($sql);
		$rowcount=mysqli_num_rows($result);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
					echo "<tr>
					
			    <td>".$row["Uname"]."</td>
			    </tr>";

				}
			}
			else{
			    	echo "<tr>
					
			    <td>No Activation Requests</td>
			    </tr>";
			}
		?>
	</tbody>
</table>
<button type="submit" name="active" class="btn btn-black"  >Activate all Users</button>

<?php 

   /* if (isset($_POST['active'])) {
        echo '<script>alert("hello")</script>';
    }*/
?>
</section>


</form>

</body>
</html>