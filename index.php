<?php 
session_start();
if(!$_SESSION['mdp']){
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <style>
    /* Styles CSS pour la mise en page */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .menu {
        display: flex;
        justify-content: center;
        background-color: #1f2937;
        padding: 10px;
        border-radius: 10px;
    }

    .menu-item {
        margin-right: 20px;
        position: relative;
    }

    .menu-item:last-child {
        margin-right: 0;
    }

    .menu-link {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        font-size: 16px;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .menu-link:before {
        content: "";
        position: absolute;
        top: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 10px;
        height: 10px;
        background-color: #ff5f5f;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .menu-link:hover {
        background-color: #ff5f5f;
    }

    .menu-link:hover:before {
        opacity: 1;
    }
    </style>
</head>

<body>
    <h1>Home</h1>
    <nav class="menu">
        <a class="menu-item" href="membre.php">
            <span class="menu-link">Afficher tous les membres</span>
        </a>
        <a class="menu-item" href="ajouterarticle.php">
            <span class="menu-link">Ajouter des Articles</span>
        </a>
        <a class="menu-item" href="modifier_supprimer_des_articles.php">
            <span class="menu-link">Modifier des Articles/Suppression</span>
        </a>
        <!-- Ajoutez d'autres liens ici si nécessaire -->
    </nav>
</body>

</html>