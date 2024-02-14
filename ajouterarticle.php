<?php
// Fonction pour vérifier si le fichier est une image
function isImage($fileType) {
    return strpos($fileType, 'image') === 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['titre']) && isset($_POST['contenu']) && isset($_FILES['image']) && isset($_POST['page']) && isset($_POST['date']) && isset($_POST['section'])) {

        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $page = $_POST['page'];
        $date = $_POST['date'];
        $section = $_POST['section']; // Ajout de l'attribut "section"

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {

            $tmpFilePath = $_FILES['image']['tmp_name'];

            $fileName = uniqid() . '_' . $_FILES['image']['name'];

            $uploadDir = 'C:\Users\nourh\Downloads\Bureau\magazine de mode\espace_admin\uploads';
            $filePath = $uploadDir . $fileName;

            // Vérification du type de fichier
            $fileType = $_FILES['image']['type'];
            if (!isImage($fileType)) {
                echo "<p class='error'>Invalid file type. Please upload an image.</p>";
                exit;
            }

            // Limite de taille du fichier
            $maxFileSize = 2 * 1024 * 1024; // 2 Mo
            if ($_FILES['image']['size'] > $maxFileSize) {
                echo "<p class='error'>The file exceeds the maximum allowed size (2MB).</p>";
                exit;
            }

            if (move_uploaded_file($tmpFilePath, $filePath)) {
                // Reste de votre code pour l'insertion dans la base de données

                $dbHost = 'localhost';
                $dbUser = 'root';
                $dbPass = '';
                $dbName = 'espace_membre';

                // Connexion à la base de données et exécution de l'insertion
                $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
                if ($conn->connect_error) {
                    die('Erreur de connexion à la base de données : ' . $conn->connect_error);
                }

                // Votre code d'insertion dans la base de données ici

                $sql = "INSERT INTO articles (titre, contenu, image, section, page, date) VALUES ('$titre', '$contenu', '$fileName', '$section', '$page', '$date')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<p class='success'>The article was successfully added to the page $page.</p>";
                } else {
                    echo "<p class='error'>An error occurred while adding the article: " . $conn->error . "</p>";
                }

                $conn->close();
            } else {
                echo "<p class='error'>An error occurred while uploading the image.</p>";
            }
        } else {
            echo "<p class='error'>An error occurred while uploading the image:" . $_FILES['image']['error'] . "</p>";
        }
    } else {
        echo "<p class='error'>Please fill in all mandatory fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Espace administrateur</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        color: #333;
        text-align: center;
        margin: 20px 0;
    }

    h2 {
        color: #666;
        margin-bottom: 10px;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
        color: #555;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
    }

    input[type="text"]:focus,
    textarea:focus {
        outline: none;
        background-color: #e0e0e0;
    }

    input[type="file"] {
        margin-top: 5px;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .error {
        color: red;
        margin-top: 5px;
    }

    .success {
        color: green;
        margin-top: 5px;
    }

    body {
        background-image: linear-gradient(to bottom, #f2f2f2, #d9d9d9);
    }

    .container {
        max-width: 500px;
    }

    form {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        border: 1px solid #ccc;
        padding: 12px;
    }

    input[type="text"]:focus,
    textarea:focus,
    input[type="file"]:focus {
        border-color: #4caf50;
    }

    input[type="submit"] {
        background-color: #4caf50;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .error,
    .success {
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Administrator area</h1>

        <h2>Add a new item</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <label for="titre">Title:</label>
            <input type="text" id="titre" name="titre" required>

            <label for="contenu">Description :</label>
            <textarea id="contenu" name="contenu" required></textarea>

            <label for="image">Add a picture :</label>
            <input type="file" id="image" name="image" required>

            <label for="page">Name of the page you want to add the article:</label>
            <input type="text" id="page" name="page" required>
            <label for="section">Section :</label>
            <select id="section" name="section" required>
                <option value="Highlights">Highlights</option>
                <option value="Featured Blog Post">Featured Blog Post</option>
                <option value="Latest Blog Posts">Latest Blog Posts</option>
                <option value="Blog Posts">Blog Posts</option>
                <option value="Top News">Top News</option>
                <option value="Review">Review</option>
                <option value="lifestyle&fashion">lifestyle&fashion</option>
                <!-- Ajoutez ici d'autres options pour les sections supplémentaires -->
            </select>
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" required>

            <input type="submit" value="Add">
        </form>
    </div>
</body>

</html>