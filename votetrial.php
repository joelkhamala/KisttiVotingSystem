<!DOCTYPE html>
<?php
session_start();
include("config.php");

if(isset($_POST['vote']))
{
    echo "<br><br><br><br><br>";
    if(isset($_SESSION['data']))
    {
        $dataAll = $_SESSION['data'];
        foreach($dataAll as $key => $value)
        {
            echo $value[$keys]."<br>";
        }
    }
    
    echo "<br>";
}
?>
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

      input[type="radio"] {
  vertical-align: middle;
  //display: inline-flex;
  //align-items: center;
}
    </style>


  </head>
  <body>
    
  <div class="container">
    <div class="container-fluid" style="padding-top:70px;">
      <div class="row">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
        <div class="col-sm-4">
            <?php
          $admission = $_SESSION['userAdmission'];
          $selectAllUsers = mysqli_query($con, "SELECT * FROM tbl_users WHERE admission = '$admission'");
          $fetchedData = mysqli_fetch_assoc($selectAllUsers);
          ?>
            <center><h3>Voter Details</h3></center>
            <label>Voter's Full Name :</label><br>
            <input type="text" class="form-control" value="<?php echo $fetchedData['full_name']; ?>" disabled/>
            <input type="hidden" name="voterName" value="<?php echo $fetchedData['full_name']; ?>">
            <br>

            <label>Voter's Registered Admission number :</label><br>
            <input type="text" value="<?php echo $_SESSION['userAdmission']; ?>" class="form-control" disabled/><br>
            <input type="hidden" name="voterAdmission" value="<?php echo $fetchedData['admission']; ?>">

            <label>Voter's Card Number :</label><br>
            <input type="number" value="<?php echo $fetchedData['voter_id']; ?>" class="form-control" disabled/><br>
            <input type="hidden" name="voterID" value="<?php echo $fetchedData['voter_id']; ?>">
        </div>
        <div class="col-sm-8" style="border:2px inset gray;">
          
          <div class="page-header">
            <h2 class="specialHead text-center">Choose Your Candidate!</h2>
          </div>
          <div class="form-group">           
            <h3 class="normalFont text-center">Select Any One of the Candidates in every section:</h3>
            <div class="radio">
            	<?php
            	$selCat = mysqli_query($con, "SELECT * FROM category_list");
            	?>
            <div class="row">
            	<?php
            	while($rowCat = mysqli_fetch_assoc($selCat))
            	{
            	?>
                <div class="col-md-6">
                <div class="panel panel-default">
                <div class="panel-heading"><center><?php $category = $rowCat['category']; echo ucwords(str_replace('_',' ',$category)); ?></center></div>
                <div class="panel-body">
                <?php
            $selCand = mysqli_query($con, "SELECT * FROM candidates WHERE candidate_category = '$category'");
            $countPres = mysqli_num_rows($selCand);
            if($countPres<1)
                {
                    echo "No candidate for ".ucwords(str_replace('_',' ',$category));
                }
                else
                {
                    $dataAll = array();
                foreach($selCand as $k => $rw)
                {
                    $candidate_name = $rw['candidate_name'];
                    $category = $rw['candidate_category'];
                    $dataAll['$category'] = $category;
                    $_SESSION['data'] = $dataAll;
                ?>
                <label for="">
                    <input type="radio" name="<?php echo $category; ?>" value="<?php echo $rw['candidate_name']; ?>" required> <img src="uploads/<?php echo $rw['image']; ?>" style="max-width:50px;height:50px"> <strong><?php echo $rw['candidate_name']; ?></strong>
                </label><br><br>
                <?php
                }
                }
              ?>
                </div>
            </div>
                </div>
                <?php
	        	}
	            ?>
            </div>
              <br>
              <button type="submit" name="vote" class="btn btn-success" style="border-radius:0%">Submit Votes</button>
              <button type="submit" class="btn btn-danger" style="border-radius:0%">Decline</button>
            </div>
          </div>
        </form>
        </div>
      </div>
      <br><br>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>