<?php

	// Create connection
    require_once("connect_to_db.php");
	if ($_POST) {
        $uname = $_POST['uname'];
        $password = $_POST['pwd'];
        
        $query2 = "select * from Users WHERE Uname='".$uname."'";
        $result = mysqli_query($conn, $query2) or die('error getting data');
        if($result->num_rows >0)
        {
           while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                if($row['status']==0){
                    echo '<script>alert("Your profile Needs activation from admin!! Please try again later")</script>';
                }
                else{
                    $pass = $row['Password'];
                    if (password_verify($password, $pass)){
                        session_start();
                        $_SESSION['userid'] = $uname;
                        if($row['Role'] =='Admin')
                        {
                             header("Location:https://axt1312.uta.cloud/SpShare/AdminHome.php");
                        }
                        else{
                             header("Location:https://axt1312.uta.cloud/SpShare/UserHome.php");
                        }
                    }
                    else{
                       echo '<script>alert("Invalid Credentials")</script>';
                    }
                }
            } 
        }
        else{
             echo '<script>alert("Invalid Credentials")</script>';
        }
        
	}

?>

<html>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style>
.b1 {
    font-family: "Lato", sans-serif;
}



.main-head{
    height: 150px;
    background: #FFF;

}

.sidenav {
    height: 100%;
    background-color: #000;
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 10%;
    }

    .register-form{
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 40%;
    }

    .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .login-form{
        margin-top: 80%;
    }

    .register-form{
        margin-top: 20%;
    }
}


.login-main-text{
    margin-top: 20%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #000 !important;
    color: #fff;
}
</style>
<body class="b1">
<div class="sidenav">
         <div class="login-main-text">
            <h2>Application<br> Login Page</h2>
            <p>Login or register from here to access.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form name = "myform" action=" " method="post" onsubmit="return validateForm()">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" name="uname" placeholder="User Name">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" name="pwd" class="form-control" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-black" >Login</button>
                  <a id="register" class="btn btn-secondary" href="Signup.php" >Register</a>
               </form>
            </div>
         </div>
      </div>
			<script type="text/javascript">
			function validateForm(){
			    var x = document.forms["myform"]["uname"].value;
			    var y = document.forms["myform"]["pwd"].value;
                  if (x == "") {
                    alert("Please enter a UserName");
                    return false;
                  }
                  if (y == "") {
                    alert("Please enter a Password");
                    return false;
                  }
			}
			 //document.getElementById("register").onclick = function () {

			 //    window.location.href = "Signup.php";
				// 		//window.open("Signup.php");
				// 	//	alert("hello")
			 //   };
			</script>
</body>

</html>
