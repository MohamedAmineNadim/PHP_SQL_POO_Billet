<?php

include "bdd.classes.php";
include "search.classes.php";
include "logout.inc.php";


if (isset($_POST['home'])) {
    header("Location: index.php?error=home");
    exit();
}
else if (isset($_POST['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php?error=disconnected");
    exit();
}
else if (isset($_POST['login'])) {
    header("Location: index.php?error=login");
    exit();
}
else if (isset($_POST['recherchebillet'])) {
    //SQL search for billet...
    $titre = $_POST['titrebillet'];
    $date = $_POST['datebillet'];

    header("Location: index.php?titrebillet=$titre&datebillet=$date");
    exit();
}
?>