<?php
//Définition des classes

class Billet {
    //Attributs (cf. Base de données)
    private int $id_bil;
    private string $date_bil; 
    private String $titre_bil;
    private String $contenu;

    //Constructeur
    public function __construct($date_bil,$Titre_bil)
    {
        $this->date_bil = $date_bil;
        $this->titre_bil = $Titre_bil;
    }

    //Méthodes
    //Getters
    public function getId_bil(){
        return $this->id_bil;
    }

    public function getDate_bil(){
        return $this->date_bil;
    }
    public function getTitre_bil(){
        return $this->titre_bil;
    }
    public function getcontenu(){
        return $this->contenu;
    }
    
    //Setters
    public function setId_bil($Id_bil){
        $this->id_bil=$Id_bil;
    }
    public function setDate_bil($Date_bil){
        $this->date_bil=$Date_bil;
    }
    public function setTitre_bil($Titre_bil){
     $this->titre_bil=$Titre_bil;
    }
    public function setmail_auteur($contenu){
        $this->contenu=$contenu;
     }
}

class Commentaire {
    //Attributs (cf. Base de données)
    private int $id_com;
    private String $date_com;
    private String $auteur_com;
    private String $mail_auteur;
    private String $commenaitre;
    private int $id_bil;
    
    //Constructeur
    public function __construct($id_com,$date_com,$auteur_com,$mail_auteur,$commenaitre,$id_bil)
    {
    $this->id_com=$id_com;
    $this->date_com=$date_com;
    $this->auteur_com=$auteur_com;
    $this->mail_auteur=$mail_auteur;
    $this->commenaitre=$commenaitre;
    $this->id_bil=$id_bil;
    }

    //Méthodes
    //Getters
    public function getId_com(){
        return $this->id_com;
    }

    public function getDate_com(){
        return $this->date_com;
    }
    public function getauteur_com(){
        return $this->auteur_com;
    }
    public function getmail_auteur(){
        return $this->mail_auteur;
    }
    public function getcommenaitre(){
        return $this->commenaitre;
    }
    public function getid_bil(){
        return $this->id_bil;
    }

    //Setters
    public function setId_com($id_com){
        $this->id_com=$id_com;
    }
    public function setdate_com($date_com){
        $this->date_com=$date_com;
    }
    public function setauteur_com($auteur_com){
     $this->auteur_com=$auteur_com;
    }
    public function setmail_auteur($mail_auteur){
        $this->mail_auteur=$mail_auteur;
     } 
     public function setcommenaitre($commenaitre){
        $this->commenaitre=$commenaitre;
     }
     public function setid_bil($id_bil){
        $this->id_bil=$id_bil;
     }
}

class Affichage extends BDD_Articles {
    public function getBillet($titre, $date) {
        $sql = "SELECT * FROM Billet WHERE (Titre_bil LIKE '%$titre%') OR (Date_bil = '$date') ORDER BY Date_bil ASC;";
        $stmt = $this->connexion()->prepare($sql);

        if (!$stmt->execute()){
            $stmt = null;
            //Technical error
            header("Location: index.php?error=stmtfailed");
            exit();
        }

        else {
            $link =  mysqli_connect( "localhost", "root", "Root2022!", "Billet_TP");
            $result = mysqli_query($link,$sql);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {
                echo "<br><br><h5>Résultats de votre recherche :</h5><br>";
                echo "<p>Aucun résultat...</p>";
            }
            else {
                echo "<br><br><h5>Résultats de votre recherche :</h5><br>";
                echo "<section><div>";
                echo "<table border=2>\n";
                echo "<tr>\n";
                echo "\t<td>Id billet</td>\n";
                echo "\t<td>Date de publication</td>\n";
                echo "\t<td>Titre</td>\n";
                echo "\t<td>Contenu</td>\n";
                echo "</tr>\n";
                
                while ( $a_row = mysqli_fetch_row($result) )
                {
                    foreach ( $a_row as $field ){ // Affichage d'un champ dans la cellule du tableau
                        echo "\t<td>$field</td>\n"; 
                    }
                    echo "</tr>\n";
                }
                echo "</div></section>";
            }
        }
        
    }

    public function getAll() {
        $sql = 'SELECT b.Id_bil, b.Date_bil, b.Titre_bil, b.contenu, c.Id_com, c.date_com, c.auteur_com, c.mail_auteur, c.commentaire FROM Billet as b, Commentaire as c;';
        
        $stmt = $this->connexion()->prepare($sql);

        if (!$stmt->execute()){
            $stmt = null;
            //Technical error
            header("Location: index.php?error=stmtfailed");
            exit();
        }

        else {
            $link =  mysqli_connect( "localhost", "root", "Root2022!", "Billet_TP");
            $result = mysqli_query($link,$sql);
            echo "<br><br><h5>Tout les billets :</h5><br>";
            echo "<section><div>";
            echo "<table border=2>\n";
            echo "<tr>\n";
            echo "\t<td>Id billet</td>\n";
            echo "\t<td>Date de publication</td>\n";
            echo "\t<td>Titre</td>\n";
            echo "\t<td>Contenu</td>\n";
            echo "\t<td>Id commentaire</td>\n";
            echo "\t<td>Date du commentaire</td>\n";
            echo "\t<td>Auteur</td>\n";
            echo "\t<td>Mail auteur</td>\n";
            echo "\t<td>Commentaire</td>\n";
            echo "</tr>\n";

            while ( $a_row = mysqli_fetch_row( $result ) )
            {
                foreach ( $a_row as $field ){ // Affichage d'un champ dans la cellule du tableau
                    echo "\t<td>$field</td>\n"; 
                }
                echo "</tr>\n";
            }
            echo "</div></section>";
        }
    }

}
?>