<!doctype html>
<?php
session_start();

if(empty($_SESSION['id'])){
  header('location:login.html');
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="30">
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

  <title>Jobs </title>
  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="common.css" rel="stylesheet">
  <link href="jobs.css" rel="stylesheet">
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

  <div class='container'>
    <h3 style='color:white; font-weight:700; font-size:3em;'>My jobs</h3>
    <button class="btn btn-lg btn-primary" onclick="window.location.href='addjob.html'" style="" type="submit">Add a job offer</button>
  </div>

  <?php
  include("config.php");
  $id = $_SESSION['id'];

  $requete = "SELECT jo.*, us.ID, us.FirstName, us.LastName, ob.Date_Post FROM joboffers jo, objectposts ob, users us";
  $requete .= " WHERE jo.ID_Object = ob.ID AND ob.ID_User = us.ID ORDER BY ob.Date_Post DESC";

  $requete2 = "SELECT us.ID, us.Firstname, us.Lastname, us.Pseudo FROM users us, joboffers jo, objectposts ob, jobreacts jr";
  $requete2 .= " WHERE jo.ID_Object = ob.ID AND ob.ID_User = ? AND jr.ID_Offer = jo.ID_Object AND jr.ID_User = us.ID";

  //echo $requete;

  $req = mysqli_prepare($db, $requete);
  mysqli_stmt_execute($req);

  mysqli_stmt_store_result($req);

  mysqli_stmt_bind_result($req, $col_IDObj, $col_JobLoc, $col_Company, $col_Title, $col_JobDescri, $col_Len, $col_Skills, $col_Area, $col_ID, $col_FirstName, $col_LastName, $col_DatePost);

  $req2 = mysqli_prepare($db, $requete2);
  mysqli_stmt_bind_param($req2, "i", $id);
  mysqli_stmt_execute($req2);
  mysqli_stmt_store_result($req2);
  mysqli_stmt_bind_result($req2, $col_ID, $col_FirstName, $col_LastName, $col_Pseudo);

  while(mysqli_stmt_fetch($req)){
  if(mysqli_stmt_num_rows($req2)>0){
  //while(mysqli_stmt_fetch($req2)){


    echo "<main role=\"main\" class=\"container col-sm-5\">";
    echo "<div class=\"jumbotron float-center text-left\">";
    echo "<h1 class=\"h3 mb-1\">Job Offer by $col_FirstName $col_LastName <br/> Job title : $col_Title</h1><br>";
    echo "<button class=\"btn btn-primary\" onclick=\"window.location.href='showjob.php?idpost={$col_IDObj}'\" style=\"\" type=\"submit\">See the offer</button>";
    echo "<button class=\"btn btn-primary\" onclick=\"window.location.href='interested.php'\" style=\"\" type=\"submit\">People interested</button>";
    echo "</div>";
    echo "</main>";
  }
  //}

else{
    echo "<main role=\"main\" class=\"container col-sm-5\">";
    echo "<div class=\"jumbotron float-center text-left\">";
    echo "<h1 class=\"h3 mb-1\">Job Offer by $col_FirstName $col_LastName <br/> Job title : $col_Title</h1><br>";
    echo "<button class=\"btn btn-primary\" onclick=\"window.location.href='showjob.php?idpost={$col_IDObj}'\" style=\"\" type=\"submit\">See the offer</button>";
    echo "</div>";
    echo "</main>";
//}
}
}

  ?>





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
</body>
</html>
