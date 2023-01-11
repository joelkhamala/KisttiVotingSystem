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
    <div class="container" style="padding-top:70px;">
    <h4 class="text-center">Upload Voters Data</h4>
    <div class="row">
    <?php
    error_reporting(0);
    require_once("header.php");
    require('PHPExcel/php-excel-reader/excel_reader2.php');
    require('PHPExcel/SpreadsheetReader.php');
    require('vendor/autoload.php');
$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";
$mysqli = new mysqli($hostname, $username, $password, $database);

if(isset($_POST['Submit'])){

  $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','text/xlsm','text/xltx','text/xltm','text/xlsb','text/xlam','text/xla','application/vnd.oasis.opendocument.spreadsheet'];
  if(in_array($_FILES["file"]["type"],$mimes)){


    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);


    $Reader = new SpreadsheetReader($uploadFilePath);


    $totalSheet = count($Reader->sheets());


    echo "You have total ".$totalSheet." sheets";

    $success = 0;
    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);


      foreach ($Reader as $Row)
      {
        $fullname = isset($Row[0]) ? $Row[0] : '';
        $username = isset($Row[1]) ? $Row[1] : '';
        $admission = isset($Row[2]) ? $Row[2] : '';
        $email = isset($Row[3]) ? $Row[3] : '';
        $voter_id = isset($Row[4]) ? $Row[4] : '';
        $password = isset($Row[5]) ? $Row[5] : '';

      $selectData = "SELECT * FROM tbl_users WHERE admission = '$admission'";
      $mysqli->query($selectData);
        if($selectData)
        {
            $query = "INSERT INTO tbl_users(full_name, username, admission, email, voter_id,voted_for, password) VALUES('$fullname','$username','$admission','$email','$voter_id',NULL,'$password')";
            $send = $mysqli->query($query);
            if($mysqli->error)
            {
              continue;
            }

            if($send)
            {
              $success = $success + 1;
            }
            
        }
       }


    }
    if($success>0)
    {
      echo "<script>alert('Data Inserted in database');windows.location.assign('/kisiwavoting/excel_upload.php');</script>";
    }
    else
    {
      echo "<script>alert('Excel File has already been uploaded');windows.location.assign('/kisiwavoting/excel_upload.php');</script>";
    }   

  }
  else
  { 
    die("<script>alert('Sorry, File type is not allowed. Only Excel file.');windows.location.assign('/kisiwavoting/excel_upload.php');</script>"); 
  }


}


?>
      
      <div class="col-sm-12">
        <div class="container">
        <h1>Excel Upload</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label>Upload Excel File</label>
            <input type="file" name="file" class="form-control" required>
          </div>
          <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
          </div>
        </form>
      </div>
      <?php
      $selectAll = "SELECT * FROM tbl_users";
      $data = $mysqli->query($selectAll);

      echo "Uploaded Data<br><br>";
      echo "<table border='1' class='table'>";
      echo "<tr><thead class='thead-dark'><th>Full Names</th><th>User Name</th><th>Email</th><th>Voter ID</th><th>Password</th></thead></tr>";

      while($rows=$data->fetch_assoc())
      {
        echo "<tr><td>".$rows['full_name']."</td><td>".$rows['username']."</td><td>".$rows['email']."</td><td>".$rows['voter_id']."</td><td>".$rows['password']."</td></tr>";
      }
      ?>
      </div>
    </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>