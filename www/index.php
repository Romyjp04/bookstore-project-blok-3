<?php
// Database connectie
$mysqli = new mysqli("mariadb", "root", "password", "bookstore");

// Checkt de connectie
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//haalt genres op
$sql = "SELECT DISTINCT genre FROM boeken";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Haalt alle resultaten op als een associatieve array
    $genres = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
//checkt of genre gezet is
if (isset($_GET["genre"])){
    $genre = $_GET["genre"];
    $stmt = $mysqli->prepare("SELECT * FROM boeken WHERE genre = ?");
    $stmt->bind_param("s", $genre);
    $stmt->execute();
    
    // resultaat
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $boeken = $result->fetch_all(MYSQLI_ASSOC);
    }

    $stmt->close();
}
else{

    // Query
    $sql = "SELECT * FROM boeken";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Haalt alle resultaten op als een associatieve array
        $boeken = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    // sluit connectie
    $mysqli->close();   

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
</head>
<body>

<!-- navbar -->
 
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="justify-content-md-center">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link active " href="/">Bookstore</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- <div class="image" >
<img src="images/boekfoto.jpg">
</div> -->

<div class="container mt-5">
    <!-- filter dynamisch uit database -->
    <div class="row">
        <div class="col-2">
            <ul class="dropdown-menu position-static d-grid gap-1 p-2 rounded-3 mx-0 border-0 shadow w-220px" data-bs-theme="dark">
                <li><p class="dropdown-item rounded-2 disabled">resultaten: <?php echo count($boeken); ?></p></li>
                <li><a class="dropdown-item rounded-2" href="index.php" >Alles</a></li>
                <?php foreach($genres as $genre ){ ?>
                <li><a class="dropdown-item rounded-2" href="index.php?genre=<?php echo $genre['genre']?>" ><?php echo $genre['genre']?></a></li>
            
                <?php } ?>
            </ul>
        </div>
      
        <div class="col-9 " >
            <div class="row">
                <?php foreach ($boeken as $boek) { ?>
                    <!-- kaarten voor boeken -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="detail.php?id=<?php echo $boek['id']; ?>">
                                <img src="images/<?php echo $boek['thumbnail_url']; ?>" class="card-img-top" alt="<?php  echo $boek['titel']; ?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $boek['titel']; ?></h5>
                                <p class="card-text">Auteur: <?php echo $boek['auteur']; ?></p>
                                <p class="card-text">prijs: &#8364;<?php echo $boek['prijs']; ?></p>
                                <p class="card-text">genre: <?php echo $boek['genre']; ?></p>
                                <!--button -->
                                <a class="btn btn-dark" href="detail.php?id=<?php echo $boek['id']; ?>">Lees meer</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>