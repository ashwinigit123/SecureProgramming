<?php
	// Create connection
    require_once("connect_to_db.php");

	if ($_POST) {
        $role = $_POST['role'];
        $grp = $_POST['group'];
        $password = $_POST['user_password'];
        $hashpwd = password_hash($password, PASSWORD_DEFAULT);
        //echo $hashpwd;

        if($role!='Admin'){
             $query = "insert into Users (Uname,Password, Fname, Lname,Role) values ('".$_POST['user_name']."','".$hashpwd."', '".$_POST['first_name']."', '".$_POST['last_name']."','".$role."')";
           if (mysqli_query($conn, $query)) {
             //echo "New record created successfully";
           } else {
             echo "Error: " . $query . "<br>" . mysqli_error($conn);
           }
        }
        else{
            $query = "insert into Users (Uname,Password, Fname, Lname,Role,status) values ('".$_POST['user_name']."','".$hashpwd."', '".$_POST['first_name']."', '".$_POST['last_name']."','".$role."',1)";
           if (mysqli_query($conn, $query)) {
             //echo "New record created successfully";
           } else {
             echo "Error: " . $query . "<br>" . mysqli_error($conn);
           }
        }


        $query2 = "select * from Users WHERE Uname='".$_POST['user_name']."'";
       $result = mysqli_query($conn, $query2) or die('error getting data');
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $usrID = $row['Uid'];
        //echo $usrID;
      }

      $queryRole = "select * from Groups where GrpName='".$grp."'";
           $result = mysqli_query($conn, $queryRole) or die('error getting data');
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        $grpId = $row['GrpId'];

          }
        $queryUserRole = "INSERT INTO User_Grp (UId,GrpId)
            VALUES (?,?)";
            $stmt = $conn->prepare($queryUserRole);
            $stmt->bind_param("ii", $usrID, $grpId);
          if ($stmt->execute()) {
             header("Location:https://axt1312.uta.cloud/SpShare/index.php");
          } else {
             echo "Error: " . $query . "<br>" . mysqli_error($conn);
          }
	}

?>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<head>
<meta charset="ISO-8859-1">
<title>SpShare</title>
</head>
<style>
#success_message{ display: none;}
fieldset{
  border: 1px solid rgb(255,232,57);
  width: 600px;
  margin:auto;
}
input{
    width: 100%;
}

</style>
<body>    <div class="container">

    <form class="well form-horizontal" action=" " method="post"  id="contact_form" onsubmit="return confirmPass(); ">
<!-- Form Name -->
<legend><center><h2><b>Registration Form</b></h2></center></legend><br>
<fieldset>
<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">First Name</label>
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="first_name" placeholder="First Name" class="form-control"  type="text" pattern="[A-Za-z]+" required>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Last Name</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="last_name" placeholder="Last Name" class="form-control"  type="text" pattern="[A-Za-z]+" required>
    </div>
  </div>
</div>

  <div class="form-group">
  <label class="col-md-4 control-label">Role</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select name="role" class="form-control selectpicker" required>
      <option value="">Select your Role</option>
      <option>User</option>
      <option>Admin</option>
    </select>
  </div>
</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Groups</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    
      <?php
       echo "<select name='group' class='form-control selectpicker' required>";
        echo "<option value=''>Select A group you want to join</option>";
        require_once("connect_to_db.php");
        
        if($conn){
          $sql = "SELECT * FROM axt1312_Spshare.Groups";
    	    echo "hey";
    	    $result = $conn->query($sql);
    	    while($row = $result->fetch_assoc()) {
            echo "<option value='".$row['GrpName']."'>".$row['GrpName']."</option>";

    	    }
        }

      ?>
    </select>
  </div>
</div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">Username</label>
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="user_name" placeholder="Username" class="form-control"  type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Password</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="user_password" id="pwd" placeholder="Password" class="form-control"  type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Confirm Password</label>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="confirm_password" id="cnpass" placeholder="Confirm Password" class="form-control"  type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    </div>
  </div>
</div>


<!-- Success message -->
<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
  </div>
</div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
    <script type="text/javascript">
			 function confirmPass() {
	            var enteredpass = document.getElementById("pwd").value;
    			var confirmpass = document.getElementById("cnpass").value;
    			if(enteredpass != confirmpass)
    			{
    				alert('passwords do not match. Please re-enter password')
    				return false;
    			}
			    };
			    
			    function validateForm(){
			        var fname = document.forms["myform"]["first_name"].value;
			        var lname = document.forms["myform"]["last_name"].value;
			        var role = document.forms["myform"]["role"].value;
			        var group = document.forms["myform"]["group"].value;
    			    var uname = document.forms["myform"]["user_name"].value;
    			    var pwd = document.forms["myform"]["user_password"].value;
    			    var cnpwd = document.forms["myform"]["confirm_password"].value;
                      if (x == "") {
                        alert("Please enter a UserName");
                        return false;
                      }
                      if (y == "") {
                        alert("Please enter a Password");
                        return false;
                      }
			    }
			</script>
</body>
</html>
