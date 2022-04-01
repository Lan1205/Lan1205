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
<script>
     
     function setCookie(cname, cvalue, exdays) {
     const d = new Date();
     d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
     let expires = "expires="+d.toUTCString();
     document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
   }
   
   function getCookie(cname) {
     let name = cname + "=";
     let ca = document.cookie.split(';');
     for(let i = 0; i < ca.length; i++) {
       let c = ca[i];
       while (c.charAt(0) == ' ') {
         c = c.substring(1);
       }
       if (c.indexOf(name) == 0) {
         return c.substring(name.length, c.length);
       }
     }
     return "";
   }
   setCookie("daten",<?php echo $_GET['id'];?>, 10);
       
</script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="./styleDashboard.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">
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
                        <li><a class="dropdown-item" href="login/login1.php">Logout</a></li>
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
                            <a class="nav-link" href="prozess/prozess.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Prozess
                            </a>
                            <a class="nav-link" href="wetter.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Wetter
                            </a>
                            <a class="nav-link" href="statistik.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Statistik
                            </a>
                            <a class="nav-link" href="./history/history.php">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
