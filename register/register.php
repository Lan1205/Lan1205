<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Reifenmanagement</title>
</head>
<body>
<?php

    require("../database/dbConnect.php");
    if(isset($_POST['submit'])){
        $lastname = $_POST['nachname'];
        $firstname = $_POST['vorname'];
        $birthdate = strtotime($_POST["birthdate"]);
        $birthdate = date('Y-m-d H:i:s', $birthdate);
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $position;
        $password = $_POST['password'];
        
        if(!empty($_POST['position'])) {
            $selected = $_POST['position'];
            if($selected == "mitarbeiter")
            $position = 3;
            else if($selected == "reifenmanager")
            $position = 2;
            else if($selected == "ingenieur")
            $position = 1;
            else
            $position = 3;
        }
        //echo $birthdate;
        
    register($lastname, $firstname, $birthdate, $phonenumber, $position, $email, $firstname, $password);
    
    }

?>
    <!--Register Form-->
    <form class="box" action="" method="post">
        <h1 style="color:rgb(212, 212, 212)">Register</h1>
        <label for="vorname">Vorname</label> 
        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
        <label for="nachname">Nachname</label><br>
        <input type="text" id="vorname" name = "vorname">&ensp;&ensp;&ensp;&ensp;
        <input type="text" id = "nachname" name = "nachname"><br>
        <label for="birthday">Geburtsdatum</label>&ensp;&ensp;
        <input type="date" id="birthday" name= "birthdate"><br>
        <label for="email">Email</label>&ensp;&ensp;
        <input type="email" id="email" name = "email"><br>
        <label for="phone">Phone number</label>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
        <label for="stelle">Stelle</label><br>
        <input type="text" name ="phonenumber">&ensp;&ensp;&ensp;&ensp;&nbsp;
        
        <select name="position" id="stelle">
            <option value="mitarbeiter">Mitarbeiter</option>
            <option value="reifenmanager">Reifenmanager</option>
            <option value="ingenieur">Ingenieur</option>
          </select><br>
        <label for="password">Password</label><br>
        <input type="password" name = "password"><br>
        <label for="confirmPassword">Confirm your password</label><br>
        <input type="password" name= "confirmPassword"><br>
        <input type="submit" class="register" value = "Register" name="submit">
        <a href="../admin/admin.php" class="button">Fertig</a>

    </form>
</body>
</html>