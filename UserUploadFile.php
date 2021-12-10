<?php
session_start();
?>
<?php
  $msg = "";
	require_once("connect_to_db.php");
    session_start();
    //	$grp = $_SESSION['group'];
   	$grp = $_GET['grp']; // Get 'Table'
    // If upload button is clicked ...
    $query2 = "select * from Groups WHERE GrpName='".$grp."'";
    $result2 = mysqli_query($conn, $query2) or die('error getting data');
    while($row = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
        $grpid = $row['GrpId'];
    }
  if ($_POST) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "image/".$filename;

       // Get all the submitted data from the form
    $sql = "INSERT INTO Files (Filename,grpid) VALUES ('$filename','$grpid')";

    // Execute query
    $result = mysqli_query($conn, $sql) or die('error getting data');

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder))  {
        //$msg = "Image uploaded successfully";
         echo '<script>alert("Image uploaded successfully")</script>';
    }else{
        //$msg = "Failed to upload image";
        echo '<script>alert("Failed to upload image")</script>';
  }
  }
// $result1 = mysqli_query($conn, "SELECT * FROM Files");
// while($data = mysqli_fetch_array($result1))
// {
?>


<!DOCTYPE html>
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
    <div class="container">
	    <div>
	        <h2><?php 
    	          echo "Group:".$grp;
    	    ?></h2>
    	    
	    
        </div>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="uploadfile" value=""/>
        <div>
          <button type="submit" name="upload">UPLOAD</button>
        </div>
    </form>
    </div>
    
    <?php
    require_once("connect_to_db.php");
    $q = "select * from Files WHERE grpid='".$grpid."'";

    $result1 = mysqli_query($conn, $q);
    while($data = mysqli_fetch_array($result1))
    {
    ?>
        <img src="<?php echo 'image/'.$data['Filename']; ?>" width='200' height='200'>

    <?php
        }
        
    ?>
	</section>
</html>
