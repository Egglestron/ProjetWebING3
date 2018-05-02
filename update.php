<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile </title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/normalize.css">
    <link href="navbar-top-fixed.css" rel="stylesheet">

  </head>

  <body>

    <?php
    include("config.php");
    session_start();
    $id = $_SESSION['id'];

    $requete = "SELECT DISTINCT us.Firstname, us.Lastname, us.description FROM users us WHERE us.ID = ?";

    //echo $requete;

    $req = mysqli_prepare($db, $requete);
    mysqli_stmt_bind_param($req, "i", $id);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_FirstName, $col_LastName, $col_Description);

    while(mysqli_stmt_fetch($req)){
      $firstN = $col_FirstName ;
      $lastN = $col_LastName;
      $description = $col_Description;
    }
    ?>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <!-- style="background-color:  #000099;"  Pour avoir la navbar en bleu-->
      <a class="navbar-brand" href="index.php">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notif.html">Notifications </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="network.html">Network </a>    <!--<a class="nav-link disabled" href="#">Network </a>  pour griser la case-->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="messages.html">Messages </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="jobs.html">Jobs </a>
          </li>
        </ul>
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary mr-sm-2" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Search</button>
          <button class="btn btn-primary" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Disconnect</button>
        </form>
      </div>
    </nav>

    <div class="container">
	  <div class="row">
        <div class="profile-header-container">
    		<div class="profile-header-img">
                <img class="img-circle" src="img/default.png" />
                <!-- badge -->
                <div class="rank-label-container">
                    <span class="label label-default rank-label">
                      <?php
                      echo "$firstN $lastN";
                      ?>
                    </span>
                </div>
            </div>
        </div>
	</div>
</div>

<form class="form-horizontal col-lg-6">
  <div class="form-group">
    <legend>Update my profile</legend>
  </div>
  <div class="row">
    <div class="form-group">
      <label for="text" class="col-lg-2 control-label">
      </label>
      <div class="col-lg-10">
        <?php
        echo "<input type=\"text\" class=\"form-control\" id=\"text\" placeholder=\" ";
        if(empty($description)){echo "My best line";}
        else{echo"$description";}
        echo "\">";
        ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group">
    <label for="select" class="col-lg-2 control-label">Status:  </label>
      <div class="col-lg-10">
        <select id="select" class="form-control" >
          <option>Student</option>
          <option>Teacher</option>
          <option>Professional</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <button class="pull-right btn btn-default">Save</button>
  </div>
</form>

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
