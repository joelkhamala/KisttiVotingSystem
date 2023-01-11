
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php
          if (session_status() === PHP_SESSION_NONE) {
              session_start();
          }
          if(isset($_SESSION['userAdmission']))
          {
            $hostname="localhost";
            $username= "kisiwaev";
            $password= "Nsasala2022";
            $database="kisiwaev_db_evoting";
            
            $con = mysqli_connect($hostname, $username, $password, $database);
              $userAdmission= $_SESSION['userAdmission'];

              $selectUser = mysqli_query($con, "SELECT * FROM votes_cast WHERE voterAdmission = '$userAdmission'");
              $countUser = mysqli_num_rows($selectUser);
        ?>
        <div class="navbar-header">
          <a href="#" class="navbar-brand text-lg">Kisiwa TTI Voting System</a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
          <?php
            if($countUser >= 1)
            {
                ?>
                <li><a href="user_candidate.php"><span class="subFont"><strong>Home/View Results</strong></span></a></li>
                <?php
            }
            else
            {
                ?>
                <li><a href="vote.php"><span class="subFont"><strong>Vote</strong></span></a></li>
                <?php
            }
          ?>
            <li><a href="changePassword.php"><span class="subFont"><strong>Change Password</strong></span></a></li>
            <li><a><span class="subFont pull-right">Welcome, Admission <?php echo $_SESSION['userAdmission']; ?>.</span></a></li>
          
          </ul>
          
          <?php
            echo '<span class="normalFont"><a href="logout.php" class="btn btn-danger navbar-right navbar-btn" style="border-radius:0%">Logout</a></span>';
          }
          else
          {
            ?>
            <div class="navbar-header">
          <a href="index.php" class="navbar-brand text-lg">Kisiwa TTI Voting System</a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php"><span class="subFont"><strong>Home</strong></span></a></li>
            <li><a href="about.php"><span class="subFont"><strong>About Us</strong></span></a></li>
            <li><a href="contact.php"><span class="subFont"><strong>Contact Us</strong></span></a></li>
          
          </ul>
            <?php
            echo '<span class="normalFont"><a href="userlogin.php" class="btn btn-info navbar-right navbar-btn" style="border-radius:0%">Login as User</a></span>';
            echo "&nbsp &nbsp";
            echo '<span class="normalFont"><a href="admin.php" class="btn btn-success navbar-right navbar-btn" style="border-radius:0%">Login as Admin</a></span> ';
            echo "&nbsp &nbsp";
          }
          ?>
          
        </div>

      </div> <!-- end of container -->
    </nav>