<?php
// Database connectie
$mysqli = new mysqli("mariadb", "root", "password", "bookstore");

// Check de connectie
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// book id
$bookId = $_GET['id']; // Ensure the ID exists

// Valideer de query 
if (!empty($bookId) && is_numeric($bookId)) {
    $stmt = $mysqli->prepare("SELECT * FROM boeken WHERE id = ?");
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    
    // resultaat
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $boek = $result->fetch_assoc();
    }

    $stmt->close();
}

// sluit de connectie
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/index.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookstore</title>
</head>
<body>
<!-- navbar enzo -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="justify-content-md-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Bookstore</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <a class="btn btn-dark mb-3" href="/">Terug</a>
    <div class="row">
        <div class="col-md-4">
            <img src="images/<?php echo $boek['thumbnail_url']; ?>" alt="Book Thumbnail" class="img-fluid">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2><?php echo $boek['titel']; ?></h2>
                    <p><strong>Auteur:</strong> <?php echo $boek['auteur']; ?></p>
                    <p><strong>Genre:</strong> <?php echo $boek['genre']; ?></p>
                    <p><strong>Beschrijving:</strong> <?php echo $boek['beschrijving']; ?></p>
                    <p><strong>ISBN:</strong> <?php echo $boek['isbn']; ?></p>
                    <p><strong>Paginas:</strong> <?php echo $boek['paginas']; ?></p>
                    <p><strong>Uitgeverij:</strong> <?php echo $boek['uitgeverij']; ?></p>
                    <p><strong>Publicatiejaar:</strong> <?php echo $boek['publicatiejaar']; ?></p>
                    <p><strong>Prijs:</strong> &#8364;<?php echo $boek['prijs']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>




</body>
</html>