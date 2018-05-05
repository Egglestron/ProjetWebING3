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
  <link href="messages.css" rel="stylesheet">
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

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3">
        <?php
        include("config.php");
        $id = $_SESSION["id"];

        $requete = "SELECT ID, Name, Notif FROM chatgroups WHERE ID_User = ?";
        $req = mysqli_prepare($db, $requete);
        mysqli_stmt_bind_param($req, "i", $id);
        mysqli_stmt_execute($req);
        mysqli_stmt_store_result($req);
        mysqli_stmt_bind_result($req, $col_ID, $col_Name, $col_Notif);
        echo "<h2 style='color:white;font-weight:600;'>Ongoing discussions</h2>";
        $i = 0;
        echo "<div>";
        while(mysqli_stmt_fetch($req)){
          $i += 1;
          if($i > 5){
            echo "</div>
            <div id='otherDiscussions' style ='display: none;'> ";
          }
          echo "<button class='btn btn-lg btn-primary btn-block' " ;
          if($col_Notif == "new"){
            echo "style='background-color : #cc8400;'";
          }
          echo "onclick=\"window.location.href='discussion.php?idDiscussion={$col_ID}'\" type='submit' > $col_Name </button><br>";
        }
        echo "</div>";
        if($i==6){
          echo "<button class='btn btn-sm btn-success btn-block' onclick='showhide()' id='hidebutton' >Show More</button><br>";
        }


        $requete = "SELECT DISTINCT us.ID, us.Firstname, us.Lastname, us.Pseudo FROM users us, friendships fs WHERE fs.ID_User1 = ?";
        $requete .=" AND us.ID = fs.ID_User2 AND fs.Status = 'Accepted' AND  fs.Relationship = 'Friend'";

        $req = mysqli_prepare($db, $requete);

        mysqli_stmt_bind_param($req, "i", $id);
        mysqli_stmt_execute($req);
        mysqli_stmt_store_result($req);
        mysqli_stmt_bind_result($req, $col_IDUser, $col_FirstName, $col_LastName, $col_Pseudo);

        echo "<br><h2 style='color:white;font-weight:600;'>Start a new discussion</h2>";
        echo "<h3 style='color:white;'>Friends</h3>";

        while(mysqli_stmt_fetch($req)){
          echo "<form action='discussion.php' class='form-post' method='post' >";
          echo "<input type='hidden' name='idUser' value='$col_IDUser' > ";
          echo "<input type='hidden' name='firstname' value='$col_FirstName' > ";
          echo "<input type='hidden' name='lastname' value='$col_LastName' > ";
          echo "<button class='btn btn-lg btn-primary btn-block' type='submit' >$col_FirstName $col_LastName</button><br>";
          echo "</form><br>";
        }

        $requete = "SELECT DISTINCT us.ID, us.Firstname, us.Lastname, us.Pseudo FROM users us, friendships fs WHERE fs.ID_User1 = ?";
        $requete .=" AND us.ID = fs.ID_User2 AND fs.Status = 'Accepted' AND  fs.Relationship = 'Pro'";

        $req = mysqli_prepare($db, $requete);

        mysqli_stmt_bind_param($req, "i", $id);
        mysqli_stmt_execute($req);
        mysqli_stmt_store_result($req);
        mysqli_stmt_bind_result($req, $col_IDUser, $col_FirstName, $col_LastName, $col_Pseudo);

        echo "<h3 style='color:white;'>Professionals</h3>";

        while(mysqli_stmt_fetch($req)){
          echo "<form action='discussion.php' class='form-post' method='post' >";
          echo "<input type='hidden' name='idUser' value='$col_IDUser' > ";
          echo "<input type='hidden' name='firstname' value='$col_FirstName' > ";
          echo "<input type='hidden' name='lastname' value='$col_LastName' > ";
          echo "<button class='btn btn-lg btn-primary btn-block' type='submit' >$col_FirstName $col_LastName </button> <br>";
          echo "</form>";
        }
        echo"</div>";

        echo"<div class='col-sm-6' style=''>";

        if(!empty($_SESSION["idDiscussion"])){
          $idDiscussion = $_SESSION["idDiscussion"];


          $req = mysqli_prepare($db, "SELECT Name FROM chatgroups WHERE ID = ? and ID_User = ?" );

          mysqli_stmt_bind_param($req, "ii", $idDiscussion, $id);
          mysqli_stmt_execute($req);
          mysqli_stmt_store_result($req);
          mysqli_stmt_bind_result($req, $Name);

          while (mysqli_stmt_fetch($req)) {
            // code...
          }

          $requete = "SELECT us.ID, us.FirstName, us.LastName, ob.Url_Media, ob.Description FROM users us,";
          $requete .=" objectposts ob, chatmessages me, chatgroups gr WHERE gr.ID = ? AND gr.ID_User = ob.ID_User AND ";
          $requete .=" ob.ID_User = us.ID AND ob.ID = me.ID_Post AND me.ID_Conv = gr.ID ORDER BY ob.Date_Post DESC";

          $req = mysqli_prepare($db, $requete);

          mysqli_stmt_bind_param($req, "i", $idDiscussion);
          mysqli_stmt_execute($req);
          mysqli_stmt_store_result($req);
          mysqli_stmt_bind_result($req, $col_IDChatter, $col_FirstName, $col_LastName, $col_UrlMedia, $col_Descri);

          echo "<div class='holder'><h3 style='color:white; font-weight:700; font-size:2em;'>$Name</h3><br></div>";
          echo "<form action='postMessage.php' class='form-post' method='post' enctype='multipart/form-data'>";
          echo "<input class='form-control multitext mr-sm-2' style=''name='description' id='description' type='text' placeholder='Write a message' aria-label='Write a message'>";
          echo "<input type='hidden' name='idDiscussion' value='$idDiscussion' id='idpost'> ";
          echo "<label for='fileToUpload' class='btn btn-lg btn-default mr-sm-2' style='cursor: pointer;'>Add a photo</label>
          <input type='file' name='fileToUpload' value='fileToUpload' id='fileToUpload' accept='.jpg, .jpeg, .png'>";
          echo "<button class='btn btn-primary' type='submit' name='submit' >Send Message</button>";
          echo "</form>";
          echo "<div class='preview' style='color:white;'>
          <p>No photo added to the post</p>
          </div>";



          echo "<main role='main' class='holder'>";
          echo "<div class='jumbotron message'>";
          while(mysqli_stmt_fetch($req)){
            echo "<div class='col-sm-12' style='overflow: hidden;padding: 0px;'>";
            if($col_IDChatter != $id){
              echo "<div class='jumbotron float-left text-left other-person'>";
              //echo "<h4 align='left'>$col_FirstName $col_LastName</h4>";
              echo "<p class='message' align='left'>$col_Descri</p>";
              if(!empty($col_UrlMedia)){
                echo "<img src ='$col_UrlMedia' alt ='LinkedMedia'/>";
              }
            }
            else {
              echo "<div class='jumbotron float-right text-left my-person'>";
              //echo "<h4 align='right' style=''>$col_FirstName $col_LastName</h4>";
              echo "<p class='message' align='right' style=''>$col_Descri</p>";
              if(!empty($col_UrlMedia)){
                echo "<img src='$col_UrlMedia' class='' alt ='LinkedMedia'/>";
              }
            }
            echo "</div></div>";
          }
          echo "</div>";
          echo "</main>";
        }
        else{
          $firstname = isset($_SESSION['firstname'])?$_SESSION['firstname']:"";
          $lastname = isset($_SESSION['lastname'])?$_SESSION['lastname']:"";

          echo "<div class='container'><h3 style='color:white; font-weight:700; font-size:2em;'>$firstname $lastname</h3><br></div>";

          echo "<form action='postMessage.php' class='form-post' method='post' enctype='multipart/form-data'>";
          echo "<input class='form-control multitext mr-sm-2' name='description' id='description' type='text' placeholder='Write a message' aria-label='Write a message'>";
          echo "<label for='fileToUpload' class='btn btn-lg btn-default mr-sm-2' style='cursor: pointer;'>Add a photo</label>
          <input type='file' name='fileToUpload' value='fileToUpload' id='fileToUpload' accept='.jpg, .jpeg, .png'>";
          echo "<button class='btn btn-primary' type='submit' name='submit' >Send Message</button>";
          echo "</form>";
          echo "<div class='preview' style='color:white;>
          <p>No photo added to the post</p>
          </div>";
        }

        echo "</div>";
        echo "</div>";
        echo "</div>";

        //w3schools
        ?>
        <footer class="mastfoot mt-auto">
          <div class="inner">
            <p>Konnect.ed<br>A. Prat, M. Michel and S. Caddeo</p>
          </div>
        </footer>

        <script src="index.js"></script>
		<script src="show.js"></script>
      </body>
      </html>
