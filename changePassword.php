<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Kisiwa TTI Students Voting System</title>
    <link rel = "icon" href = "images/logo.png" type = "image/x-icon">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
      .headerFont{
        font-family: 'Ubuntu', sans-serif;
        font-size: 24px;
      }

      .subFont{
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        
      }
      
      .specialHead{
        font-family: 'Oswald', sans-serif;
      }

      .normalFont{
        font-family: 'Roboto Condensed', sans-serif;
      }
    </style>

  </head>
<?php
session_start();
// Credentials
$hostname="localhost";
        $username= "kisiwaev";
        $password= "Nsasala2022";
        $database="kisiwaev_db_evoting";
        
        $con = mysqli_connect($hostname, $username, $password, $database);


// UserInput Test
        function test_input($data) {
        $hostname="localhost";
        $username= "kisiwaev";
        $password= "Nsasala2022";
        $database="kisiwaev_db_evoting";
        
        $con = mysqli_connect($hostname, $username, $password, $database);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($con, $data);
        return $data;
    } 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	// Fetch Data
	if(empty($_POST['existingUserPassword']) || empty($_POST['newUserPassword']))
	{
		$error= "Fields Recquired.";
	}
	else
	{
		$old= test_input($_POST['existingUserPassword']);
		$new= test_input($_POST['newUserPassword']);
        $admission = test_input($_POST['userAdmission']);
	}
    $msg = "";
	//Establish Connection
	$conn= mysqli_connect($hostname, $username, $password, $database);

	// Select Database
	//$db= mysql_select_db($db, $conn);

	// ******************************
	// ADD USER NAME FIELD HERE-- FROM SESSION
	//**********************************

	$sql="SELECT * FROM tbl_users WHERE admission = '$admission' AND password='$old'";
	$query= mysqli_query($conn, $sql);
	$rows= mysqli_num_rows($query);
	if($rows>0)
	{
		// Given Password is Valid
		$sql="UPDATE tbl_users SET password='$new', logged_once='1' WHERE admission='$admission'"; // =============EDIT *SESSSION_SUERNAME *
		if($query= mysqli_query($conn, $sql))
		{
			// Successfully Changed
            $select = mysqli_query($conn, "SELECT * FROM votes_cast WHERE voterAdmission = '$admission'");
            $count = mysqli_num_rows($select);

            if($count>0)
            {
            $msg = "<center><img src='images/success.png' width='70' height='70'><h3 class='text-info specialHead text-center'><strong> PASSWORD SUCCESSFULLY CHANGED.</strong></h3><a href='user_candidate.php' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a></center>";
            }
            else
            {
                $msg = "<center><img src='images/success.png' width='70' height='70'><h3 class='text-info specialHead text-center'><strong> PASSWORD SUCCESSFULLY CHANGED.</strong></h3><a href='vote.php' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a></center>";
            }
		}
	}
	else
	{
		$error= "Old-Password is Incorrect";
        // Successfully Changed
            $select = mysqli_query($conn, "SELECT * FROM votes_cast WHERE voterAdmission = '$admission'");
            $count = mysqli_num_rows($select);

            if($count>0)
            {
            $msg = "<center><img src='images/error.png' width='70' height='70'><h3 class='text-info specialHead text-center'><strong> $error</strong></h3><a href='user_candidate.php' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a></center>";
            }
            else
            {
                $msg = "<center><img src='images/error.png' width='70' height='70'><h3 class='text-info specialHead text-center'><strong> $error</strong></h3><a href='vote.php' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a></center>";
            }

	}

	mysqli_close($conn);
}
?>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php
          if(isset($_SESSION['userAdmission']))
          {
            //die("<p style='color:white;'>".$_SESSION['userAdmission']."</p>");
            include "header_user.php";
            echo '<span class="normalFont"><a href="logout.php" class="btn btn-danger navbar-right navbar-btn" style="border-radius:0%">Logout</a></span>';
          }
          elseif(isset($_SESSION['admin']))
          {
              include "header.php";
          }
          else
          {
            echo "<script>alert('Please login to access the system');window.location.assign('/');</script>";
            ?>
            <div class="navbar-header">
          <a href="index.php" class="navbar-brand text-lg">Kisiwa TTI Voting System</a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php"><span class="subFont"><strong>Home</strong></span></a></li>
            <li><a href="about.php"><span class="subFont"><strong>About Us</strong></span></a></li>
            <li><a href="contact.php"><span class="subFont"><strong>Contact Us</strong></span></a></li>
            <li><a href="help.php"><span class="subFont"><strong>FAQs</strong></span></a></li> 
          
          </ul>
            <?php
            echo '<span class="normalFont"><a href="userlogin.php" class="btn btn-info navbar-right navbar-btn" style="border-radius:0%">Login as User</a></span>';
            echo "&nbsp &nbsp";
            echo '<span class="normalFont"><a href="admin.php" class="btn btn-success navbar-right navbar-btn" style="border-radius:0%">Login as Admin</a></span> ';
            echo "&nbsp &nbsp";
          }
          ?>
        </div>

      </div> <!-- end of container -->
    </nav>
	
	<div class="container">
    <?php
    if(isset($_SESSION['admin']))
    {
    ?>

    
    <div class="container" style="padding-top:70px;">
    	<div class="row">
    		<div class="col-sm-4"></div>
    		<div class="col-sm-4" style="border:2px solid gray;padding:50px;">
    			
    			<div class="page-header">
    				<h2 class="specialHead">Admin's Password</h2>
    			</div>
          
          <form action="updatePwd.php" method="POST">
      			<div class="form-group">
      				<label for="">Old Password</label><br>
      				<input type="text" name="existingPassword" placeholder="Enter Old Password" class="form-control"><br>

      				<label for="">New Password</label><br>
      				<input type="password" name="newPassword" class="form-control" placeholder="Enter New Password"><br>

              <label for="">Retype Password</label><br>
              <input type="password" name="retypePassword" class="form-control" placeholder="Enter New Password Again"><br>

      				<button type="submit" class="btn btn-block span btn-primary "> <span class="glyphicon glyphicon-ok"></span> Change Password</button>
      			</div>
          </form>
    		</div>
    		<div class="col-sm-4"></div>
    	</div>
    </div>
    <?php
  }
  elseif(isset($_SESSION['userAdmission']))
  {
    ?>
    <div class="container" style="padding-top:100px;">
      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" style="border:2px solid gray;padding:50px;">
          <?php if(!empty($msg)){die($msg);}?>
          <div class="page-header">
            <h2 class="specialHead">Change Password</h2>
          </div>
          
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
              <label for="">Old Password</label><br>
              <input type="text" name="existingUserPassword" placeholder="Enter Old Password" class="form-control"><br>
            <input type="hidden" name="userAdmission" value="<?php echo  $_SESSION['userAdmission']; ?>">
              <label for="">New Password</label><br>
              <input type="password" name="newUserPassword" class="form-control" placeholder="Enter New Password"><br>

              <label for="">Retype Password</label><br>
              <input type="password" name="retypePassword" class="form-control" placeholder="Enter New Password Again"><br>

              <button type="submit" name="submit" class="btn btn-block span btn-primary "> <span class="glyphicon glyphicon-ok"></span> Change Password</button>
            </div>
          </form>
        </div>
        <div class="col-sm-4"></div>
      </div>
    </div>
    <?php
  }
  else
  {
    unset($_SESSION);
    session_destroy();
    echo "<script>alert('Login to access the system');window.location.assign('/kisiwavoting/');</script>";
  }
    ?>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>