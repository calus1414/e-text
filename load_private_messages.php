<?php
session_start();
include_once './functions/function.php';
// header("Location: accueil.php ");

try {
    $bdd = mysqli_connect('localhost','root', '','etexte', "3306" );
} catch (Exception $e) {
   die("Erreur : " . $e->getMessage());
}
if(isset($_GET['id'])){
    $destinataire_id =$_GET['id'];


    $get_id = mysqli_query($bdd, 'Select pseudo FROM utilisateur WHERE id ="' . $destinataire_id . '"');
    
    $destinataire = mysqli_fetch_array($get_id, MYSQLI_ASSOC);
  




                showPrivateMessage($bdd, $destinataire_id, $_SESSION['user']['id'], $destinataire['pseudo'], $_SESSION['user']['pseudo']);
            }
                ?>

<script>
// var messages = document.getElementById('messages');
// messages.scrollTop = messages.scrollHeight; 
</script>