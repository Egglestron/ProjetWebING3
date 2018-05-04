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
  <meta http-equiv="refresh" content="60">
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

  <title>Chat</title>

  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="common.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800,900" rel="stylesheet">
  <script src="show.js"></script>
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

<div class="container-fluid">
  <div class="row">
  <div class="col-sm-3">
    <?php
    include("config.php");
    $id = $_SESSION["id"];

    $requete = "SELECT g.ID, g.Name, g.Notif FROM chatgroups g JOIN chatmessages m on m.ID_Conv = g.ID ";
    $requete .= " JOIN objectposts o on o.ID = m.ID_Post WHERE g.ID_User = ? GROUP BY g.ID ORDER by MAX(o.Date_Post) DESC";

    //echo $requete;

    $req = mysqli_prepare($db, $requete);
    mysqli_stmt_bind_param($req, "i", $id);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_ID, $col_Name, $col_Notif);
    //echo "<div class=\"jumbotron float-center\">";
    echo "<h3>Discussions existantes</h3>";

    $i = 0;

    echo "<div>";

    while(mysqli_stmt_fetch($req)){
      $i += 1;
      if($i > 5){
        echo "</div>
        <div id=\"otherDiscussions\" style =\"display: none;\"> ";
      }

      echo "<button class=\"btn btn-lg btn-primary btn-block\" " ;
      if($col_Notif == "new"){
        echo "style=\"background-color : #cc8400;\"";
      }
       echo "onclick=\"window.location.href='discussion.php?idDiscussion={$col_ID}'\" type=\"submit\" > $col_Name </button><br>";
    }

    echo "</div>";

    if($i>5){
      echo "<button class=\"btn btn-sm btn-success btn-block\" onclick=\"showhide()\" id=\"hidebutton\" >Show More</button><br>";
    }

    $requete = "SELECT DISTINCT us.ID, us.Firstname, us.Lastname, us.Pseudo FROM users us, friendships fs WHERE fs.ID_User1 = ?";
    $requete .=" AND us.ID = fs.ID_User2 AND fs.Status = 'Accepted' AND  fs.Relationship = 'Friend'";

    $req = mysqli_prepare($db, $requete);
    mysqli_stmt_bind_param($req, "i", $id);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_IDUser, $col_FirstName, $col_LastName, $col_Pseudo);
    //echo "<div class=\"jumbotron float-center\">";
    echo "<h3>Friends</h3>";
    while(mysqli_stmt_fetch($req)){
      echo "<form action=\"discussion.php\" class=\"form-post\" method=\"post\" >";
      echo "<input type=\"hidden\" name=\"idUser\" value=\"$col_IDUser\" > ";
      echo "<input type=\"hidden\" name=\"firstname\" value=\"$col_FirstName\" > ";
      echo "<input type=\"hidden\" name=\"lastname\" value=\"$col_LastName\" > ";
      echo "<button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" >$col_FirstName $col_LastName </button> <br>";
      echo "</form>";
    }

    $requete = "SELECT DISTINCT us.ID, us.Firstname, us.Lastname, us.Pseudo FROM users us, friendships fs WHERE fs.ID_User1 = ?";
    $requete .=" AND us.ID = fs.ID_User2 AND fs.Status = 'Accepted' AND  fs.Relationship = 'Pro'";

    $req = mysqli_prepare($db, $requete);
    mysqli_stmt_bind_param($req, "i", $id);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_IDUser, $col_FirstName, $col_LastName, $col_Pseudo);
    //echo "<div class=\"jumbotron float-center\">";
    echo "<h3>Pros</h3>";
    while(mysqli_stmt_fetch($req)){
      echo "<form action=\"discussion.php\" class=\"form-post\" method=\"post\" >";
      echo "<input type=\"hidden\" name=\"idUser\" value=\"$col_IDUser\" > ";
      echo "<input type=\"hidden\" name=\"firstname\" value=\"$col_FirstName\" > ";
      echo "<input type=\"hidden\" name=\"lastname\" value=\"$col_LastName\" > ";
      echo "<button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" >$col_FirstName $col_LastName </button> <br>";
      echo "</form>";
    }
    echo"</div>";

    echo"<div class=\"col-sm-6\" style=\"\">";
    //echo "<div class=\"jumbotron float-right text-center\">";
