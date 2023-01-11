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
    <?php include "header_user.php"; ?>

    <div class="container" style="padding-top:70px;padding-bottom:50px;">
      <div class="row">
        <div class="col-sm-12" style="border:2px outset gray;">
          
          <div class="page-header text-center">
            <h2 class="specialHead">POLL RESULTS</h2>
            <p class="normalFont">Displaying all voting results</p>
          </div>
          <div class="col-sm-12">
            <?php
                $conn = mysqli_connect($hostname, $username, $password, $database);
              if(!$conn)
              {
                echo "Error While Connecting.";
              }
              else
              {
                //select All records
                $selAll = mysqli_query($conn, "SELECT * FROM candidates ORDER By category_id");
                $numRows = mysqli_num_rows($selAll);
                $i = 1;


                if($numRows<=0)
                {
                    echo "<span class='alert alert-block alert-warning'>No results to display</span>";
                    echo "<br><br>";
                }
                else
                {
                    while($roow = mysqli_fetch_assoc($selAll))
                    {
                    $candidate_name = $roow['candidate_name'];
                    $candidate_id=$roow['candidate_id'];
                    $sql ="SELECT * FROM votes_cast";
                    $result= mysqli_query($conn, $sql);
                    $total = mysqli_num_rows($result);

                    if(mysqli_num_rows($result)>0)
                    {
                        $candidateInit = intval($roow['votes']);

                        $c_value= (($candidateInit)/$total)*100;
                        if($i == 1)
                        {
                            $class = "progress-bar-success";
                        }
                        elseif($i == 2)
                        {
                            $class = "progress-bar-info";
                        }
                        elseif($i == 3)
                        {
                            $class = "progress-bar-danger";
                        }
                        elseif($i == 4)
                        {
                            $class = "progress-bar-warning";
                        }
                        elseif($i == 5)
                        {
                            $class = "progress-bar-striped progress-bar-success";
                        }
                        elseif($i == 6)
                        {
                            $class = "progress-bar-striped progress-bar-info";
                        }
                        elseif($i == 7)
                        {
                            $class = "progress-bar-striped progress-bar-danger";
                        }
                        elseif($i == 8)
                        {
                            $class = "progress-bar-striped progress-bar-warning";
                        }
                        elseif($i == 9)
                        {
                            $class = "progress-bar-success";
                        }
                        elseif($i == 10)
                        {
                            $class = "progress-bar-info";
                        }
                        elseif($i == 11)
                        {
                            $class = "progress-bar-warning";
                        }

                        echo "<strong>".$candidate_name." - ".strtoupper(str_replace("_", " " ,$roow['candidate_category'])) ."</strong><br>";
                        echo "
                        <div class='progress'>
                            <div class='progress-bar ".$class."' role='progressbar' aria-valuenow=\"$c_value\" aria-valuemin=\"0\" aria-valuemax=\"100\" style='width: ".$c_value."%'>".round($c_value,2)."%
                            <span class='sr-only'>JM</span>
                            </div>
                        </div>
                        ";

                        echo "<hr>";

                        $total=mysqli_num_rows($result);
                        $totalPercent= (($candidateInit)/$total)*100;
                        echo "
                        <div class='text-primary text-center'>
                            <h3 class='normalFont'>TOTAL VOTES FOR $candidate_name : $candidateInit/$total </h3>
                        </div>
                        ";
                        echo "<br>";

                    }
                    else
                    {
                        echo "<div class='alert alert-warning'>No results to display</div>";
                    }

                    $i++;
                    }


              }
              }
            ?>
          </div>

        </div>
      </div>
    </div>
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
