<?php
// Database connection
$mysqli = new mysqli("mariadb", "root", "password", "bookstore");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query
$sql = "SELECT * FROM boeken";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Fetch all results as an associative array
    $boeken = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
// Close connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop>
            <source src="images/red-smoke-corner-background-animation-free-video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
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
    <div class="row">
        <?php foreach ($boeken as $boek) { ?>
            <!-- Create a card for each book -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="detail.php?id=<?php echo $boek['id']; ?>">
                        <img src="<?php echo $boek['thumbnail_url']; ?>" class="card-img-top" alt="<?php  echo $boek['titel']; ?>">
                    </a>
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $boek['titel']; ?></h5>
                        <p class="card-text">Auteur: <?php echo $boek['auteur']; ?></p>
                        <p class="card-text">prijs: &#8364;<?php echo $boek['prijs']; ?></p>
                        <p class="card-text">genre: <?php echo $boek['genre']; ?></p>

                        <a class="btn btn-dark" href="detail.php?id=<?php echo $boek['id']; ?>">Lees meer</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
    
</body>
</html>