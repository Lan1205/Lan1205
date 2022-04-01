<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reifenmanagement</title>
    </head>
    <body>
        <form action="rennlogik.php" method="post">
        <?php
        include_once './../database/database.php';
        include_once '../objects/rennen.php';

        $db = new Database();
        $conn = $db->getConnection();

        $rennen = new Rennen($conn);
        ?>
        <label>Standort angeben: <input type="text" id="standort" name="standort"></label>
        <label for="renndatum">Datum</label>
        <input type="date" name="renndatum" id="renndatum" value="2022-01-01"><br><br>
        <input type="submit" value="Rennen erstellen" name="erstellen"><br><br>
        <div id="rennen">
        <table border="2">
        <tr>
        <td>Standort</td>
        <td>Datum</td>
        <td></td>
        <td></td>
        <td></td>
        </tr>

            <?php
            include_once './../database/database.php';

             $db = new Database();
             $conn = $db->getConnection();
             $query = "SELECT * FROM rennen";
             $stmt = $conn->prepare($query);
             $stmt->execute();
             while($result = $stmt->fetch())
             {
             ?>    
                <tr>
                    <td><?php echo $result['standort'];?></td>
                    <td><?php echo $result['datum'];?></td>
                    <td><a href="edit.php?id=<?php echo $result['rennID']; ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $result['rennID']; ?>">Delete</a></td>
                    <td><a href="../prozess/prozess.php?id=<?php echo $result['rennID']; ?>">Prozess</a></td>
            <?php        
             }
            ?>
            </table><br>
        </div>
    </body>
</html>
