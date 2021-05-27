<?php
session_start();

include_once "../functions/function.php";
$title = 'Contact';
userUnconnectAccess();


$bdd = mysqli_connect('localhost','root','','etexte','3306');
$donnees = mysqli_query($bdd,'SELECT pseudo FROM utilisateur');

include_once "../component/header.php";
?>



<main class="container-xxl row p-5">

<div class="col-8">
<h4>Contact</h4>
<div class="wrapper-pseudo">
<p>Cliquer sur les pseudo pour le contacter en privée</p>
<form action='./message_priver.php' class='row' method='GET'>

<?php

while($user_pseudo = mysqli_fetch_array($donnees , MYSQLI_ASSOC) ){
    if($user_pseudo["pseudo"] !== $_SESSION['user']['pseudo'])
echo '<input type="submit" class="btn  btn-info col m-2" name="pseudo-contact" value="'.$user_pseudo["pseudo"].'">';
    
}
?>
</form>
</div>
</div>
<?php

include_once "../component/aside.php";
?>
</main>