<!DOCTYPE html>
<?php
session_start();
$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";
$con = mysqli_connect($hostname, $username, $password, $database);

if(isset($_POST['add']))
{
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


$category = test_input($_POST['category']);
$category = strtolower(str_replace(' ', '_', $category));
$sel = mysqli_query($con, "SELECT * FROM category_list WHERE category = '$category'");
$count = mysqli_num_rows($sel);
if($count>0)
{
    echo "<script>alert('Category Already Exists');history.back();</script>";
}
else
{
    $insertData = mysqli_query($con, "INSERT INTO category_list (category) VALUES ('$category')");
    if($insertData)
    {
        echo "<script>alert('Category Inserted successfully');history.back();</script>";
    }
    else
    {
        echo "<script>alert('Error');history.back();</script>";
    }
}
}
elseif(isset($_POST['edit']))
{
$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";
$con = mysqli_connect($hostname, $username, $password, $database);

// UserInput Test
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


    $id = testInput($_POST['id']);
    $category = testInput($_POST['category']);
    $category = strtolower(str_replace(' ', '_', $category));

    $sel = mysqli_query($con, "SELECT * FROM category_list WHERE id = '$id'");
    $count = mysqli_num_rows($sel);
    if($count>0)
    {
        $updateData = mysqli_query($con, "UPDATE category_list SET category = '$category' WHERE id='$id'");
        if($updateData)
        {
            echo "<script>alert('Category Updated successfully');history.back();</script>";
        }
        else
        {
            echo "<script>alert('Error Updating. Try Again');history.back();</script>";
        }
    }
    else
    {
    echo "<script>alert('Record Not Found. Try Again');history.back();</script>";   
    }  
}

elseif(isset($_POST['delete']))
{
$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";
$con = mysqli_connect($hostname, $username, $password, $database);

// UserInput Test
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

    $id = testInput($_POST['id']);

    $sel = mysqli_query($con, "SELECT * FROM category_list");
    $count = mysqli_num_rows($sel);
    if($count>1)
    {
        $deleteData = mysqli_query($con, "DELETE FROM category_list  WHERE id='$id'");
        if($deleteData)
        {
            echo "<script>alert('Category Deleted successfully');history.back();</script>";
        }
        else
        {
            echo "<script>alert('Error Deleting. Try Again');history.back();</script>";
        }
    }
    else
    {
        $deleteData = mysqli_query($con, "TRUNCATE category_list");
        if($deleteData)
        {
            echo "<script>alert('Table Truncated');history.back();</script>";
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
    if(isset($_SESSION['admin']))
    {
    require_once("header.php");
    ?>
    <div class="container-fluid" style="padding-top: 100px;">
    
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-6">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="manage-category">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            Category Form
                    </div>
                    <div class="panel-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">Add Candidate Category</label>
                                <input type="text" class="form-control" name="category" required>
                            </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" name="add"><span class="glyphicon glyphicon-ok"></span> Save</button> &nbsp <button class="btn btn-danger" type="button" onclick="$('#manage-category').get(0).reset()"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $cats = $con->query("SELECT * FROM category_list order by id asc");
                                while($row=$cats->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="text-center"><?php echo ucwords(str_replace('_', ' ', $row['category'])); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-info" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['id'];?>"><span class="glyphicon glyphicon-edit"></span></button>
                                        <button class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete_modal<?php echo $row['id'];?>"><span class="glyphicon glyphicon-trash"></span></button>
                                    </td>
                                </tr>
<div class="modal fade" id="update_modal<?php echo $row['id'];?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="modal-header">
          <h3 class="modal-title">Edit Category</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Category Name</label>
              <input type="hidden" name="id" value="<?php echo $row['id']?>"/>
              <input type="text" name="category" value="<?php echo ucwords(str_replace('_',' ',$row['category']));?>" class="form-control" required="required"/>
            </div>

          </div>

        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
          <button name="edit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        </div>
    	</form>
        </div>
    </div>
  </div>


  <div class="modal fade" id="delete_modal<?php echo $row['id'];?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="modal-header">
          <h3 class="modal-title">Delete Category</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <input type="hidden" name="id" value="<?php echo $row['id']?>"/>
              <p>Are you sure you want to Delete category <b><?php echo ucwords(str_replace("_", " ", $row['category']));?></b>?</p>
            </div>

          </div>

        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
          <button name="delete" class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span> Delete</button>
          <button class="btn btn-default" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        </div>
    	</form>
        </div>
    </div>
  </div>

                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
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