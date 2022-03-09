<?php
//Définition des classes

class Modérateur extends Login {
    //Attributs
    private String $Username;
    private String $Password;

    //constructeur
    public function __construct($Username, $Password)
    {
        $this->Username = $Username;
        $this->Password = $Password;
    }

    //Méthodes

    public function emptyInput() {
        if (empty($this->Username) || empty($this->Password)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    public function loginUser() {
        if ($this->emptyInput() == false) {
            header("Location: index.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->Username, $this->Password);
    }
}

class Login extends BDD_Users {

    public function getUser($id, $pwd)
    {
        $stmt = $this->connection()->prepare('SELECT * FROM Users WHERE Username = ?;');

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            //Technical error
            header("Location: index.php?error=stmtfailed");
            exit();
        }

        //Vérifier si l'utilisateur existe
        
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: index.php?error=usernotfound");
            exit();
        }
        
        $bddPass = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($bddPass[0]["pass"] != $pwd) {
            $stmt = null;
            header("Location: index.php?error=wrongpassword");
            exit();
        }
        elseif ($bddPass[0]["pass"] == $pwd) {
            $stmt = $this->connection()->prepare('SELECT * FROM Users WHERE Username = ? AND pass = ?;');

            if (!$stmt->execute(array($id, $pwd))) {
                $stmt = null;
                header("Location: index.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("Location: index.php?error=usernotfound");
                exit();
            }
            
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["User"] = $user[0]["Username"];
            $stmt = null;
        }
    }
}
?>