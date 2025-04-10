<?php

require "database_connection.php";


// Controleer de verbinding
if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}

// Stap 2: Voer een SQL-query uit



if (isset($_GET['genre'])) {
    if (!empty($_GET['genre'])) {
        $genre = $_GET['genre'];
        $sql = "SELECT * FROM boeken WHERE genre  = '$genre'";
        $result = mysqli_query($conn, $sql);
        $boeken = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
else{

    $sql = "SELECT * FROM boeken";
    $result = mysqli_query($conn, $sql);
    $boeken = mysqli_fetch_assoc($result);

    $boeken = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $boeken[] = $row;
        }
    } 
    else {
        echo "Geen resultaten gevonden.";
    } 

}






// Sluit de verbinding
mysqli_close($conn);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">


</head>
<body>
 
 
<nav class="navbar">
<ul>
  <li><a class = "test" href= "index.php">Bookstore</a></li>
</ul>
</nav>



<div class="filter">
        <a href="index.php" class="filter-btn">Alle genres</a>
        <a href="?genre=fantasy" class="filter-btn">fantasy </a>
        <a href="?genre=jeugd" class="filter-btn">jeugd</a>
        <a href="?genre=Literaire fictie" class="filter-btn">Literaire fictie </a>
        <a href="?genre=Non-fictie" class="filter-btn"> Non-fictie</a>
        <a href="?genre=romantiek" class="filter-btn">romantiek </a>
        <a href="?genre=science fiction" class="filter-btn">Science Fiction</a>
        <a href="?genre=thriller" class="filter-btn">thriller</a>
        <a href="?genre=Young Adult" class="filter-btn">Young Adult</a>
    </div>

<div class="boek-container">
    <table>
        <thead>
            <tr>
               
                <th>titel </th>
                <th>auteur </th>
                <th>genre </th>
                <th>prijs </th>
                <th>actie </th>
                <!-- <th>beschrijving </th>
                <th>isbn </th>
                <th>paginas </th>
                <th>uitgeverij </th>
                <th>publicatiejaar </th> -->
               
               
             
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boeken as $boek): ?>
                <tr>
                   
                    <td><?php echo $boek['titel']; ?></td>
                    <td><?php echo $boek['auteur']; ?></td>
                    <td><?php echo $boek['genre']; ?></td>
                    <td><?php echo $boek['prijs']; ?></td>
                    <td><a href="detail.php?id=<?php echo $boek['id']; ?>">lees meer</a></td>
    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


</body>
</html>