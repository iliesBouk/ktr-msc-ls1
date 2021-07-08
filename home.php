<?php

require 'functions.php';

session_start();

require "db_connection.php";

if(!isset($_SESSION['id']))
{
    header("location:connexion.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Album example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="home.css?v=<?php echo time(); ?>" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>

    <header>
     
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>Accueil</strong>
          </a>
          <a href="logout.php" class="btn btn-primary my-2 log-out">Se déconnecter </a>

            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Gestion de carte</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
          <p>
            <a href="information.php" class="btn btn-primary my-2">Mes informations</a>
            <a href="add_card.php" class="btn btn-secondary my-2 ">Ajouter une carte</a>
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
            <div class="comumn justify-content-center align-items-center " style="width:1200px">
            <div class="">
                <div class="card">
                    <h1 class="card-header"> Mes cartes</h1>

                    <div class="card-body">

                    
                         
                    <?php


                        $all_cards = $db->prepare("SELECT * FROM libraries WHERE user_id = ?  ");
                        $all_cards->execute([$_SESSION['id']]);

                        $all_cards_result = $all_cards->fetchAll(PDO::FETCH_ASSOC);

                        $all_cards_count = $all_cards->rowCount();
                        if($all_cards_count == 0){
                            echo  "<span> il n'ya pas de carte ! </span> ";
                        }
                        else 
                        {
                                echo '<table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Campany Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Telehone</th>
                                            </tr>
                                      </thead>
                                 <tbody>';


                        }

                        foreach($all_cards_result as $card)
                        {
                           echo ' <tr>
                                <td>'.  $card['name'] .'</td>
                                <td>'.  $card['company_name'] .'</td>
                                <td>'.  $card['email'] .'</td>
                                <td>'.  $card['telephone'] .'</td>';
                              
                        }
                       
                        echo ' </tbody>
                        </table>';
                    
                    

   ?>
          </div>
        </div>
      </div>

    </main>

    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/vendor/holder.min.js"></script>
  </body>
</html>
