
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
  <body>
	
	<div class="container">
  	<?php
                        
      require_once("header_user.php"); ?>

    
    <div class="container" style="padding-top:150px;">
    	<div class="row">
    		<div class="col-sm-4"></div>
    		<div class="col-sm-4 text-center" style="border:2px solid gray;padding:50px;">
    			
    			<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
                    {
include "config.php";
$conn = $con;
$voterName = test_input($_POST['voterName']);
$voterAdmission = test_input($_POST['voterAdmission']);
$voterID = test_input($_POST['voterID']);
$selectedCandidatep = test_input($_POST['selectedCandidatep']);
$selectedCandidatevp = test_input($_POST['selectedCandidatevp']);
$selectedCandidatesg = test_input($_POST['selectedCandidatesg']);
$selectedCandidatec = test_input($_POST['selectedCandidatec']);
$selectedCandidateos = test_input($_POST['selectedCandidateos']);
$selectedCandidatese = test_input($_POST['selectedCandidatese']);
$selectedCandidatet = test_input($_POST['selectedCandidatet']);
$selectedCandidates = test_input($_POST['selectedCandidates']);
                

	

$conn= mysqli_connect($hostname,$username,$password,$database) or die("Couldn't Connect to Database :");
				
$selectData = mysqli_query($conn, "SELECT * FROM votes_cast WHERE voterAdmission = '$voterAdmission'");
$count = mysqli_num_rows($selectData);

        if($count>0)
        {
          echo "<script>alert('You already casted your vote. You can only vote once'); window.location.assign('/user_candidate.php');</script>";
        }
        else
        {
				$sql= "INSERT INTO votes_cast (voterName,voterAdmission,voterID,selectedCandidatep,selectedCandidatevp,selectedCandidatesg,selectedCandidatec,selectedCandidateos,selectedCandidatese,selectedCandidatet,selectedCandidates)  VALUES('$voterName','$voterAdmission','$voterID','$selectedCandidatep','$selectedCandidatevp','$selectedCandidatesg','$selectedCandidatec','$selectedCandidateos','$selectedCandidatese','$selectedCandidatet','$selectedCandidates')";
					
  				if(mysqli_query($conn, $sql)){
                      $selectCandidatep = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_name = '$selectedCandidatep'");
                      $rwo = mysqli_fetch_assoc($selectCandidatep);
                      $votesp = $rwo['votes'];
                      $votep = $votesp + 1;
                      $update1 = mysqli_query($conn, "UPDATE candidates SET votes = $votep WHERE candidate_name = '$selectedCandidatep'");

                      $selectCandidatevp = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_name = '$selectedCandidatevp'");
                      $rwo2 = mysqli_fetch_assoc($selectCandidatevp);
                      $votesvp = $rwo2['votes'];
                      $votevp = $votesvp + 1;
                      $update2 = mysqli_query($conn, "UPDATE candidates SET votes = $votevp WHERE candidate_name = '$selectedCandidatevp'");

                      $selectCandidatesg = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_name = '$selectedCandidatesg'");
                      $rwo3 = mysqli_fetch_assoc($selectCandidatesg);
                      $votessg = $rwo3['votes'];
                      $votesg = $votessg + 1;
                      $update3 = mysqli_query($conn, "UPDATE candidates SET votes = $votesg WHERE candidate_name = '$selectedCandidatesg'");

                      $selectCandidatec = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_name = '$selectedCandidatec'");
                      $rwo4 = mysqli_fetch_assoc($selectCandidatec);
                      $votesc = $rwo4['votes'];
                      $votec = $votesc + 1;
                      $update4= mysqli_query($conn, "UPDATE candidates SET votes = $votec WHERE candidate_name = '$selectedCandidatec'");

                      $selectCandidatese = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_name = '$selectedCandidatese'");
                      $rwo5 = mysqli_fetch_assoc($selectCandidatese);
                      $votesse = $rwo5['votes'];
                      $votese = $votesse + 1;
                      $update5 = mysqli_query($conn, "UPDATE candidates SET votes = $votese WHERE candidate_name = '$selectedCandidatese'");

                      $selectCandidateos= mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_name = '$selectedCandidateos'");
                      $rwo6 = mysqli_fetch_assoc($selectCandidateos);
                      $votesos = $rwo6['votes'];
                      $voteos = $votesos + 1;
                      $update6 = mysqli_query($conn, "UPDATE candidates SET votes = $voteos WHERE candidate_name = '$selectedCandidateos'");

                      $selectCandidatet = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_name = '$selectedCandidatet'");
                      $rwo7 = mysqli_fetch_assoc($selectCandidatet);
                      $votest = $rwo7['votes'];
                      $votet = $votest + 1;
                      $update7 = mysqli_query($conn, "UPDATE candidates SET votes = $votet WHERE candidate_name = '$selectedCandidatet'");

                      $selectCandidates = mysqli_query($conn, "SELECT * FROM candidates WHERE candidate_name = '$selectedCandidates'");
                      $rwo8 = mysqli_fetch_assoc($selectCandidates);
                      $votess = $rwo8['votes'];
                      $votes = $votess + 1;
                      $update8 = mysqli_query($conn, "UPDATE candidates SET votes = $votes WHERE candidate_name = '$selectedCandidates'");

                      if($update1 && $update2 && $update3 && $update4 && $update5 && $update6 && $update7 && $update8)
                      {
                         echo "<img src='images/success.png' width='70' height='70'>";
  					    echo "<h3 class='text-info specialHead text-center'><strong> YOU'VE  VOTED   SUCCESSFULLY!</strong></h3>";
  					    echo "<a href='user_candidate.php' class='btn btn-primary' style='border-radius:0%'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a>"; 
                      }
  					
  				}
  				else
  				{
  					echo "<img src='images/error.png' width='70' height='70'>";
  					echo "<h3 class='text-info specialHead text-center'><strong> SORRY! WE'VE SOME ISSUE..</strong></h3>";
  					echo "<a href='vote.php' class='btn btn-primary'> <span class='glyphicon glyphicon-ok'></span> <strong> Finish</strong> </a>";
  				}
				}
			}

				?>

				
    			
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


