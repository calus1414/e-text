<?php

session_start();
$title = "Changement mot de passe";


try {



    $bdd = new PDO('mysql:host=localhost;dbname=etexte', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $request = $bdd->query('SELECT password FROM utilisateur WHERE id="' . $_SESSION['user']['id'] . '"');
    $donnees = $request->fetch();
} catch (PDOException $e) {
    print "Erreur : " . $e->getMessage();
    die;
}
$messsage = "";
















include_once "../functions/function.php";




include_once "../component/header.php";

if (!empty($_POST['old_password'])) {
    $id = $_SESSION['user']['id'];
    $old_password = htmlentities($_POST['old_password']);
    $check_old_Password = htmlentities($donnees['password']);
    $new_password1 = $_POST['new_password1'];
    $new_password2 = $_POST['new_password2'];

    if (!password_verify($old_password, $donnees['password'])) {

        $messsage = '<p class=" alert alert-danger">mot de passe incorect</p>';
    } else {
        if ($new_password1 != $new_password2) {

            $messsage = '<p class="alert alert-danger">mot de passe mal répété</p>';
        } else {
            if ($new_password1 === $old_password) {

                $messsage = "<p class='alert alert-danger'>Vous utilisez deja ce mot de passe </p>";
            } else {
                $new_password = password_hash($new_password1, PASSWORD_DEFAULT);
                $ubdate = $bdd->query("UPDATE utilisateur SET password='$new_password' WHERE  id='$id'");


                $messsage = "<p class='Changement de Mot de passe Reussi  </p>";
            }
        }
    }
}


?>

<main class="container-xxl row p-4">
    <div class="col-8">
        <h3>Changement de mot de passe</h3>
        <form action="" method='POST' class='p-5'>
            <?= $messsage ?>
            <div class="col-6 ">
                <label for="inputPassword2" class="visually">Mot de passe actuel</label>
                <input type="password" class="form-control m-2" name='old_password' id="inputPassword2"  required>
            </div>

            <div class="col-6 ">
                <label for="inputPassword2" class="visually">Nouveau mot de passe </label>
                <input type="password" class="form-control m-2" name='new_password1' id="inputPassword2"  required>
            </div>
            <div class="col-6 ">
                <label for="inputPassword2" class="visually">Répété le nouveau mot de passe </label>
                <input type="password" class="form-control m-2" name='new_password2' id="inputPassword2"  required>
            </div>

            <input type="submit" class='btn btn-info' value="Valider">
        </form>



    </div>
    <?php

    include_once '../component/aside.php';

    ?>
</main>



<?php

include_once   "../component/footer.php";

?>