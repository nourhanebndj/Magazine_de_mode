<?php
// Variables de configuration de la base de données
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "espace_membre";

// Connexion à la base de données
$bdd = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword);

// Vérifier la connexion à la base de données
if (!$bdd) {
    die("La connexion à la base de données a échoué.");
}

$message = ""; // Initialise la variable $message avec une valeur par défaut

// Traitement de la connexion
if (isset($_POST['envoi'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Recherche de l'utilisateur dans la base de données
    $checkUser = $bdd->prepare('SELECT * FROM utilisateur WHERE email = ?');
    $checkUser->execute(array($email));
    $user = $checkUser->fetch();

    if ($user) {
        $hashedPassword = $user['mdp'];

        // Vérification du mot de passe
        if (password_verify($mdp, $hashedPassword)) {
            // Connexion réussie, rediriger vers la page d'accueil ou autre page souhaitée
            session_start();
            $_SESSION['connexion_reussie'] = true;
            header("Location: home.php");
            exit();
        } else {
            $message = "Identifiants de connexion invalides. Veuillez réessayer.";
        }
    } else {
        $message = "Identifiants de connexion invalides. Veuillez réessayer.";
    }
}

// Utilisation de la variable $message après son assignation
echo $message;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
</head>

<body>
    <header>
        <div class="container">
            <div class="menu1">
                <div class="header-menu">
                    <a href="#"><i class="fas fa-user-plus" style="color: white;"></i></a>
                    <i class="submenu fas fa-bars">
                        <ul class="menu-options">
                            <li><a href="#">Contact us</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Inscription</a></li>
                        </ul>
                    </i>
                </div>

                <div class="header-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>

            </div>

            <nav class="nav-one">
                <i onclick="showAndHideMenu()" class="icon fas fa-bars"></i>
                <ul class="nav-menu">
                    <li><a class="active" href="#">Home</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Reviews</a></li>
                    <li><a href="#">History & Features</a></li>
                    <li><a href="#">Fashion & Styling guide</a></li>
                    <li><a href="#">Lifestyle & fashion</a></li>
                    <li><a href="#">Designers</a></li>
                    <li><a href="#">Brands</a></li>
                </ul>
            </nav>


            <nav class="tablet-nav">
                <ul class="nav-list">
                    <i onclick="showAndHideMenus()" class="fas fa-bars"></i>
                    <li><a class="active" href="#">Home</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Reviews</a></li>
                    <li><a href="#">Designers</a></li>
                    <li><a href="#">Brands</a></li>
                </ul>
                <ol class="nav-menus">
                    <i onclick="showAndHideMenus()" class="fas fa-bars"></i>
                    <li><a class="active" href="#">Home</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Reviews</a></li>
                    <li><a href="#">Designers</a></li>
                    <li><a href="#">Brands</a></li>
                    <li><a href="#">History & Features</a></li>
                    <li><a href="#">Fashion & Styling guide</a></li>
                    <li><a href="#">Lifestyle & fashion</a></li>
                </ol>
            </nav>

        </div>
    </header>

    <section id="se-connecter" class="inscription se-connecter">
        <div class="container">
            <div class="partone">
                <p><?php echo $message; ?></p>
                <h2 class="title-insc">Login</h2>
                <a href="inscription.php">I do not have an account</a>
                <form action="connexion.php" method="POST">
                    <input type="email" name="email" placeholder="Enter Your Email" required>
                    <input type="password" name="mdp" placeholder="Enter Your Password" required>
                    <a href="password.php">Forgot your password?</a>
                    <button class="btn" name="envoi" type="submit">Connect</button>
                </form>

            </div>
            <div class="parttow">
                <div class="block">
                    <h2 class="title-insc">Welcome!</h2>
                    <p class="text">Create an account and join our community.</p>
                    <button onclick="Connecter()" id="creer-compte-btn"><a href="inscription.php">Create an
                            account</a></button>


                </div>
            </div>
        </div>
    </section>
</body>

</html>