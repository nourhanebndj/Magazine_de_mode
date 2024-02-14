<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Forget Password</title>
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
                <h2 class="title-insc">Forget Password</h2>
                <a href="inscription.php">I do not have an account</a>
                <form action="password.php" method="POST">
                    <input type="email" name="email" placeholder="Enter Your Email" required>
                    <button class="btn" name="envoi" type="submit">Recover the password</button>
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
    <?php

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Vérifier si l'email existe déjà dans la base de données
    $db = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');
    $sql = "SELECT * FROM utilisateur WHERE email=?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // L'email existe, vous pouvez envoyer le lien de réinitialisation du mot de passe
        echo "Email exists";
        
        $nouveau_password = uniqid();
        $url = "http://localhost:3000/newpassword.php?email=$email";
        $message = "Bonjour, voici le lien pour réinitialiser votre mot de passe : $url";
        $headers = 'Content-Type: text/plain; charset=utf-8';

        if (mail($email, 'Mot de passe oublié', $message, $headers)) {
            echo "Email sent";

            // Stocker le mot de passe généré dans la base de données pour l'utilisateur
            $sql = "UPDATE utilisateur SET nouveau_password=? WHERE email=?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$nouveau_password, $email]);
        } else {
            echo 'Erreur lors de l\'envoi de l\'email.';
        }
    } else {
        // L'email n'existe pas
        echo "Email does not exist";
    }
}
?>
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