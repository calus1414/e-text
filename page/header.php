<?php





include_once './functions/function.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title><?= $title?></title>
</head>
<body>
<header>

<nav class="navbar navbar-expand-lg navbar navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <h2 class="navbar-brand">E-text</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?=navBar(false)?>
      </ul>
      <div >
      <ul class="navbar-nav me-auto ">
      <?php if(!isset($_SESSION['user'])){
        $btn = "<li class='nav-link'><a href='signin.php' class='link-secondary'>S'enregistrer</a></li>
        <li class='nav-link's><a href='login.php'class='link-secondary'>ce connecter</a></li>
        ";
        echo $btn; 
    }else{
      $btn = "<li class='nav-link's><a href='logout.php' class='link-danger'>ce deconnecter</a></li>";
        echo $btn;
       
    }?></ul>
      
      </div>
    </div>
  </div>
</nav>
</header>