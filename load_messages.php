<?php

// header("Location: accueil.php ");


include_once './functions/function.php';
try {
    $bdd = mysqli_connect('localhost','root', '','etexte', "3306" );
} catch (Exception $e) {
   die("Erreur : " . $e->getMessage());
}
                showMessage($bdd);
                ?>

<script>
// var messages = document.getElementById('messages');
// messages.scrollTop = messages.scrollHeight; 
</script>