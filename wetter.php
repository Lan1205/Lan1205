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
<?php  
$second = 30;
header("Refresh:$second");
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
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="./prozess/prozess.php">
                <img class=" preload-me" src="./landmotor.png"  width="180" height="45" sizes="150px" >
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
                        <li><a class="dropdown-item" href="./admin/admin.php">Admin</a></li>
                        <li><a class="dropdown-item" href="/Rennmanagement/rennmanagement.php">Rennmanagement</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login/login.html">Logout</a></li>
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
                            <a class="nav-link" href="./prozess/prozess.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Prozess
                            </a>
                            <a class="nav-link" href="Wetter.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Wetter
                            </a>
                           
                            <a class="nav-link" href="statistik.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Statistik
                            </a>
                            <a class="nav-link" href="./history/history.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
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
                        <h1 class="mt-4 offset-4">Wetter Statistiken</h1>

                          <div class="card mb-4 border-dark">
                            <div class="card-header">
                                <i  class="fa fa-plus" aria-hidden="true"></i>
                                 Wetterdaten eingeben
                            </div>
                            <div class="card-body ">
                                <div class="container mb-3">  
                                 <form action="" method="post" id="wetterForm" onsubmit="return submitWetterForm()">
                                    <div class="row gy-2 mt-1">
                                        <div class=" col-auto ">
                                            <input type="number" id="luft" name="luft" placeholder="Luft" required>
                                        </div>
                                        <div class=" col-auto ">
                                            <input type="number" id="strecke" name="strecke" placeholder="Strecke" required>
                                        </div>
                                        <div class="col-auto">
                                            <input type="text" id="verhaeltnis" name="verhaeltnis" placeholder="Verhältnisse" required><br>
                                        </div>
                                        <div class=" col-auto ">
                                            <button type="submit"  form="wetterForm" id="add"  name="addweather"  onclick="addWetter();startTimer()" class="btn btn-dark">Wetter Daten hinzufügen</button>
                                        </div>
                                    </div>
                                 </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid px-4">
                        <div  class="card mb-4 border-dark">
                            <div class="card-header">
                                <i class="fas fa-chart-area"></i>
                                Wetter Verlauf
                            </div>
                            <div class="card-body">
                                  <div class="row my-2">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                               <div style="margin: 20px 15px; height:300px;">
                                                <canvas id="myChart" height="100"></canvas>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Land Motor 2022</div>
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
        <script src="js/scripts.js"></script>
        <script src="js/wetter.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    </body>
</html>
