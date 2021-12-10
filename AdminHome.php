<?php
session_start();

 ?>
<html>
<head lang="en">
	<script src="https://kit.fontawesome.com/2b6ffe8aac.js" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<link rel="stylesheet" href="CSS/spshare.css">
	<title>SpShare</title>
</head>
<body id="wrapper">
	<!--side menu -->
	<div class="sidenav">

	<div class="sidenav_heading">
			<h2>Menu</h2>
	</div>
	<a href="AdminHome.php">Home</a>
	<a href="ActivateUser.php">Activate Users</a>
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

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
	<!-- cards -->
<section id="content-area">
	<div class="heading">
			<h2>Groups</h2>
	</div>
<table class="style-table">
	<thead>
		<tr class="style-row">
			<th>
				Group Namme
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		require_once("connect_to_db.php");
		$sql = "SELECT * FROM Groups";
		$result = $conn->query($sql);
		$rowcount=mysqli_num_rows($result);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
					echo "<tr>
					
			    <td><a href='#'>".$row["GrpName"]."</a></td>
			    </tr>";

				}
			}
		?>
	</tbody>
</table>


		<br><br>

	</section>




</body>
</html>