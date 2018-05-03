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
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <!-- style="background-color:  #000099;"  Pour avoir la navbar en bleu-->
      <a class="navbar-brand" href="index.php">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="profile.php">Profile</a>
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
          <li class="nav-item">
            <a class="nav-link" href="jobs.php">Jobs <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline" method="post">
          <input class="form-control mr-sm-2"  name="information" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary  mr-sm-2" formaction="search.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Search</button>
          <button class="btn btn-primary" formaction="logout.php" style="border-color: #000099; color: #000099; background-color: navbar-dark;" type="submit">Disconnect</button>
        </form>
      </div>
    </nav>

        <?php
        echo "<form method=\"post\">";
        echo "<h1 class=\"h3 mb-1\">Add a job offer</h1>";
           echo "<div class=\"form-group\">";
               echo "<label for=\"jl\">Job location</label>";
              echo "<input type=\"text\" name=\"jobloc\" id=\"jl\" class=\"form-control mr-sm-2\" placeholder=\"Job location\" ";
            echo "</div>";

            echo "<div class=\"form-group\">";
                echo "<label for=\"c\">Company</label>";
        echo "<input type=\"text\" name=\"company\" id=\"c\" class=\"form-control mr-sm-2\"  placeholder=\"Company\" ";
        echo "</div>";

        echo "<div class=\"form-group\">";
            echo "<label for=\"t\">Title</label>";
        echo "<input type=\"text\" name=\"title\" id=\"t\" class=\"form-control mr-sm-2\"  placeholder=\"Title\" ";
        echo "</div>";

        echo "<div class=\"form-group\">";
            echo "<label for=\"jd\">Job description</label>";
        echo "<input type=\"text\" name=\"jobdescri\" id=\"jd\" class=\"form-control mr-sm-2\"  placeholder=\"Job description\" ";
        echo "</div>";

        echo "<div class=\"form-group\">";
            echo "<label for=\"l\">Length</label>";
        echo "<input type=\"number\" name=\"len\" id=\"l\" class=\"form-control mr-sm-2\"  placeholder=\"Length\" ";
        echo "</div>";

        echo "<div class=\"form-group\">";
            echo "<label for=\"s\">Skills</label>";
        echo "<input type=\"text\" name=\"skills\" id=\"s\" class=\"form-control mr-sm-2\"  placeholder=\"Skills\" ";
        echo "</div>";

        echo "<div class=\"form-group\">";
            echo "<label for=\"a\">Area</label>";
        echo "<input type=\"text\" name=\"area\" id=\"a\" class=\"form-control mr-sm-2\"  placeholder=\"Area\" ";
        echo "</div>";
        echo "<button class=\"btn btn-primary mr-sm-2\" formaction=\"post_addjob.php\" style=\"border-color: #000099; color: #000099; background-color: navbar-dark;\" type=\"submit\">Add this offer</button>";
    echo "</form>";

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
