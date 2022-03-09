<?php
if (isset($_POST['Submit'])) {
    $id = $_POST['ID'];
    $mdp = $_POST['Pwd'];

    include "bdd.classes.php";
    include "login.classes.php";

    $login = new Modérateur($id, $mdp);

    $login->loginUser();

    header("Location: index.php");
}

?>