<?php 
	        session_start();
	       // echo "Hello, ".$_SESSION["userid"].".<br>";
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
	<a href="UserHome.php">Home</a>
	<a href="logout.php">Logout</a>
	</div>


	<!-- Top Div -->
	<section id="top-area">
	<div class="top_div">
	    <?php 
	          echo "hello,".$_SESSION['userid'];
	    ?>
	    
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
			<h2>My Groups
		</h2>
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
		
		$users = "select Uid from Users WHERE Uname='".$_SESSION['userid']."'";
        $result = mysqli_query($conn, $users) or die('error getting data');
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $usrID = $row['Uid'];
            //echo $usrID;
        }
        $Grps = "select GrpName from Groups WHERE GrpId IN (select GrpId from User_Grp WHERE UId='".$usrID."')";
        $result1 = mysqli_query($conn, $Grps) or die('error getting data');
        while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
            session_start();
             //$_SESSION['group'] = $row["GrpName"];
            echo "<tr>
		    <td><a  id='gn' href='UserUploadFile.php?grp=".$row["GrpName"]."'>".$row["GrpName"]."</a></td>
		    </tr>";
		    
        }
        
		?>
		
	</tbody>
</table>

		<br><br>

	</section>

<script>
    document.getElementById("gn").onclick =function() {
    //alert("hello");
    var content = $(this)[0].innerHTML;
    alert(content);
} 
</script>

</body>
</html>