<?php

session_start();

require "db_connection.php";
require "functions.php";

if(!isset($_SESSION['id']))
{
    header("location:connexion.php");
}


$account = $db->prepare("SELECT * FROM profile WHERE user_id = ? ");
$account->execute([$_SESSION['id']]);

$all_acounts_count = $account->rowCount();

if($all_acounts_count == 0){
    $i_company = '';
    $i_telephone = '';
}
else 
{
    $all_acounts_result = $account->fetch(PDO::FETCH_ASSOC);

    $i_company = $all_acounts_result['company_name'];

    $i_telephone = $all_acounts_result['telephone'];
}


if(isset($_POST['modifier'])) {
    if(  !empty($_POST['email']) && !empty($_POST['company_name']) && !empty($_POST['telephone']))
    {

        $email = $_POST['email'];
        $company =$_POST['company_name'];
        $telephone =$_POST['telephone'];


        $email_v= filter_var(clean($email),FILTER_SANITIZE_EMAIL);

            if( (filter_var($email_v,FILTER_VALIDATE_EMAIL) )) {
                    
                $update = $db->prepare("UPDATE profile SET company_name = ?,email = ?, telephone= ?   WHERE user_id =? ");            
            
                $update->execute([$company,$email_v,$telephone,$_SESSION['id']]);

                $_SESSION['email'] = $email_v;

                header('Location:information.php');      
             }
      }
      else { 
          echo "tous les champs doivent etre remplis";
      }
                           

}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
    <title>Document</title>
</head>
<body>
<header>
     
     <div class="navbar navbar-dark bg-dark box-shadow">
       <div class="container d-flex justify-content-between">
         <a href="home.php" class="navbar-brand d-flex align-items-center">
           <strong>Accueil</strong>
         </a>
         <a href="logout.php" class="btn btn-primary my-2 log-out">Se déconnecter </a>

           <span class="navbar-toggler-icon"></span>
         </button>
       </div>
     </div>
   </header>

<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action='information.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Mes informations</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Name *</label>
      <div class="controls">
        <input type="text" id="username" name="name" placeholder="" class="input-xlarge" value="<?php echo $_SESSION['name'] ?>" disabled>
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" value="<?php echo $_SESSION['email'] ?>" class="input-xlarge">
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Company name</label>
      <div class="controls">
        <input type="text" name="company_name" placeholder="" class="input-xlarge" value="<?php echo $i_company ?>">
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="password_confirm">Telephone </label>
      <div class="controls">
        <input type="text" id="password_confirm" name="telephone" placeholder="" class="input-xlarge" value="<?php echo $i_telephone ?>">
        
      </div>
    </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name="modifier">Modifier</button>
      </div>
    </div>
  </fieldset>
</form>
</body>
</html>