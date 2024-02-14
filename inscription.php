<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');

$message = "";

if (isset($_POST['envoi'])) {
    if (isset($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = $_POST['mdp'];
        $email = $_POST['email'];

        $checkUser = $bdd->prepare('SELECT * FROM utilisateur WHERE email = ? OR pseudo = ?');
        $checkUser->execute(array($email, $pseudo));
        $existingUser = $checkUser->fetch();

        if (!$existingUser) {
            // Utilisation de l'algorithme de hachage bcrypt
            $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT);

            $insertUser = $bdd->prepare('INSERT INTO utilisateur(pseudo, email, mdp) VALUES (?, ?, ?)');
            $success = $insertUser->execute(array($pseudo, $email, $hashedPassword));

            if ($success) {
                $message = "Inscription réussie !";
            } else {
                $message = "Erreur lors de l'inscription.";
            }
        } else {
            $message = "Un utilisateur avec le même email ou le même pseudo existe déjà.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
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


    <section id="creer-compte" class="inscription creer-compte">
        <div class="container">
            <div class="partone">
                <div class="block">
                    <h2 class="title-insc">happy to see you again!</h2>
                    <p class="text">If you have an account, log in here.</p>
                    <button onclick="Connecter()" id="se-connecter_btn"><a href="connexion.php"> log in</a>
                    </button>
                </div>
            </div>
            <div class="parttow">
                <p><?php echo $message; ?></p>
                <h2 class="title-insc">Create an account</h2>

                <form action="inscription.php" method="POST">
                    <input type="text" name="pseudo" placeholder="Enter Your Name" required>
                    <input type="email" name="email" placeholder="Enter Your Email" required>
                    <input type="password" name="mdp" placeholder="Enter Your Password" required>
                    <button class="btn" name="envoi"> Create an account</button>
                </form>

            </div>
        </div>
    </section>
    <footer class="footer-container">
        <div class="container">
            <div class="footer-column">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Reviews</a></li>
                    <li><a href="#">History & Features</a></li>
                    <li><a href="#">Fashion & Styling guide</a></li>
                    <li><a href="#">Lifestyle & fashion</a></li>
                    <li><a href="#">Designers</a></li>
                    <li><a href="#">Brands</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Réseaux sociaux</h4>
                <ul>
                    <li><a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>Facebook</li>
                    <li><a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>Twitter</li>
                    <li><a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>Instagram</li>
                    <li><a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>Pinterest</li>

                </ul>
            </div>
            <div class="footer-column">
                <h4>Contactez-nous</h4>
                <p>Adresse : 123 rue Example, Ville, Pays</p>
                <p>TÃ©lÃ©phone : +1 234 567 890</p>
                <p>Email : info@example.com</p>
            </div>
        </div>
        <div class="copyright">
            <ul>
                <h3> CopyRight &copy;Bendjeddou Nourhane</h3>
            </ul>
        </div>
    </footer>
    <script>
    /* inscription page  */
    const creer_compte = document.getElementById('creer-compte');

    const se_connecter = document.getElementById('se-connecter');
    se_connecter.classList.add('hide');

    const se_connecter_btn = document.getElementById('se-connecter_btn');

    const creer_compte_btn = document.getElementById('creer-compte-btn');

    const partone = document.querySelectorAll('.partone');

    const parttow = document.querySelectorAll('.parttow');


    var element;

    function Connecter() {
        if (element == 1) {
            creer_compte.style.display = 'block';
            se_connecter.style.display = 'none';
            animation();
            return element = 0;
        } else {
            creer_compte.style.display = 'none';
            se_connecter.style.display = 'block';
            animation();
            return element = 1;
        }
    }

    function animation() {
        partone.forEach(function(item) {
            item.classList.add("animation2");
        })
        parttow.forEach(function(item) {
            item.classList.add("animation1");
        })
    }
    </script>


</body>

</html>