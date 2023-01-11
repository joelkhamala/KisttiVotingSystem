
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
          if(isset($_SESSION['admin']))
          {
        ?>
        <div class="navbar-header">
          <a href="cpanel.php" class="navbar-brand text-lg">Kisiwa TTI Voting System</a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
            <li><a href="cpanel.php"><span class="subFont"><strong>Home</strong></span></a></li>
            <li><a href="nomination.php"><span class="subFont"><strong>Add Candidate</strong></span></a></li>
            <li><a href="add_category.php"><span class="subFont"><strong>Add/Edit Category</strong></span></a></li>
            <li><a href="candidates.php"><span class="subFont"><strong>View/Edit Candidates</strong></span></a></li>
            <li><a href="users.php"><span class="subFont"><strong>View/Edit Voters</strong></span></a></li> 
            <li><a href="changePassword.php"><span class="subFont"><strong>Change Password</strong></span></a></li>
          
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