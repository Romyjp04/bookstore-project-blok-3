<?php

require "database_connection.php";


$id = $_GET['id'];


$sql = "SELECT * FROM boeken WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Haal het boek op als een associatieve array
    $boek = mysqli_fetch_assoc($result);

    // Voeg hier meer velden toe die je wilt weergeven
} else {
    echo "Geen resultaten gevonden.";
}



    mysqli_close($conn);


var_dump($boek);











?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    







<div class="boek-container">
    <table>
        <thead>
            <tr>
                <th>id </th>
                <th>titel </th>
                <th>auteur </th>
                <th>genre </th>
                <th>beschrijving </th>
                <th>isbn </th>
                <th>paginas </th>
                <th>uitgeverij </th>
                <th>publicatiejaar </th>
                <th>prijs </th>
                <th>thumbnail_url </th>
             
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td><?php echo $boek['id']; ?></td>
                    <td><?php echo $boek['titel']; ?></td>
                    <td><?php echo $boek['auteur']; ?></td>
                    <td><?php echo $boek['genre']; ?></td>
                    <td><?php echo $boek['beschrijving']; ?></td>
                    <td><?php echo $boek['isbn']; ?></td>
                    <td><?php echo $boek['paginas']; ?></td>
                    <td><?php echo $boek['uitgeverij']; ?></td>
                    <td><?php echo $boek['publicatiejaar']; ?></td>
                    <td><?php echo $boek['prijs']; ?></td>
                    <td><?php echo $boek['thumbnail_url']; ?></td>
                </tr>
        </tbody>
    </table>
</div>
</body>
</html>