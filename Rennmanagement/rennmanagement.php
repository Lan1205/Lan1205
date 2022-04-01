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
        <meta name="author" content="" />
        <title>Land Motor</title>
        <link href="../styleDashboard.css" rel="stylesheet" />
        <script type="text/javascript" src="./prozess.js"></script>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
      
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../prozess//prozess.php">
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
                        <li><a class="dropdown-item" href="../login/login.html">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                         
                    <div class="container-fluid px-4">
                        <ol class="breadcrumb mb-4">
                        </ol>
                        <div class="car">
                            <div class="body">
                                <div class="mirror-wrap">
                                    <div class="mirror-inner">
                                        <div class="mirror">
                                            <div class="shine"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="middle">
                                    <div class="top">
                                        <div class="line"></div>
                                    </div>
                                    <div class="bottom">
                                        <div class="lights">
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bumper">
                                    <div class="top"></div>
                                    <div class="middle" data-numb="&#2348;&#2366; &#2415;&#2411; &#2330; &#2415;&#2411;&#2415;&#2411;"></div>
                                    <div class="bottom"></div>
                                </div>
                            </div>
                            <div class="tyres">
                                <div class="tyre back"></div>
                                <div class="tyre front"></div>
                            </div>
                        </div>
                        <div class="road-wrap ">
                            <div class="road ">
                                <div class="lane-wrap ">
                                    <div class="lane">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       
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
                        <h1 class="mt-4"></h1>
                        <div class="card mb-4 border-dark">
                                    <div class="card-header">
                                        <i  class="fa fa-plus" aria-hidden="true"></i>
                                        Rennen anlegen
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

                    <form action="" method="post">
                        <div class="col mt-3">
                                    <div class="card mb-4 border-dark">
                                        <div class="card-header">
                                            <i class="fas fa-chart-area me-1"></i>
                                            Übersicht
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
                                                                        <td><a  class="btn btn-outline-dark"   href="edit.php?id=<?php echo $result['rennID']; ?>">Bearbeiten</a></td>
                                                                        <td><a  class="btn btn-outline-dark"   href="delete.php?id=<?php echo $result['rennID']; ?>">Löschen</a></td>
                                                                        <td><a class="btn btn-outline-danger"  href="../index.php?id=<?php echo $result['rennID']; ?>">zu Prozess</a></td>
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

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
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
