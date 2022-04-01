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
$second = 60;
header("Refresh:$second");
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
        <script type="text/javascript" src="./prozess.js"></script>
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="./history.js"></script>
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
                        <li><a class="dropdown-item" href="../Rennmanagement/rennmanagement.php">Rennmanagement</a></li>

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
                            <a class="nav-link" href="history.php">
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
                    <?php
                   include_once '../objects/reifenset.php';
                   include_once '../database.php';

                    // Create connection
                    $db = new Database();
                    $conn = $db->getConnection();

                    $reifenset = new Reifen($conn);

                  ?>
                
                <div class="container-fluid px-4">
                    <h1 class="mt-1 offset-5 mb-3">History</h1>

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
                                      <th>Reifzeich</th>
                                      <th>Bestellt</th>
                                      <th>Fertig</th>
                                      <th>Reifendruck</th>
                                      <th>Heizdeckentemperatur</th>
                                      <th>Status</th>
                                    </tr>
                                    </thead>
                                    </div>
                                    <?php
                                    $result = $reifenset->alleReifensetsLaden();
                                    if ($result) 
                                    {
                                        while($row = $result->fetch())
                                        {
                                            ?>
                                            <div class="tbl-content">
                                               <tbody>
                                                 <tr>
                                                      <td><?php echo $reifenset->getReifZeich($row['mischungID'], $row['setNR'], $row['bearbeitungID_V'], $row['bearbeitungID_H'], $conn);?></td>
                                                      <td><?php echo $row['bestellt_um']; ?></td>
                                                      <td><?php echo $row['bestellung_fertig']; ?></td>
                                                      <td>
                                                          <table >
                                                          <tr  >
                                                              <td><?php echo $row['druck_VL']; ?></td>
                                                              <td ><?php echo $row['druck_VR']; ?></td>
                                                          </tr>
                                                          <tr>
                                                              <td><?php echo $row['druck_VL']; ?></td>
                                                              <td><?php echo $row['druck_HR']; ?></td>
                                                          </tr>
                                                          </table>
                                                      </td>
                                                      <td><?php echo $reifenset->getHdTemp($row['setID'], $conn)?></td>
                                                      <!-- Status -->
                                                      <?php 
                                                          if ($row['verbraucht'] == 1)
                                                          {
                                                            echo '<td  class="table-secondary" bgcolor="red">verbraucht</td>';
                                                          }
                                                          else if ($row['montiert'] == 1)
                                                          {
                                                            echo '<td class="table-success">montiert</td>';
                                                          }
                                                          else if ($row['heizdecke'] == 1)
                                                          {
                                                            echo '<td class="table-primary">in Heizdecke</td>';
                                                          }
                                                          else if ($row['angekommen'] == 1)
                                                          {
                                                            echo '<td class="table-danger">angekommen</td>';
                                                          }
                                                          else if ($row['bestellt'] == 1)
                                                          {
                                                            echo '<td bgcolor="lightblue">bestellt</td>';
                                                          }
                                                      ?>
                                                 </tr>
                                    </tbody>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {}
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
