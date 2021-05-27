<?php
session_start();
include_once '../functions/function.php';

userConnectAccess();

$erreur= '';
if(isset($_GET['password'])){  
    if(htmlentities($_GET['password']) === 'wrong'){
        $erreur = '<p class="alert alert-danger">le Mot de passe a mal étais répété.</p>';
    }
 } 
 if(isset($_GET['pseudo'])){
     if(htmlentities($_GET['pseudo']) === 'wrong'){
        $erreur = '<p class="alert alert-danger">Ce Pseudo a deja été pris.</p>';
    }
 } 
 if(isset($_GET['mail'])){
     if(htmlentities($_GET['mail']) === 'wrong'){
        $erreur = '<p class="alert alert-danger">Cet adresse mail a deja étais utilisé.</p>';
    }

}

$title ="inscription";
include_once "../component/header.php";
?>

   <main class='container row p-5'>
   <div>
   <form class="row g-3 needs-validation" action='./login.php' method='POST'>
  <div class="col-md-6">
    <label for="validationCustom01" class="form-label">Nom</label>
    <input type="text" class="form-control" name='nom' maxlength="30" id="validationCustom01"  required>
    
  </div>
  <div class="col-md-6">
    <label for="validationCustom02" class="form-label">Prenom</label>
    <input type="text" class="form-control" name='prenom' maxlength="30" id="validationCustom02" required>
    
  </div>
  <div class="col-md-6">
    <label for="validationCustomUsername" class="form-label">Pseudo</label>
    <div class="input-group has-validation">
      
      <input type="text" class="form-control" id="validationCustomUsername" name='pseudo' maxlength="20" aria-describedby="inputGroupPrepend" required>
      
    </div>
  </div>
 
  <div class="col-md-6">
    <label for="validationCustom03" class="form-label">Email</label>
    <input type="email" class="form-control" name='email' maxlength="320"id="validationCustom03" required>
    
  </div>
  
  <div class="col-md-6">
    <label for="validationCustom02" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" name='password' maxlength="15" id="validationCustom02" required>
    
  </div>
  <div class="col-md-6">
    <label for="validationCustomUsername" class="form-label">Confirmer le Mot de passe</label>
    <div class="input-group has-validation">
      
      <input type="password" class="form-control" name='second_password' maxlength="15" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      
    </div>
  </div>
  
  <div class="col-12">
  <?= $erreur?>
    <button class="btn btn-primary" type="submit">Valider</button>
  </div>
</form>
   
   </div>
   
   </main> 
</body>
</html>