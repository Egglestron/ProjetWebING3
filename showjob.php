<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Jobs </title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <!-- style="background-color:  #000099;"  Pour avoir la navbar en bleu-->
      <a class="navbar-brand" href="index.php">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notif.php">Notifications </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="network.php">Network </a>    <!--<a class="nav-link disabled" href="#">Network </a>  pour griser la case-->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">Messages </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="jobs.php">Jobs <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline" method="post">
          <input class="form-control mr-sm-2" name="information" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary  mr-sm-2" name="info" formaction="search.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Search</button>
          <button class="btn btn-primary" formaction="logout.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Disconnect</button>
        </form>
      </div>
    </nav>

<?php
include("config.php");
$idp = isset($_GET["idpost"])?$_GET["idpost"]:null;

$requete = "SELECT jo.*, us.ID, us.FirstName, us.LastName, ob.Date_Post FROM joboffers jo, objectposts ob, users us";
$requete .= " WHERE jo.ID_Object = ? AND jo.ID_Object = ob.ID AND ob.ID_User = us.ID";


$req = mysqli_prepare($db, $requete);
mysqli_stmt_bind_param($req, "i", $idp);
mysqli_stmt_execute($req);

mysqli_stmt_store_result($req);

mysqli_stmt_bind_result($req, $col_IDObj, $col_JobLoc, $col_Company, $col_Title, $col_JobDescri, $col_Len, $col_Skills, $col_Area, $col_ID, $col_FirstName, $col_LastName, $col_DatePost);

while(mysqli_stmt_fetch($req)){
echo "<main role=\"main\" class=\"container col-sm-5\">";
  echo "<div class=\"jumbotron float-center text-left\">";
      echo "<h1 class=\"h3 mb-1\">Job Offer by $col_FirstName $col_LastName <br/> Job title : $col_Title</h1>";

      echo "<p class=\"form-control mr-sm-2\" type=\"text\">Offer n°$col_IDObj</p>";
      echo "<p class=\"form-control mr-sm-2\" type=\"text\">Job location : $col_JobLoc</p>";
      echo "<p class=\"form-control mr-sm-2\" type=\"text\">Company : $col_Company</p>";
      echo "<p class=\"form-control mr-sm-2\" type=\"text\">Description : $col_JobDescri</p>";
      echo "<p class=\"form-control mr-sm-2\" type=\"text\">Lenght : $col_Len months</p>";
      echo "<p class=\"form-control mr-sm-2\" type=\"text\">Skills required :  $col_Skills</p>";
      echo "<p class=\"form-control mr-sm-2\" type=\"text\">Job area : $col_Area</p>";

  echo "</div>";
echo "</main>";
}

?>

<footer class="mastfoot mt-auto">
  <div class="inner">
    <p>LonkedOn by Arthur Prat, Maxime Michel and Sam Caddeo</p>
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
