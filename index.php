
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Kisiwa TTI Student Voting System</title>
    <link rel = "icon" href = "images/logo.png" type = "image/x-icon">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>

    body{
      margin:0px;
      padding:0px;
    }
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

      a {
        color: #FFFFFF;
        text-decoration: none;
      }

      a:link {
        color: #FFFFFF;
        text-decoration: none;
      }

      /* visited link */
      a:visited {
          color: #FFFFFF;
          text-decoration: none;
      }

      /* mouse over link */
      a:hover {
          color: #FFFFFF;
          text-decoration: none;
      }

      /* selected link */
      a:active {
          color: #FFFFFF;
          text-decoration: none;
      }
    </style>

  </head>
  <body>
	
	<div class="container-fluid">
  	<?php require_once("header.php"); ?>
    <style type="text/css">
      .jumbotron1 {
      background-image: url("images/wp4477743-plain-green-wallpapers.jpg");
      background-size: cover;
    }
    </style>

      <div class="container-fluid1">
        <div class="row">
          <div class="col-sm-12 container-fluid">
            <div class="jumbotron1 text-center text-block container-fluid" style="padding-top:170px;">
              
              <img src="images/vote_trans.png" width="220px" alt="Icon">
                  <h1 class="specialHead"><img src="images/logo.png" width="55px" style="margin-top: -10px;">&nbspKisiwa TTI Student Voting System</h1>
                  <p class="normalFont">Safe . Reliable . Secure . Fast </p>

                  <a href="userlogin.php" class="btn btn-danger btn-lg specialHead" style="border-radius:60px"> <span class="glyphicon glyphicon-folder-close"></span> Login and Cast Your Votes Now</a>
                  <br><br><br>
            </div>
          </div>
        </div>
      </div>

      <div class="container" id="featuresTab">
        <div class="row">
          <div class="col-sm-12 text-left">
            <div class="page-header" style="padding-top:50px;padding-bottom:50px">
              <h1 class="normalFont" style="font-size:44px;" >AIMS OF THE SYSTEM</h1>
              <p class="subFont" style="font-size:24px;">A Interactive Way To Solve Conventional Voting Issues</p>
              <ol>
                <li>
                To  reduce instances of violence associated with suspicion between students and administration during students elections in colleges
                </li>
                <li>
                To contain on costs associated with undertaking of students election when Electoral Commission is hired to oversee the Election so that they can be used to improve on other aspects of education in college
                </li>
                <li>
                To reduce time wasted by students and other election officials on queuing to vote and tallying  of votes during elections
                </li>
                <li>
                To help curb the spread of covid-19 pandemic in colleges 
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="conatiner" style="padding:50px;" id="aboutTab">
        <div class="row">

          

          <div class="col-sm-4 text-center">
            
            <img src="images/Nominee.png" width="100" height="100" alt=""/>
            <h2 class="normalFont" style="font-size:28px;">VOTE ONLINE.</h2>
            <p>You Just Need Basic Details And We Will Let You Vote</p>

          </div>
          <div class="col-sm-4 text-center">

            <img src="images/Vote.png" width="100" height="100" alt=""/>
            <h2 class="normalFont" style="font-size:28px;" >NOMINATION</h2>
            <p>Admin's Control Panel allows you to manage the list of Candidates</p>

          </div>
          <div class="col-sm-4 text-center"> 
            
            <img src="images/Stats.png" width="100" height="100" alt=""/>
            <h2 class="normalFont" style="font-size:28px;" >Statitics</h2>
            <p>Shows You a Graphical Data Representation of your votes from the Admin's Control Panel</p>

          </div>

         
        </div>
      </div>
        <hr>
        
      
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
             <h3 class="specialHead">Developed By Martin Wekesa And Ajala Vincent</h3>
             <h4 class="specialHead">Under Supervision of Madam Neddy Sasala</h4>
             <br>
            </div>
            <div class="col-sm-12 text-center">
              <img src="images/Facebook.png" width="50" height="50" alt="">
              <img src="images/Twitter.png" width="50" height="50" alt="">
              <img src="images/GitHub.png" width="50" height="50" alt="">
              <br>
              <br>
            </div>

          </div>
        </div>
      </footer>
    
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
