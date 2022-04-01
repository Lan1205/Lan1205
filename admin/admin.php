<?php
    session_start();

    if (isset($_SESSION['position'])) {
        $pos = $_SESSION['position'];
    }
    else
    {
        $pos = 0;
    }
    
    if($pos == 1)
    {
        $_SESSION['zeige']= "Ingenieur"; 
    }
    else if($pos== 2)
    {
        $_SESSION['zeige']= "Manager"; 
    }
    else if($pos == 3)
    {
        $_SESSION['zeige']= "Mitarbeiter"; 
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="author" content="" />
    <title>History</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="./prozess/prozess.php">
            <img class=" preload-me" src="../landmotor.png" width="180" height="45" sizes="150px">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../admin/admin.php">Admin</a></li>
                    <li><a class="dropdown-item" href="../Rennmanagement/rennmanagement.php">Rennmanagement</a></li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../login/login1.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"></div>
                        
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link" href="../prozess/prozess.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Prozess
                        </a>
                        <a class="nav-link" href="../wetter.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Wetter
                        </a>
                        <a class="nav-link" href="../statistik.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Statistik
                        </a>
                        <a class="nav-link" href="../history/history.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            History
                        </a>
                     
                  
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                     <?php echo $_SESSION['zeige'];  ?>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-1 offset-5 mb-3">Admin</h1>
                    <div class="card mb-4 border-dark">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Übersicht
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                            <form action="" method="post">
                                    <div class=" mb-2 col-auto offset-5">
                                        <a  href="../register/register.php" class=" btn btn-dark">Benutzer hinzufügen</a>
                                    </div>
                                    
                                    <table id="datatablesSimple">
                                        <thead>
                                            <th>Id</th>
                                            <th>Vorname</th>
                                            <th>Nachname</th>
                                            <th>Geburtsdatum</th>
                                            <th>Email</th>
                                            <th>Benutzername</th>
                                            <th>Passwort</th>
                                            <th colspan="2"></th>
                                        </thead>
                                        <tbody>


                                        <?php
                                        require("../database/dbConnect.php");
                                        if (isset($_POST['act1'])) {
                                            $userID = $_POST['user_id'];
                                            if ($userID != "cancel") 
                                                deleteUser($userID);
                                        }
                                        ?>


                                        <?php
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "propra";
                                        $row = '';

                                        // Create connection
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        // Check connection
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "SELECT * from user";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) { ?>
                                                <div class="tbl-content">
                                                    
                                                        <tr>
                                                            <td><?php echo $row['userID']; ?></td>
                                                            <td><?php echo $row['lastName']; ?></td>
                                                            <td><?php echo $row['firstName']; ?></td>
                                                            <td><?php echo $row['birthdate']; ?></td>
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td><?php echo $row['username']; ?></td>
                                                            <td><?php echo $row['password']; ?></td>
                                                            <td><input type="submit" name="act1" value="Löschen" onClick="deleteConfirm(1)" class="delete" /></td>
                                                            <td><input type="submit" name="act2" value="Bearbeiten" onClick="deleteConfirm(2)" class="delete" formaction="./editUser.php" /></td>
                                                        </tr>
                                                    
                                                </div>
                                            <?php } ?>
                                        <?php
                                        } else 
                                        {

                                        }
                                        $conn->close();
                                        ?>
                                        <input type="text" name="user_id" id="user_id" />
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Land Motor 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
        </div>
    </div>

    <script>
        function deleteConfirm(a) {
            let thetable = document.getElementById('datatablesSimple')
                .getElementsByTagName('tbody')[0];
            for (let i = 0; i < thetable.rows.length; i++) {
                thetable.rows[i].onclick = function() {
                    TableRowClick(this, a);
                }
            }
        }

        function TableRowClick(therow, y) {
            let msg = therow.cells[0].innerHTML;
            if (y == 1) {
                var r = confirm("Do you want to delete the user " + msg + "?");
                if (r != true) {
                    msg = "cancel";
                }
                document.getElementById('user_id').value = msg;
            } else {
               
                document.getElementById('user_id').value = msg;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.0.0/math.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>