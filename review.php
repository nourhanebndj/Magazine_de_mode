<!DOCTYPE html>
<html>

<head>
    <title>Reviews</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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
                    <li><a class="active" href="home.php">Home</a></li>
                    <li><a href="news.html" target="_blank">News</a></li>
                    <li><a href="review.php">Reviews</a></li>
                    <li><a href="#">History & Features</a></li>
                    <li><a href="Fashionstyleguide.php">Fashion & Styling guide</a></li>
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


    <?php
  // Connexion à la base de données
  $dbHost = 'localhost';
  $dbUser = 'root';
  $dbPass = '';
  $dbName = 'espace_membre';
  
  $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
  if ($conn->connect_error) {
      die('Erreur de connexion à la base de données : ' . $conn->connect_error);
  }
  
  // Récupérer les 4 articles les plus récents pour la section "Trending Posts"
  $trendingQuery = "SELECT * FROM articles WHERE page='review' ORDER BY date DESC LIMIT 4";
  $trendingResult = $conn->query($trendingQuery);
  
  // Récupérer les autres articles pour la section "Nouveaux articles"
  $newArticlesQuery = "SELECT * FROM articles  WHERE page='review'  ORDER BY date DESC ";
  $newArticlesResult = $conn->query($newArticlesQuery);
  
  // Fermer la connexion à la base de données
  $conn->close();
  ?>

    <div class="page-wrapper">
        <div class="container">
            <h1 class="titlee">Trending Posts</h1>
            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next"></i>
            <div class="post-wrapper">
                <?php while ($row = $trendingResult->fetch_assoc()) { ?>
                <div class="post">
                    <img src="espace_admin/uploads<?php echo $row['image']; ?>" alt="" class="slider-image">
                    <div class="post-info">
                        <a href="#">
                            <h4><?php echo $row['titre']; ?></h4>
                        </a>
                        <div class="icons">
                            <span><i class="far fa-calendar"></i><?php echo $row['date']; ?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <section class="article-section">
        <div class="container">
            <h1 class="titlee">Nouveaux articles</h1>
            <?php while ($row = $newArticlesResult->fetch_assoc()) { ?>
            <div class="article">
                <img src="espace_admin/uploads<?php echo $row['image']; ?>" alt="<?php echo $row['titre']; ?>">
                <div class="content">
                    <h2><?php echo $row['titre']; ?></h2>
                    <p><?php echo $row['contenu']; ?></p>
                    <p>Date de publication : <?php echo $row['date']; ?></p>
                </div>
                <a class="btn">read more</a>
            </div>
            <?php } ?>
        </div>
    </section>


    <footer class="footer-container">
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

    <script type="text/javascript">
    $(document).ready(function() {
        $('.post-wrapper').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            nextArrow: $('.next'),
            prevArrow: $('.prev'),
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 880,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 540,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
    </script>
</body>

</html>