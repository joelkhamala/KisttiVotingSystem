<?php
session_start();

$conn = $con;
if(isset($_POST['update']))
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

$candidate_id = test_input($_POST['candidate_id']);
$candidate_name = test_input($_POST['candidate_name']);
$dateOfBirth = test_input($_POST['dateOfBirth']);
$residence = test_input($_POST['residence']);
$course = test_input($_POST['course']);
$candidate_department = test_input($_POST['candidate_department']);
$candidate_password = test_input($_POST['candidate_password']);
$candidate_category = test_input($_POST['candidate_category']);
$description = test_input($_POST['description']);
$images = test_input($_POST['image']);

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
        $image = htmlspecialchars( basename( $_FILES["photo"]["name"]));
    }
    else
    {
        $image = $images;
    }

  $updateQry = mysqli_query($con, "UPDATE candidates SET candidate_name = '$candidate_name', date_of_birth = '$dateOfBirth', residence = '$residence', candidate_password = '$candidate_password', candidate_category = '$candidate_category', candidate_department = '$candidate_department', course = '$course', course_name = '$course', description = '$description', image = '$image' WHERE candidate_id = '$candidate_id'");
  if($updateQry)
  {
    echo "<script>alert('Successfully updated candidate Details');history.back();</script>";
  }
  else
  {
    echo "<script>alert('Error updating candidate Details. Please try again');history.back();</script>";
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

    $id = test_input($_POST['id']);
    $full_name = test_input($_POST['full_name']);
    $username = test_input($_POST['username']);
    $admission = test_input($_POST['admission']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    $updateQry = mysqli_query($con, "UPDATE tbl_users SET full_name = '$full_name', username = '$username', admission = '$admission', email = '$email', password = '$password' WHERE id = '$id'");
  if($updateQry)
  {
    echo "<script>alert('Successfully updated Voter Details');history.back();</script>";
  }
  else
  {
    echo "<script>alert('Error updating Voter Details. Please try again');history.back();</script>";
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

    $id = test_input($_POST['id']);
    $select = mysqli_query($con, "SELECT * FROM tbl_users");
    if(mysqli_num_rows($select)>0)
    {
        $deleteSql = mysqli_query($con, "DELETE FROM tbl_users WHERE id='$id'");
        if($deleteSql)
        {
            echo "<script>alert('Successfully deleted Voter Details');history.back();</script>";
        }
        else
        {
            echo "<script>alert('Error deleting Voter Details');history.back();</script>";
        }
    }
}


elseif(isset($_POST['delete_candidate']))
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

    $id = test_input($_POST['cand_id']);
    $select = mysqli_query($con, "SELECT * FROM candidates");
    if(mysqli_num_rows($select)>0)
    {
        $deleteSql = mysqli_query($con, "DELETE FROM candidates WHERE candidate_id='$id'");
        if($deleteSql)
        {
            echo "<script>alert('Successfully deleted Candidate Details');history.back();</script>";
        }
        else
        {
            echo "<script>alert('Error deleting Candidate Details');history.back();</script>";
        }
    }
}
?>