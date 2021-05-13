
<?php 
include_once './functions/function.php';

?>
<aside class='col-4'>
<div class="card" style="width: 18rem;">
  <div class="card-body">
  <?=navBar(true)?>
  </div>
  <div class="card-body">
    <h3 class="card-title">Info utilisateur</h3>
    <h5 class="card-subtitle mb-2 text-muted">Nom : <?= ($_SESSION['user']['nom'] ?? $unknow_name  )?></h5>
    <h5 class="card-subtitle mb-2 text-muted">Prenom : <?= ($_SESSION['user']['prenom'] ?? $unknow_surname  )?></h5>
    <h6>Mail :<?=($_SESSION['user']['mail'] ?? $unknow_mail )?></h6>
    </div>
  
</div>
</aside>