<?php

session_start();
$title = "Message";
if (isset($_GET['pseudo-contact'])) {

    $pseudo_destinataire = htmlentities($_GET['pseudo-contact']);
} else {
    $pseudo_destinataire = $_POST['pseudo-destinataire'];
}


try {
    $bdd = mysqli_connect('localhost', 'root', '', 'etexte', "3306");
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
$get_id = mysqli_query($bdd, 'Select id FROM utilisateur WHERE pseudo ="' . $pseudo_destinataire . '"');

$destinataire = mysqli_fetch_array($get_id, MYSQLI_ASSOC);

include_once '../functions/function.php';

userUnconnectAccess();

if (isset($_POST['user-message'])) {

    sendPrivateMessage($bdd, $destinataire['id'], $_SESSION['user']['id'], $_POST['user-message']);
}

include_once "../component/header.php";


?>


<main class="container-xxl row p-5">


    <div class="col-8">

        <a href='message_priver.php?pseudo-contact=<?= $pseudo_destinataire ?>'><input type="button" class='btn btn-info' value="rafraichir"></a>
        <div class='row'>
            <div id='messages' class='messages col-12'>
                <?php
                showPrivateMessage($bdd, $destinataire['id'], $_SESSION['user']['id'], $_GET['pseudo-contact'], $_SESSION['user']['pseudo']);
                ?>
            </div>
            <div class='text col-12'>
                <form action="message_priver.php?pseudo-contact=<?= $pseudo_destinataire ?>" class='row' method="post" autofocus>

                    <textarea name="user-message" class='form-control' id="" cols="80" rows="3"></textarea>
                    <input type="hidden" name='pseudo-destinataire' value="<?= $pseudo_destinataire ?>">
                    <input type="submit" class='btn btn-info' value="Envoyer">
                </form>


            </div>
        </div>
    </div>

</main>
<script>

 setInterval('load_Private_messages()',1500);

function load_Private_messages(){

 $('#messages').load("./load_Private_messages.php?id=<?=$destinataire['id']?>");

 }
</script>

<?php

include_once "../component/footer.php";
?>