<?php
include 'db.php';

$dbHost = 'localhost'; // Remplacez par votre hôte de base de données
$dbName = 'espace_membre'; // Remplacez par le nom de votre base de données
$dbUsername = 'root'; // Remplacez par votre nom d'utilisateur de base de données
$dbPassword = ''; // Remplacez par votre mot de passe de base de données

// Établir la connexion à la base de données
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>New Password</title>
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

<body>
    <section id="se-connecter" class="inscription se-connecter">
        <div class="container">
            <div class="partone">
                <h2 class="title-insc">Reset Password</h2>
                <form action="newpassword.php" method="POST">
                    <input type="password" name="new_password" placeholder="Enter the new password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm the new password" required>
                    <input type="hidden" name="email"
                        value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">


                    <button class="btn" name="submit" type="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </section>
    <?php 
   if (isset($_POST['submit'])) {
       $newPassword = $_POST['new_password'];
       $confirmPassword = $_POST['confirm_password'];
       $email = $_POST['email'];
   
       if ($newPassword === $confirmPassword) {
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
   
           // Vérifier l'existence de l'utilisateur
           $checkUser = $bdd->prepare('SELECT * FROM utilisateur WHERE email = ?');
           $checkUser->execute([$email]);
           $user = $checkUser->fetch();
   
           if ($user) {
               // Générer le hachage bcrypt du nouveau mot de passe
               $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
   
               // Mettre à jour le mot de passe de l'utilisateur dans la base de données
               $updateUser = $bdd->prepare('UPDATE utilisateur SET mdp = ? WHERE email = ?');
               $updateUser->execute([$hashedPassword, $email]);
   
               if ($updateUser->rowCount() > 0) {
                   echo "Le mot de passe a été mis à jour avec succès.";
               } else {
                   echo "Échec de la mise à jour du mot de passe.";
               }
           } else {
               echo "Utilisateur introuvable.";
           }
       } else {
           echo "Les mots de passe ne correspondent pas.";
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
</body>

</html>