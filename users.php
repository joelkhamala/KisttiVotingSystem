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
	
	<div class="container-fluid">
  	<?php
    require_once("header.php");
    if(isset($_SESSION['admin']))
    {
    ?>

    
    <div class="container-fluid" style="padding-top:70px;">
    <h2 class="text-center">Voters Data</h2>
    <div class="row">
      
      <div class="col-sm-12 table-responsive"><br>
        <button type="button" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> &nbsp Add New Voter</button> <a href="excel_upload.php" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span> &nbspUpload Excel Data</a> &nbsp <a href="voter_download.php" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-save"></span> &nbsp Download Voter's Data</a><br><br>
        <table class="table table-bordered table-hover">
          
          <?php
include "config.php";

                      //Establish Connection
                        $conn= mysqli_connect($hostname, $username, $password, $database);

                        //Check
                        if(!$conn)
                        {
                          die("Connection Failed : ".mysqli_connect_error());
                        }
                                                  
                          $sql= "SELECT * FROM tbl_users";
                          $query= mysqli_query($conn, $sql);
                          $number_of_result = mysqli_num_rows($query);
                          if($number_of_result>0)
                            {

                                ?>
                            <tr>
            <th><strong>Voter's Full Name</strong></th>
            <th><strong>Admission Number</strong></th>
            <th><strong>Email Address</strong></th>
            <th><strong>Voter ID</strong></th>
            <th><strong>Ever Logged In?</strong></th>
            <th><strong>Action</strong></th>
          </tr>
                                <?php
                              //Pagination starts here
                              if (!isset ($_GET['page']) ) {  
                                  $page = 1;  
                              } else {  
                                  $page = $_GET['page'];  
                              }
                              $results_per_page = 10;  
                              $page_first_result = ($page-1) * $results_per_page;
                              //determine the total number of pages available  
                              $number_of_page = ceil ($number_of_result / $results_per_page);

                              $sql2= "SELECT * FROM tbl_users LIMIT " . $page_first_result . ',' . $results_per_page;
                              $query2= mysqli_query($conn, $sql2);

                              //Pagination Ends here
                              while($row= mysqli_fetch_assoc($query2))
                              {
                                $full_name= $row['full_name'];
                                $username = $row['username'];
                                $admission= $row['admission'];
                                $email= $row['email'];
                                $voter_id= $row['voter_id'];
                                $id = $row['id'];
                                $password = $row['password'];
                                $logged_in = $row['logged_once'];
                                if($logged_in == 1)
                                {
                                    $log = "Yes";
                                }
                                else
                                {
                                    $log = "No";
                                }
                                $action = '<button type="button" name="edit" id="edit" data-toggle="modal" data-target="#edit_data_Modal'.$id.'" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> &nbspEdit</button> &nbsp <button type="button" name="delete" id="delete" data-toggle="modal" data-target="#delete_data_Modal'.$id.'" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> &nbspDelete</button>';
                                $modal_edit = '
                                <div id="edit_data_Modal'.$id.'" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit Voter Details</h4>  
                </div>  
                <div class="modal-body" id="voter_detail">
                <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Voter Name</label>
              <input type="hidden" name="id" value="'.$id.'"/>
              <input type="text" name="full_name" value="'.$full_name.'" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>User Name</label>
              <input type="text" name="username" value="'.$username.'" class="form-control" required="required" />
            </div>
            <div class="form-group">
              <label>Admission</label>
              <input type="text" name="admission" value="'.$admission.'" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" value="'.$email.'" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="text" name="password" value="'.$password.'" class="form-control" required="required"/>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div> 
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                    <button name="edit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Update</button>
                </div>  
           </div>  
      </div>  
 </div>';
 $modal_add = '
                                <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit Voter Details</h4>  
                </div>  
                <div class="modal-body" id="voter_detail">
                <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Voter Name</label>
              <input type="text" name="full_name" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>User Name</label>
              <input type="text" name="username" class="form-control" required="required" />
            </div>
            <div class="form-group">
              <label>Admission</label>
              <input type="text" name="admission" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" required="required"/>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="text" name="password" class="form-control" required="required"/>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div> 
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                    <button name="add" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</button>
                </div>  
           </div>  
      </div>  
 </div>';
 $modal_delete = '<div id="delete_data_Modal'.$id.'" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Delete Voter Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">
                Are you sure you want to Delete Details for '.$full_name.'? 
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>  <button name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                </div>  
           </div>  
      </div>  
 </div> ';
                                echo "
                                  <tr>
                                      <td>$full_name</td>
                                      <td>$admission</td>
                                      <td>$email</td>
                                      <td>$voter_id</td>
                                      <td>$log</td>
                                      <td>
                                      <form action='update_candidate.php' method='POST'>
                                      ".$action.$modal_edit.$modal_delete."
                                      </form>
                                      <form action='add_user.php' method='POST'>
                                        ".$modal_add."
                                      </form>
                                      </td>
                                  </tr>   
                                ";
                              }
                              
          ?>
        </table>
        <?php
                              echo "Pages |";
                              for($page = 1; $page<= $number_of_page; $page++) {  
                                echo '<a href = "users.php?page=' . $page . '">' . $page . ' </a> |';
                              }
                              echo "<br><br>";
                            }
                            else
                            {
                                echo "<span class='alert alert-block alert-warning'>No results to display</span>";
                                echo "<br><br><a href='cpanel.php' class='btn btn-sm btn-primary'>Go Back</a>";
                            }
                          mysqli_close($conn);
        ?>
      </div>
    </div>
    
    </div>
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