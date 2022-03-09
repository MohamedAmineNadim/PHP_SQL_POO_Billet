<?php
    include_once '../header.php';
    session_start();
?>
    <title>Accueil</title>
</head>
<body id="body">
    <section class="nav">
        <div>
            <form action="search.inc.php" method="post">
                <ul>
                    <li><input type="submit" name="home" value="Home" class="btn-info"></input></li>
                    <?php
                    if (isset($_SESSION["User"]))
                    {
                    ?>
                    <li><input type="submit" name="logout" value="Log out" class="btn-info"></input></li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li><input type="submit" name="login" value="Log in" class="btn-info"></input></li>
                    <?php
                    }
                    ?>
                </ul>
            </form>
        </div>
    </section>

    <section id="WelcomeMsg">
        <div class="welcome center">
            <h3>Bienvenue !</h3>
            <p>
                Un billet est un article court, voire très court, dans lequel un journaliste exprime une opinion,
                un point de vue décalé et humoristique, une vision inattendue ou démystificatrice sur un fait
                d'actualité. Il peut aussi s'indigner. On trouve donc à la fois une leçon morale et des traits
                d'esprit...
            </p>
            <p style="font-weight: bold; font-style: italic;">Pour publier un commentaire, il faudra être modérateur. Le formulaire ci-dessous vous permettra
                de vous connecter à votre compte.
            </p>
        </div>
    </section>
    <?php
    include 'search.inc.php';
        if (isset($_GET['error'])) {
            if ($_GET['error'] != 'home' && $_GET['error'] != 'recherche'){
                if ($_GET['error'] == 'login')
                {
                    //Login form with no error messages
                    echo "<p class='center'>Fill in the form to login</p>";
                }
                //Login form + errors
                
                else if ($_GET['error'] == 'emptyinput')
                {
                    echo "<p class='center'>Please fill in all fields !</p>";
                }
                
                else if ( $_GET['error'] == 'stmtfailed')
                {
                    echo "<p class='center'>Uh oh, something went wrong... Please try again in a moment !</p>";
                }
                
                else if ($_GET['error'] == 'usernotfound')
                {
                    echo "<p class='center'>User not found !</p>";
                }
                
                else if ($_GET['error'] == 'wrongpassword')
                {
                    echo "<p class='center'>Wrong password !</p>";
                }
                echo "<section id='LoginForm'>
                        <div id='form' class='center'>
                            <div>
                                <span id = 'form_header'>
                                    <label>Connexion</label>
                                </span>
                                <br>
                                <form action='login.inc.php' method='post'>
                                    <div class='formElements'> Numéro d'identifiant
                                    </div>
                                    <br>
                                    <div class='form-group'>
                                        <input  type='text' name='ID' id='numID' placeholder='Identifiant'>
                                        <br>
                                    </div>
                                    <label class='formElements' for='mot_de_passe'>Mot de passe</label>
                                    <br>
                                    <div class='form-group'>
                                        <input  type='password' name='Pwd' id='mot_de_passe' placeholder='Mot de passe'>
                                        <br>
                                    </div>
                                    <br>
                                    <div id='centerButton' class='form-group'>			
                                        <input class='btn btn-info' type='Submit' value='Me connecter' name='Submit'>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </section>";
    ?>
    <section id="search">
        <form action="search.inc.php" method="post">
            <div >
                <h4>Recherche de billets :</h4>
                <span>
                    <input type="text" name="titrebillet" placeholder="Titre du billet" class="form-group">
                    <input type="date" name="datebillet" class="form-group">
                    <input type="submit" name="recherchebillet" class="btn-primary" value="Recherche">
                </span>
            </div>
        </form>
    </section>
    <?php
            }
            else {
                //affichage Tableau de billets/articles

                echo "<section id='search'>
                        <form action='search.inc.php' method='post'>
                            <div >
                                <h4>Recherche de billets :</h4>
                                <span>
                                    <input type='text' name='titrebillet' placeholder='Titre du billet' class='form-group'>
                                    <input type='date' name='datebillet' class='form-group' value=''>
                                    <input type='submit' name='recherchebillet' class='btn-primary' value='Recherche'>
                                </span>
                            </div>
                        </form>
                    </section>";
            }
        }
        else {
            if (isset($_SESSION["User"]))
            {
                $usr = $_SESSION["User"];
                echo "<h3>Welcome $usr !</h3>";
            }
            echo "<section id='search'>
                        <form action='search.inc.php' method='post'>
                            <div >
                                <h4>Recherche de billets :</h4>
                                <span>
                                    <input type='text' name='titrebillet' placeholder='Titre du billet' class='form-group'>
                                    <input type='date' name='datebillet' class='form-group' value=''>
                                    <input type='submit' name='recherchebillet' class='btn-primary' value='Recherche'>
                                </span>
                            </div>
                        </form>
                    </section>";
                
                    $Billet = new Affichage();
                    
                    $titre = $_GET['titrebillet'];
                    $date = $_GET['datebillet'];

                    if (empty($titre) && !empty($date)) {
                        $titre = "";
                        $Billet->getBillet($titre, $date);
                    }
                    else if (empty($date) && !empty($titre)) {
                        $date = "1999-01-01";
                        $Billet->getBillet($titre, $date);
                    }
                    else if (empty($date) && empty($titre)) {
                        $Billet->getAll();
                    };
        }
    ?>
    
</body>
</html>