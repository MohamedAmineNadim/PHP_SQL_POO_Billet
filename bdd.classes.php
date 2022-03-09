<?php
class BDD_Users {
    protected function connection() {
        try {
            $user = "root";
            $mdp = "Root2022!";
            $bdd = new PDO('mysql:host=localhost;dbname=usersinfo;', $user, $mdp);
            return $bdd;
        } catch (PDOException $e) {
            print "Error : " . $e->getMessage() . "</br>";
            die();
        }
    }
}

class BDD_Articles {
    protected function connexion() {
        try {
            $user = "root";
            $mdp = "Root2022!";
            $bdd = new PDO('mysql:host=localhost;dbname=Billet_TP;', $user, $mdp);
            return $bdd;
        } catch (PDOException $e) {
            print "Error : " . $e->getMessage() . "</br>";
            die();
        }
    }
}
?>