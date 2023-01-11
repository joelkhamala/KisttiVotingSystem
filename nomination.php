<!DOCTYPE html>
<?php
session_start();
$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";

$con = mysqli_connect($hostname, $username, $password, $database);
  
if(isset($_POST['submit']))
{
$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";

  $con = mysqli_connect($hostname, $username, $password, $database);
//UserInput Test
function testInput($data) {
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

$candidateName = testInput($_POST['candidateName']);
$candidateCategory = testInput($_POST['candidateCategory']);
$category_id = testInput($_POST['category_id']);
$candidatePassword = testInput($_POST['candidatePassword']);
$dateOfBirth = testInput($_POST['dateOfBirth']);
$residence = testInput($_POST['residence']);
$voterid = testInput($_POST['voterid']);
$department = testInput($_POST['department']);
$course = testInput($_POST['course']);
$levelOfStudy = testInput($_POST['levelOfStudy']);
$description = testInput($_POST['description']);
$disability = testInput($_POST['disability']);

$selectCat = mysqli_query($con, "SELECT * FROM category_list WHERE category = '$candidateCategory'");
$rowCat = mysqli_fetch_assoc($selectCat);

$category_id = $rowCat['id'];

$selectQry = mysqli_query($con, "SELECT * FROM candidates WHERE candidate_name = '$candidateName'");
$countQry = mysqli_num_rows($selectQry);
if($countQry>0)
{
  echo "<script>alert('candidate exists');history.back();</script>";
}
else
{
// Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("uploads/" . $filename)){
                echo $filename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $filename);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }


$image = htmlspecialchars( basename( $_FILES["photo"]["name"]));

  $insertQry = mysqli_query($con, "INSERT INTO candidates (candidate_name, date_of_birth, residence, course, candidate_password, candidate_category, category_id, candidate_department, course_name, level_of_study, description,disability, image) VALUES ('$candidateName', '$dateOfBirth','$residence','$course', '$candidatePassword', '$candidateCategory', '$category_id', '$department', '$course', '$levelOfStudy', '$description', '$disability', '$image')");
  if($insertQry)
  {
    echo "<script>alert('Successfully added candidate');history.back();</script>";
  }
  else
  {
    echo "<script>alert('Error adding candidate. Please try again');history.back();</script>";
  }
}
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
    </style>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	
	<div class="container">
  	<?php
    include "config.php";
    require_once("header.php");
    if(isset($_SESSION['admin']))
    {
    ?>
    <div class="container" style="padding-top:70px;">
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10  bg-success" style="border:2px solid gray;padding:50px;">
          
          <div class="page-header">
            <h2 class="specialHead text-center">Add Candidate</h2>
          </div>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                <label for="">Candidate Name</label><br>
                <select name="candidateName" class="form-control" required="required">
                  <option value="">
                    --SELECT CANDIDATE--
                  </option>
                  <?php
                  $sel = mysqli_query($con, "SELECT * FROM tbl_users");
                  while ($rowCand = mysqli_fetch_assoc($sel)) {
                    ?>
                    <option value="<?php echo $rowCand['full_name']; ?>">
                      <?php echo $rowCand['full_name']; ?>
                    </option>
                    <?php
                  }
                  ?>
                </select><br>
              </div>
              <div class="col-md-4">
                <label for="candidateCategory">Candidate Category</label><br>
                <select name="candidateCategory" class="form-control" required="required">
                  <option value="">
                    --SELECT CANDIDATE CATEGORY--
                  </option>
                  <?php
                  $sel = mysqli_query($con, "SELECT * FROM category_list");
                  while ($rowCand = mysqli_fetch_assoc($sel)) {
                    ?>
                    <option value="<?php echo $rowCand['category']; ?>">
                      <?php echo ucwords(str_replace('_', ' ', $rowCand['category'])); ?>
                    </option>
                    <?php
                  }
                  ?>
                </select>
              </div>

              <div class="col-md-4">
                <label for="">Candidate Password</label><br>
                <input type="text" name="candidatePassword" class="form-control" placeholder="Enter candidates Password"><br>
              </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label>Date of Registration</label>
                  <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
                  <input type="hidden" name="dateOfBirth" value="<?php echo date('Y-m-d'); ?>">
                  <br>
                </div>
                <div class="col-md-4">
                  <label>Hostel</label>
                                  <select id="residence" name="residence" class="form-control" required>
                                    <option value="" selected>Choose Hostel of Residence ...</option>
                                    <option value="hostel_1">Hostel 1</option>
                                    <option value="hostel_2">Hostel 2</option>
                                    <option value="hostel_3">Hostel 3</option>
                                    <option value="hostel_4">Hostel 4</option>
                                    <option value="hostel_5">Hostel 5</option>
                                  </select>
                </div>
                <div class="col-md-4">
                  <label>Candidate Admission Number</label>
                  <select name="voterid" class="form-control" required="required">
                  <option>
                    --SELECT ADMISSION--
                  </option>
                  <?php
                  $sel = mysqli_query($con, "SELECT * FROM tbl_users");
                  while ($rowCand = mysqli_fetch_assoc($sel)) {
                    ?>
                    <option value="<?php echo $rowCand['admission']; ?>">
                      <?php echo $rowCand['admission']; ?>
                    </option>
                    <?php
                  }
                  ?>
                </select><br>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label>Department</label>
                  <select name="department" class="form-control" required="required">
                  <option>
                    --SELECT DEPARTMENT--
                  </option>
                  <option value="ICT">
                    ICT
                  </option>
                  <option value="HIM">
                    HIM
                  </option>
                  <option value="AUTOMOTIVE">
                    AUTOMOTIVE
                  </option>
                  <option value="AGRICULTURE">
                    AGRICULTURE
                  </option>
                  <option value="BUILDING">
                    BUILDING
                  </option>
                  <option value="BUSINESS">
                    BUSINESS
                  </option>
                  <option value="ELECTRICAL">
                    ELECTRICAL
                  </option>
                  </select><br>
                </div>
                <div class="col-md-4">
                  <label>Course</label>
                  <select name="course" class="form-control" required="required">
                  <option>
                    --SELECT COURSE--
                  </option>
                  <option value="dict">
                    DIP IN ICT
                  </option>
                  <option value="cict">
                    CERT IN ICT
                  </option>
                  <option value="dfb">
                    DIP IN FOODS AND BEVERAGE
                  </option>
                  <option value="cfb">
                    CERT IN FOODS AND BEVERAGE
                  </option>
                  <option value="dga">
                   DIP. IN AGRICULTURE
                  </option>
                  <option value="cga">
                   CERT. IN AGRICULTURE
                  </option>
                  <option value="dbt">
                   DIP. IN BUILDING
                  </option>
                  <option value="cbt">
                   CERT. IN BUILDING
                  </option>
                  <option value="dee">
                   DIP. IN ELECRTICAL
                  </option>
                  <option value="cee">
                    CERT IN ELECTRICAL
                  </option>
                  <option value="dfd">
                    DIP IN FASHION
                  </option>
                  <option value="cfd">
                    CERT IN FASHION
                  </option>
                  <option value="dss">
                    DIP IN SECRETARIAL
                  </option>
                  <option value="css">
                    CERT IN SECRETARIAL
                  </option>
                  <option value="dae">
                    DIP IN AUTOMOTIVE
                  </option>
                  <option value="cae">
                    CERT IN AUTOMOTIVE
                  </option>
                </select>
                </div>
                <div class="col-md-4">
                  <label>Level of Study</label>
                  <select name="levelOfStudy" class="form-control" required="required">
                  <option>
                    --SELECT Level--
                  </option>
                  <option value="mod2">
                    Module 2
                  </option>
                  <option value="mod3">
                    Module 3
                  </option>
                  <option value="schoolbased">
                   School Based
                  </option>
                </select><br>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label for="">Candidate Image</label>
                  <input type="file" name="photo" class="form-control"><br>
                </div>
                <div class="col-md-4">
                  <label for="">Disability</label>
                  <div class="radio"> &nbsp
                  Are you disabled?
                    <label><input type="radio" name="disability" value="Yes"> Yes</label> &nbsp
                    <label><input type="radio" name="disability" value="No" checked> No</label>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="">Candidate Description</label>
                  <textarea rows="5" name="description" class="form-control" maxlength="300"></textarea><br>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                   <button type="submit" name="submit" class="btn btn-block btn-primary" style="border-radius: 0%;">Add Candidate</button>
                </div>
              </div>

              <label id="error"></label>
            </div>

          </form>
          <br>

        </div>
        <div class="col-sm-1"></div>
      </div>
    </div>
    <br><br>
    <?php
    }
    else
    {
        echo "<script>alert('Not logged in. Please login to access the page');window.location.assign('/');</script>";
    }
    ?>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>