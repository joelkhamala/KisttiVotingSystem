<?php
  session_start();
  include("config.php");
    ?>
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


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<?php
include"header_user.php";
  ?>
	<div class="container"> 
    <div class="container" style="padding-top:100px;">
    	<div class="row">
    		<div class="col-sm-4"></div>
    		<div class="col-sm-4  bg-success" style="border:2px solid gray;padding:50px;">
    			
    			<div class="page-header">
    				<h2 class="specialHead text-center">Student Login Panel</h2>
    			</div>
          <?php
          if(isset($_POST['submit']))
    {
        $hostname="localhost";
        $username= "kisiwaev";
        $password= "Nsasala2022";
        $database="kisiwaev_db_evoting";
        
        $con = mysqli_connect($hostname, $username, $password, $database);
      function testInput($data)
      {
        $hostname="localhost";
        $username= "kisiwaev";
        $password= "Nsasala2022";
        $database="kisiwaev_db_evoting";
        $con = mysqli_connect($hostname, $username, $password, $database);
        $data=trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      //create variables to store user input
      $userAdmission = testInput($_POST['userAddNo']);
      $password = testInput($_POST['userPass']);
      //Encrypt password
      $pass = md5($password);
      //Select data with the user input values
      $selData = mysqli_query($con, "SELECT * FROM tbl_users WHERE admission = '$userAdmission' AND password = '$password'");
      $countData = mysqli_num_rows($selData);
        
      if($countData>0)
      {
            $selData1 = mysqli_query($con, "SELECT * FROM votes_cast WHERE voterAdmission = '$userAdmission'");
            $countData1 = mysqli_num_rows($selData1);
            $_SESSION['userAdmission'] = $userAdmission;
            if($countData1>0)
            {
                echo "<script>alert('Welcome Back. View vote Results');window.location.assign('/user_candidate.php');</script>";
            }
            else
            {
                $selLog = mysqli_query($con, "SELECT * FROM tbl_users WHERE admission = '$userAdmission' AND logged_once = '0'");
                $countLog = mysqli_num_rows($selLog);
                if($countLog>0)
                {
                echo "<script>alert('Logged In, Please change your password');window.location.assign('/changePassword.php');</script>";
                }
                else
                {
                echo "<script>alert('Logged In, Please make a vote');window.location.assign('/vote.php');</script>";
                }
            }
      }
      else
      {
        echo "<script>alert('Invalid Details');history.back();</script>";
      }


    }
          ?>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      			<div class="form-group">
      				<label for="">Admission Number</label><br>
      				<input type="text" name="userAddNo" placeholder="Enter your Admission number" class="form-control"><br>

      				<label for="">Password</label><br>
      				<input type="password" name="userPass" class="form-control" placeholder="Enter your Password"><br>

      				<button type="submit" name="submit" class="btn btn-block span btn-primary" style="border-radius: 0%;">LOGIN</button>

              <label id="error"></label>
      			</div>

          </form>
          <br>

    		</div>
    		<div class="col-sm-4"></div>
    	</div>
    </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>