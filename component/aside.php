
<?php 
include_once '../functions/function.php';

?>
<aside class='col-4'>
<div class="card" style="width: 18rem;">
  <div class="card-body">
  <?=navBar(true)?>
  </div>
  <div class="card-body">
    <h3 class="card-title">Info utilisateur</h3>
    <?php
    if(isset($user) && $user !== $_SESSION['user']['pseudo']):
    ?>

    <form action="./page/message_priver.php" methode='GET'>
    <h5 class="card-subtitle mb-2 text-muted">Pseudo : <?= $user?></h5>

<input type="hidden" name='pseudo-contact' value='<?=$user?>'>
<input type="submit" class='btn btn-info' value='envoyer un message'>
    </form>

    <?php
    else:
    ?>
    <h5 class="card-subtitle mb-2 text-muted">Nom : <?= $_SESSION['user']['nom'] ?></h5>
    <h5 class="card-subtitle mb-2 text-muted">Prenom : <?= $_SESSION['user']['prenom']?></h5>
    <h6>Mail :<?=$_SESSION['user']['email'] ?></h6>
    <?php
    endif
    ?>
   

    </div>
  
</div>
</aside>