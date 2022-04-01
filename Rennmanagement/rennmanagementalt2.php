<?php
    session_start();

    if (isset($_SESSION['position'])) {
        $pos = $_SESSION['position'];
    }
    else
     {
        $pos = "Error!";
    }
    
    if(isset($_SESSION['position']) && $_SESSION['position'] == 1)
    {
        $_SESSION['zeige']= "Ingenieur"; 
    }
    else if(isset($_SESSION['position']) && $_SESSION['position'] == 2)
    {
        echo "Manager";
    }
    else if(isset($_SESSION['position']) && $_SESSION['position'] == 3)
    {
        echo "mitarbeiter";
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Land Motor</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../prozess/prozess.php">
                <img class=" preload-me" src="../landmotor.png"  width="180" height="45" sizes="150px" >
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
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../login/login.html">Logout</a></li>
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
                            <a class="nav-link" href="../prozess/prozess.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="../statistik.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Statistik
                            </a>
                            <a class="nav-link" href="../history/history.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                History
                            </a>
                            <a class="nav-link" href="../Wetter.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Wetter
                            </a>
                            <a class="nav-link" href="../prozess/prozess.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Prozess
                            </a>
                            <a class="nav-link" href="rennmanagement.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Rennen
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                         Ingenieur
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                        <div class="container-fluid px-4">
                          <h1 class="mt-4 offset-4">Rennenmanagment</h1>
                                <div class="card mb-4 border-dark">
                                    <div class="card-header">
                                        <i  class="fa fa-plus" aria-hidden="true"></i>
                                        Input  Daten  
                                    </div>
                                    <form action="rennlogik.php" method="post">
                                         <?php
                                            include_once '../database/database.php';
                                            include_once '../objects/rennen.php';

                                            $db = new Database();
                                            $conn = $db->getConnection();

                                            $rennen = new Rennen($conn);
                                          ?>
                                        <div class="card-body ">
                                            <div class="container mb-3">  
                                            <form action="" method="post">
                                                <div class="row gy-2 mt-1">
                                                    <div class=" col-auto ">
                                                        <input type="text" id="standort" name="standort" placeholder="Standort" required>
                                                    </div>
                                                    <div class=" col-auto ">
                                                        <input type="date" name="renndatum" id="renndatum" value="" required>
                                                    </div>
                                                    <div class=" col-auto mt-1">
                                                        <button type="submit"  name="erstellen"   id="add"  class="btn btn-dark" >Rennen erstellen</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div> 
                        <form action="" method="post">
                            <div class="container-fluid px-4">
                                <div class="card mb-4 border-dark" >
                                            <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            </div>
                                            <div class="card-body">
                                            <div class="row">
                                            <div class="card-body">
                                            <table id="datatablesSimple">
                                                    <thead>
                                                    <tr>
                                                        <td>Standort</td>
                                                        <td>Datum</td>
                                                        <td></td>
                                                        <td></td>    
                                                    </tr>
                                                </thead>
                                                    </div>
                                                    <?php
                                                include_once '../database/database.php';

                                                $db = new Database();
                                                $conn = $db->getConnection();
                                                $query = "SELECT * FROM rennen";
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute();
                                                while($result = $stmt->fetch())
                                                {
                                                            ?>
                                                            <div class="tbl-content ">
                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo $result['standort'];?></td>
                                                                    <td><?php echo $result['datum'];?></td>
                                                                    <td><a  class="btn btn-dark"   href="edit.php?id=<?php echo $result['rennID']; ?>">Edit</a></td>
                                                                    <td><a  class="btn btn-dark" href="delete.php?id=<?php echo $result['rennID']; ?>">Delete</a></td>
                                                              
                                                                </tr>
                                                    	 </tbody>
                                                    </div>
                                                    <?php
                                                    }

                                                    ?>
                                                    </table>
                                                    </div>
                                                                                
                                                </div>
                                                </div>
                                                </div>
                                </div>
                            </div>
                        </form>
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    </body>
</html>



<form  action="" method="post">
                    <div class="container-fluid px-4">
                        <div class="card mb-4 border-dark" >
                            <div class="card-header">
                              <i class="fas fa-table me-1"></i>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                 <tr>
                                                        <td>Standort</td>
                                                        <td>Datum</td>
                                                        <td></td>
                                                        <td></td>       
                                                </tr>
                                            </thead>
                                            <?php
                                              include_once '../database/database.php';

                                              $db = new Database();
                                              $conn = $db->getConnection();
                                              $query = "SELECT * FROM rennen";
                                              $stmt = $conn->prepare($query);
                                              $stmt->execute();
                                                while($result = $stmt->fetch())
                                                {
                                                    ?>
                                                    <div class="tbl-content">
                                                     <tbody>
                                                         <tr>
                                                            <td><?php echo $result['standort'];?></td>
                                                            <td><?php echo $result['datum'];?></td>
                                                            <td><a  class="btn btn-dark"   href="edit.php?id=<?php echo $result['rennID']; ?>">Edit</a></td>
                                                            <td><a  class="btn btn-dark" href="delete.php?id=<?php echo $result['rennID']; ?>">Delete</a></td>
                                                          </tr>
                                                     </tbody>
                                                    </div>
                                                <?php
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>