<!doctype html>
<?php
include("config.php");
session_start();
$id = $_SESSION['id'];

$requete = "SELECT DISTINCT us.Firstname, us.Lastname, us.description, us.ProfilePicture, us.position, us.Pseudo FROM users us WHERE us.ID = ?";

//echo $requete;

$req = mysqli_prepare($db, $requete);
mysqli_stmt_bind_param($req, "i", $id);
mysqli_stmt_execute($req);

mysqli_stmt_store_result($req);

mysqli_stmt_bind_result($req, $firstN, $lastN, $description, $profilePicture, $position, $pseudo);

while(mysqli_stmt_fetch($req)){
}
?>


<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="favicon/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

    <title>Profile </title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="common.css" rel="stylesheet">
    <link href="update.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800,900" rel="stylesheet">
  </head>



  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
      <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <a class="navbar-brand" href="index.php" style="font-weight: 700;">Konnect.ed</a>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="network.php">Network</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="jobs.php">Jobs</a>
          </li>
        </ul>
      </div>

      <div class="mx-auto order-2">
        <form class="navbar-brand mx-auto form-inline" method="post">
          <input class="form-control multitext" name="information" type="text" placeholder="Who are you looking for?" aria-label="Search">
          <button class="btn btn-default" formaction="search.php" style="" type="submit">Search</button>
        </form>
      </div>

      <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <form class="form-inline nav-item">
              <button class="btn btn-default" formaction="logout.php" style="font-weight:600;" type="submit">Disconnect</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>

	  <div class="row">
        <div class="profile-header-container">
    		<div class="profile-header-img">
          <?php
          echo "<img src='".$profilePicture."' />";
          ?>
                <!-- badge -->
                <div class="rank-label-container">
                    <span class="label label-default rank-label">
                      <?php
                      echo "$firstN $lastN - $pseudo";
                      ?>
                    </span>
                </div>
            </div>
        </div>
	</div>

<main role="main" class="container">
  <div class="jumbotron">
    <h1>Update my profile</h1>
    <br>
    <form action="post_update.php" class="form-horizontal" method="post" enctype="multipart/form-data">
      <label for="fileToUpload" class="btn btn-lg btn-default mr-sm-2" style="cursor: pointer;">Add a Profile Picture</label>
      <input type="file" name="fileToUpload" value="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
      <div class="preview">
        <p>No photo added</p>
      </div>
      <?php
      echo "<div class=\"form-group\">";
      echo "<label class=\"control-label col-sm-2\" for=\"desc\">Description: </label>";
      if(empty($description)){
      echo "<input type=\"text\" name=\"description\" class=\"form-control\" id=\"desc\" placeholder=\"My best line\"> ";
      }
      else{
        echo"<input type=\"text\" name=\"description\" class=\"form-control\" id=\"desc\" value=\"$description\"> ";
      }
      echo "</div>";

      echo "<div class=\"form-group\">";
      echo "<label class=\"control-label col-sm-2\" for=\"pseudo\">Pseudo: </label>";
      if(empty($pseudo)){
      echo "<input type=\"text\" name=\"pseudo\" class=\"form-control\" id=\"pseudo\" placeholder=\"Here is my pseudo\"> ";
      }
      else{
        echo"<input type=\"text\" name=\"pseudo\" class=\"form-control\" id=\"pseudo\" value=\"$pseudo\"> ";
      }

      echo "</div>";
      echo "<div class=\"form-group\">";
      echo "<label class=\"control-label col-sm-2\" for=\"select\">Position: </label>";
      echo "<select id=\"select\" name=\"position\" class=\"form-control\" >";
      echo "<option>Student</option>";
      echo "<option>Teacher</option>";
      echo "<option>Professional</option>";
      echo "</select>";
      echo "</div>";
      ?>
      <button class="btn btn-lg btn-primary mr-sm-2" name="submit" style="" type="submit">Save</button>
    </form>
  </div>
</main>

    <footer class="mastfoot mt-auto">
      <div class="inner">
        <p>Konnect.ed<br>A. Prat, M. Michel and S. Caddeo</p>
      </div>
    </footer>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="index.js"></script>
  </body>
</html>