if(!empty($_SESSION["idDiscussion"])){
    $idDiscussion = $_SESSION["idDiscussion"];

    $requete = "SELECT us.ID, us.FirstName, us.LastName, ob.Url_Media, ob.Description, gr.Name FROM users us,";
    $requete .=" objectposts ob, chatmessages me, chatgroups gr WHERE gr.ID = ? AND gr.ID_User = ob.ID_User AND ob.ID_User = us.ID AND ob.ID = me.ID_Post AND me.ID_Conv = gr.ID ORDER BY ob.Date_Post DESC";

    //echo $requete;
    $req = mysqli_prepare($db, $requete);
    mysqli_stmt_bind_param($req, "i", $idDiscussion);
    mysqli_stmt_execute($req);

    mysqli_stmt_store_result($req);

    mysqli_stmt_bind_result($req, $col_IDChatter, $col_FirstName, $col_LastName, $col_UrlMedia, $col_Descri, $col_Name);
    //echo "<div class=\"jumbotron float-center\">";
    echo "<h3>$col_Name</h3>";

    echo "<form action=\"postMessage.php\" class=\"form-post\" method=\"post\" enctype=\"multipart/form-data\">";
    echo "<input class=\"form-control multitext mr-sm-2\" style=\"\"name=\"description\" id=\"description\" type=\"text\" placeholder=\"Send a message\" aria-label=\"Send a message\">";
    echo "<input type=\"hidden\" name=\"idDiscussion\" value=\"$idDiscussion\" id=\"idpost\"> ";
    echo "<label for=\"fileToUpload\" class=\"btn btn-lg btn-default mr-sm-2\" style=\"cursor: pointer;\">Add a photo</label>
    <input type=\"file\" name=\"fileToUpload\" value=\"fileToUpload\" id=\"fileToUpload\" accept=\".jpg, .jpeg, .png\">";
    echo "<button class=\"btn btn-primary\" type=\"submit\" name=\"submit\" >Send Message</button>";
    echo "</form>";
    echo "<div class=\"preview\">
      <p>No photo added to the post</p>
    </div>";

echo "<main role=\"main\" class=\"holder\" >";
echo "<div class=\"jumbotron float-center text-left\">";
    while(mysqli_stmt_fetch($req)){
      if($col_IDChatter != $id){
<<<<<<< HEAD
        echo "<p align=\"left\">$col_FirstName $col_LastName : <br>
         $col_Descri</p>";
=======
        echo "<p align=\"left\">$col_FirstName $col_LastName :<br>$col_Descri</p>";
        if(!empty($col_UrlMedia)){
          echo "<img src =\"$col_UrlMedia\" alt =\"LinkedMedia\"/>";
         }
>>>>>>> 9a66d297ceffa3468cbb9f1b0d4ea559b5612440
      }
      else {
        echo "<p align=\"right\" style=\"color : #ff0000; \">$col_FirstName $col_LastName :<br>$col_Descri</p>";
        if(!empty($col_UrlMedia)){
          echo "<p align='right'><img src=\"$col_UrlMedia\" class='' alt =\"LinkedMedia\"/></p>";
         }
      }
    }
    echo "</div>";
    echo "</main>";
  }
  else{
    $firstname = isset($_SESSION['firstname'])?$_SESSION['firstname']:"";
    $lastname = isset($_SESSION['lastname'])?$_SESSION['lastname']:"";

    echo "<h3>$firstname $lastname</h3>";

    echo "<form action=\"postMessage.php\" class=\"form-post\" method=\"post\" enctype=\"multipart/form-data\">";
    echo "<input class=\"form-control\" name=\"description\" id=\"description\" type=\"text\" placeholder=\"Write a message\" aria-label=\"Write a message\">";
    echo "<label for=\"fileToUpload\" class=\"btn btn-lg btn-default mr-sm-2\" style=\"cursor: pointer;\">Add a photo</label>
    <input type=\"file\" name=\"fileToUpload\" value=\"fileToUpload\" id=\"fileToUpload\" accept=\".jpg, .jpeg, .png\">";
    echo "<button class=\"btn btn-primary\" type=\"submit\" name=\"submit\" >Send Message</button>";
    echo "</form>";
    echo "<div class=\"preview\">
      <p>No photo added to the post</p>
    </div>";
  }


    //echo "</div>";
  //  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";

  //w3schools
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
  <script src="index.js"></script>
</body>
</html>
