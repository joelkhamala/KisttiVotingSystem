<!DOCTYPE html>
<?php
session_start();
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
      /* width */
::-webkit-scrollbar {
  width: 0px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: grey; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
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
	
	<div class="container-fluid">
  	<?php
      if(isset($_SESSION['admin']))
    {
$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";

$con = mysqli_connect($hostname, $username, $password, $database);
    require_once("header.php");
    ?>
    <div class="container" style="padding-top:70px; padding-bottom: 50px;">
      <?php
      $Sel = mysqli_query($con, "SELECT * FROM candidates");
      $cnt = mysqli_num_rows($Sel);
      if($cnt<=0)
      {
          echo "<span class='alert alert-block alert-warning'>No results to display</span>";
          echo "<br><br><a href='cpanel.php' class='btn btn-sm btn-primary'>Go Back</a>";
      }
      else
      {
          echo "<center><h2><b>Candidates on Ballot</b></h2></center>";
          echo '<a href="candidate_downloader.php" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-save"></span> &nbsp Download All Candidates Data</a><br><br>';
      $rowscnt = $cnt/3;
      $rowscnt = ceil($rowscnt);
      for($i=1;$i<=$rowscnt; $i++)
      {
      ?>
      <div class="row">
        <?php
        for($y=0;$y<=3;$y++)
        {
            while($row = mysqli_fetch_assoc($Sel))
            {
        ?>
        <div class="col-sm-3">
          <center><img src="uploads/<?php echo $row['image']; ?>" class="img img-thumbnail" style="width:200px;height:200px;" alt=""></center>
          <h4 class="normalFont text-center"><?php echo $row['candidate_name']; ?></h4>
          <h5 class="normalFont text-center">Vying for: <b><?php echo ucwords(str_replace('_',' ',$row['candidate_category'])); ?></b></h5>
          <h5 class="normalFont text-center" style="height: 110px; overflow: scroll;"><?php echo $row['description']; ?></h5>
          <div style="border-bottom: 1px solid #ccccccd2;"></div><br>
          <ul class="normalFont text-left">
            <li>Registration Date: <?php echo $row['date_of_birth']; ?></li>
            <li>Hostel: <?php echo $row['residence']; ?></li>
            <li>Course: <?php echo $row['course']; ?></li>
            <li>Parents: Mr. & Mrs. <?php echo substr(strstr($row['candidate_name']," "), 1); ?></li>
          </ul>
          <button class="btn btn-primary btn-sm" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['candidate_id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit Details</button> &nbsp <button type="button" name="delete" id="delete" data-toggle="modal" data-target="#delete_data_Modal<?php echo $row['candidate_id'];?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> &nbspDelete Candidate</button>

        <br><br>
<div class="modal fade" id="update_modal<?php echo $row['candidate_id'];?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="update_candidate.php">
        <div class="modal-header">
          <h3 class="modal-title">Update Candidate</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Candidate Name</label>
              <input type="hidden" name="candidate_id" value="<?php echo $row['candidate_id']?>"/>
              <input type="text" name="candidate_name" value="<?php echo $row['candidate_name']?>" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Date of Birth</label>
              <input type="text" name="dateOfBirth" value="<?php echo $row['date_of_birth'];?>" class="form-control" required="required" />
            </div>
            <div class="form-group">
              <label>Hostel</label>
              <input type="text" name="residence" value="<?php echo ucwords(str_replace("_", " ", $row['residence']));?>" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Course</label>
              <input type="text" name="course" value="<?php echo $row['course_name'];?>" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Department</label>
              <input type="text" name="candidate_department" value="<?php echo $row['candidate_department'];?>" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="text" name="candidate_password" value="<?php echo $row['candidate_password'];?>" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Category</label>
              <input type="text" name="candidate_category" value="<?php echo $row['candidate_category'];?>" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea rows="5"  name="description" value="<?php echo $row['description'];?>" class="form-control" required="required"><?php echo $row['description'];?></textarea>
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="hidden" name="image" value="<?php echo $row['image'];?>"/>
              <input type="file" name="photo" class="form-control">
            </div>

          </div>

        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
          <button name="update" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Update</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        </div>
    	</form>
        </div>
    </div>
  </div>

<form action="update_candidate.php" method="POST">
  <div id="delete_data_Modal<?php echo $row['candidate_id'];?>" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Delete Voter Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">
                <input type="hidden" name="cand_id" value="<?php echo $row['candidate_id'];?>">
                Are you sure you want to Delete Details for <?php echo $row['candidate_name'];?>? 
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>  <button name="delete_candidate" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                </div>  
           </div>  
      </div>  
 </div>
 </form>

        </div>
        <?php
            }
        }
        ?>
      </div>
      


        <?php
    }
      }
      }
    else
    {
        echo "<script>alert('Not logged in. Please login to access the page');window.location.assign('/');</script>";
    }
      ?>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>