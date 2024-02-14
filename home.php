<?php
require_once "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $mail = new PHPMailer(true);

        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'saraahayaa012@gmail.com'; // Votre adresse e-mail Gmail
        $mail->Password = 'fyog kpjk sqch mqkp'; // Votre mot de passe Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 25;

        // Informations sur l'expéditeur et le destinataire
        $mail->setFrom('sender@example.com', 'Magazine de mode');
        $mail->addAddress('saraahayaa012@gmail.com', 'Recipient Name'); // Ajoutez votre destinataire

        // Contenu de l'e-mail
        $mail->Subject = 'Sujet de l\'e-mail';
        $mail->Body = "Nom : " . $name . "\n";
        $mail->Body .= "E-mail : " . $email . "\n";
        $mail->Body .= "Message : " . $message . "\n";

        // Envoyer l'e-mail
        $mail->send();
        echo 'E-mail envoyé avec succès !';
    }
} catch (Exception $e) {
    echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Magazine de mode</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="main.js" defer></script>
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
                    <a href="inscription.php"><i class="fas fa-user-plus" style="color: white;"></i></a>
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
                    <li><a class="active" href="home.php">Home</a></li>
                    <li><a href="news.php" target="_blank">News</a></li>
                    <li><a href="review.php">Reviews</a></li>
                    <li><a href="#">History & Features</a></li>
                    <li><a href="Fashionstyleguide.php">Fashion &Styling guide</a></li>
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

    <section class="titre">
        <h2 class="titlee">Magazine du mode</h2>
        <div class="search-container">
            <form action="search.php" method="GET">
                <input type="text" name="query" class="search-input" placeholder="Recherche...">
                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </section>

    <section class="image-section">
        <div class="photo-container">
            <img src="photo.jpg" alt="Photo">
        </div>
    </section>

    <?php
if (basename($_SERVER['PHP_SELF']) == "home.php") {
    // Connexion à la base de données
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'espace_membre';

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if ($conn->connect_error) {
        die('Erreur de connexion à la base de données : ' . $conn->connect_error);
    }

    $sql = "SELECT * FROM articles WHERE page = 'home' and section='Highlights'";
    $result = $conn->query($sql);
    ?>

    <section class="text">
        <div class="container">
            <h3 class="titlee">Highlights</h3>
            <div class="cards">

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $titre = $row['titre'];
                        $contenu = $row['contenu'];
                        $imagePath = $row['image'];
                        ?>

                <div class="card">
                    <div class="img-card">
                        <img src="espace_admin\uploads<?php echo $imagePath; ?>" alt="">
                        <?php  echo var_dump ($imagePath); ?>
                    </div>

                    <div class="info">
                        <a class="date" href=""><i class="far fa-clock"></i><?php echo $row['date']; ?></a>
                        <h2 class="heading2"><a href="news.php"><?php echo $titre; ?></a></h2>
                        <p><?php echo $contenu; ?></p>

                    </div>
                </div>

                <?php
                    }
                } else {
                    echo "Aucun article trouvé.";
                }
                ?>

            </div>
        </div>
    </section>

    <?php
}
?>



    <section class="contact-us">
        <div class="contact-content">
            <div class="contact-info">
                <h2>Let's talk</h2>
                <p>Ask us anything or just say hi to fashion!</p>
            </div>
            <div class="contact-form">
                <form action="home.php" method="POST">

                    <input type=" text" name="name" placeholder="Your name" tabindex="1" required>
                    <input type="email" name="email" placeholder="Your email" tabindex="2" required>
                    <textarea name="message" placeholder="Your message" tabindex="3" required></textarea>
                    <button type="submit" name="ok">Send</button>
                </form>
            </div>
        </div>
        <div class="contact-image">
            <img src="phoo5.jpg" alt="Contactez-nous">
        </div>
    </section>
    <footer class=" footer-container">
        <div class="container">
            <div class="footer-column">
                <h4>Catégories</h4>
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
                <p>Téléphone : +1 234 567 890</p>
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