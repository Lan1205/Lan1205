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
        <script type="text/javascript" src="./prozess.js"></script>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
       <script>
        function countDownTimer(id,start,end)
        {
            if (typeof(id) != "string")
            {
                return;
            } 
            var date1 = new Date(start);
            var date2 = new Date(end);
            var diffTime = Math.abs(date2 - date1);
            var seconds = Math.ceil(diffTime / (1000 )); 
            
            if(localStorage.getItem("count_timer"+id))
            {
                var count_timer = localStorage.getItem("count_timer"+id);
            }
        
            else
            {
                var count_timer= seconds; 
                console.log("test");
            }

            minutes = parseInt(count_timer/60);
            seconds = parseInt(count_timer%60);
        
            if(seconds < 10)
            {
                seconds= "0"+ seconds ;
            }
            if(minutes < 10)
            {
                minutes= "0"+ minutes ;
            }

            document.getElementById(id).innerHTML =minutes+":"+seconds;


            if(count_timer <= 0 && count_timer != undefined)
            {
                localStorage.setItem("count_timer"+id,0);
            }
            else if (count_timer == undefined || count_timer > 0 ) 
            {
                count_timer = count_timer - 1 ;
                minutes = parseInt(count_timer/60);
                seconds = parseInt(count_timer%60);
                localStorage.setItem("count_timer"+id,count_timer);
            }
        }
        
        
        window.onload = function()
        {
            $(".timer").each(
                function()
                {
                    var id = $(this).attr("id");
                    var start = $(this).attr("dateStart");
                    var end = $(this).attr("dateEnd");
                
            
                    setInterval(function()
                    {
                    countDownTimer(id,start,end);
                    }, 1000);
                }
            );
        }
       </script>
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
                        <li><a class="dropdown-item" href="../Rennmanagement//rennmanagement.php">Rennmanagement</a></li>
                        <li><hr class="dropdown-divider" /></li>
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
            <div id="testme"></div>

                <main>
                    <?php
                   include_once '../objects/reifenset.php';
                   include_once '../objects/heizdecke.php';
                   include_once '../database.php';

                    // Create connection
                    $db = new Database();
                    $conn = $db->getConnection();
                    $reifenset = new Reifen($conn);
                    $heizdecke = new Heizdecke($conn);
                  ?>
                    <div class="container-fluid px-4">
                    <h1 class="mt-3"></h1>
                        <div class="row">

                            <div class="col">
                                <div class="card mb-2 border-dark">
                                    <div class="card-header">
                                        <i class="fas fa fa-plus me-1"></i>
                                         Reifenset bestellen
                                    </div>
                                    <form name="1" action="./logic.php" method="post">
                                       <div class="card-body">
                                       <div class="container">
                                            <div class="row mb-2">
                                                <div class="col-sm">
                                                    <label for="colFormLabelLg" class="col-auto col-form-label col-form-label-lg">Mischungen</label>
                                                </div> 
                                                <div class="col-sm">
                                                <select class="form-control form-control-lg" id="bestellung" name="bestellung">
                                                    <?php
                                                        $id = $_COOKIE["daten"];
                                                        $sql = "SELECT * FROM mischung WHERE rennID='$id' ORDER BY bezeichnung ASC";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch()) 
                                                        {
                                                            unset($id, $name);
                                                            $id = $row['mischungID'];
                                                            $name = $row['mischung']; 
                                                            echo '<option value="'.$id.'">'.$name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm">
                                                    <label for="colFormLabelLg" class="col-auto col-form-label col-form-label-lg">Vorderachse</label>
                                                </div>
                                                <div class="col-sm">
                                                <select   class="form-control form-control-lg" id="vorder" name="vorder">
                                                    <?php
                                                        $sql = "SELECT * FROM bearbeitung ORDER BY bearbeitungID ASC";
                                                        $result = $conn->query($sql);

                                                        while ($row = $result->fetch()) 
                                                        {
                                                            unset($id, $name);
                                                            $id = $row['bearbeitungID'];
                                                            $name = $row['bezeichnung']; 
                                                            echo '<option value="'.$id.'">'.$name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm">
                                                    <label for="colFormLabelLg" class="col-auto col-form-label col-form-label-lg">Hinterachse</label>
                                                </div>
                                                <div class="col-sm">
                                                <select class="form-control form-control-lg" id="hinter" name="hinter">
                                                    <?php
                                                        $sql = "SELECT * FROM bearbeitung ORDER BY bearbeitungID ASC";
                                                        $result = $conn->query($sql);

                                                        while ($row = $result->fetch()) 
                                                        {
                                                            unset($id, $name);
                                                            $id = $row['bearbeitungID'];
                                                            $name = $row['bezeichnung']; 
                                                            echo '<option value="'.$id.'">'.$name.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm">
                                                    <label for="colFormLabelLg" class="col-auto col-form-label col-form-label-lg">Lieferzeit (min)</label>
                                                </div>
                                                <div class="col-sm">
                                                    <input type="number" class="form-control form-control-lg" name="lieferzeit" id="lieferzeit" placeholder="Lieferzeit" required>
                                                </div>
                                            </div>
                                            <div class="row mb-2 ">
                                                <div class=" col  offset-md-4  ">
                                                   <input type="submit" value="Bestellen" name="best"  class="btn btn-outline-dark" onclick="kontingentMindern()" id="bestellen" class="btn btn-success">
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="card mb-4 border-dark">
                                    <div class="card-header">
                                      Kontingente
                                    </div>
                                       <div class="card-body">
                                       <div class="container">
                                     
                                        <select class="form-control form-control-lg mt-4 mb-3" id="hinter" name="hinter">
                                                    <?php
                                                         $id = $_COOKIE["daten"];
                                                         $sql = "SELECT mischung, kontingent FROM mischung WHERE rennID='$id' ORDER BY bezeichnung ASC";
                                                         $result = $conn->query($sql);
                                                        while ($row = $result->fetch()) 
                                                        {
                                                            unset($id, $name);
                                                            $mischung = $row['mischung']." ";
                                                            $kontingent = $row['kontingent']; 
                                                            echo '<option >'.$mischung.':  '.$kontingent.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                       </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card mb-3 border-dark">
                                    <div class="card-header">
                                        <i class="fas fa fa-plus me-1"></i>
                                         Reifenbearbeitung
                                    </div>
                                    <form name="2" action="./logic.php" method="post">
                                    <div class="card-body">
                                        <div class="container mb-0 ">
                                            <div class="row gy-2 ">
                                                <div class="col-auto  offset-md-1 ">
                                                   <label for="colFormLabelLg" class="col-auto col-form-label col-form-label-lg">Reifenbezeichnung :</label>
                                                   <input type="hidden" name="ReifenID" id="ReifenID" required>   
                                                </div>
                                                <div class="col-auto ">
                                                   <label for="colFormLabelLg" id="showReifBez" class="col-auto col-form-label col-form-label-lg"></label>
                                                </div>
                                            </div>
                                            <div class="row gy-2">
                                                <div class="col-6">
                                                    <input type="number" class="form-control"  name="inp_vl" id="vl" placeholder="Front Left" required >
                                                </div>
                                                <div class="col-6">
                                                <input type="number" class="form-control"  name="inp_vr" id="vr" placeholder=" Front right" required>
                                                </div>
                                                <div class="col-6">
                                                <input type="number" class="form-control"  name="inp_hl" id="hl" placeholder = " Back left" required>  
                                                </div>
                                                <div class="col-6">
                                                <input type="number" class="form-control" name="inp_hr" id="hr" placeholder = " Back right" required>
                                                </div>
                                            </div>
                                            <div class="row gy-2 mt-4 ">
                                                <div class="col-sm">
                                                <label for="colFormLabelLg" class="col-auto col-form-label col-form-label-lg">Reifen/Felgentemperatur</label>
                                                </div>
                                                <div class="col-sm">
                                                <input type="number" class="form-control" name="inp_tmp" id="inputEmail4" placeholder="Temperatur" required>
                                                </div>
                                                <div class="row mt-4 ">
                                                <div class=" col  offset-md-4  ">
                                                   <input type="submit" value="Reifendruck berechnen" name="reifendruck"  class="btn btn-outline-dark" id="rd" onclick="test()" >
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                       </div>
                                    </form>
                            </div>
                          
                            <div class="col mb-">
                              <div class="card border-dark">
                                <form name="3" action="./logic.php" method="post">
                                  <input type="hidden" name="ReifenID_2" id="ReifenID_2">   
                                    <div class="card-body ">
                                      <div class="row gy-2  ">
                                           <div class="col-auto ">
                                                <input type="number" name="temp" step="0.1" placeholder="Temperatur in °C">
                                            </div>
                                            <div class="col-auto">
                                                <input type="submit" class="btn btn-outline-primary" name="inHeizdecke" id="inHeizdecke" value="  Heizdecke     " onclick="test()">
                                            </div>
                                            <div class="col-auto">
                                               <input type="submit" name="montieren" id="fertig"   class="btn btn-outline-success" value="  montieren     " onclick="test()">
                                            </div>
                                            <div class="col-auto">
                                               <input type="submit"  class="btn btn-outline-danger" name="angekommen" id="istangekommen" value="angekommen " onclick="test()">
                                            </div>
                                            <div class="col-auto  ">
                                                <input type="submit" class="btn btn-outline-dark" name="verbraucht" id="istverbraucht" value="  verbraucht    " onclick="test()">
                                            </div>
                                            </form>
                                            <div class="col-auto  ">
                                                  <button id="btnStart" type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#formModal">Formel ändern</button>
                                            </div>
                                            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                       <div class="modal-header">
                                                               <div class="formeleingabe">
                                                                        <?php
                                                                                $query = "SELECT * FROM formel";
                                                                                $result = $conn->query($query);
                                                                                $valExists = false;

                                                                                if ($result) 
                                                                                {
                                                                                    while($row = $result->fetch())
                                                                                    {
                                                                                        ?>
                                                                                         <label name="MusterFormel">Muster: Kaltdruck*(Felgentemp+X)/Y+Z*(Felgentemp-T)/Y</label>
                                                                                        <label name="dbformel">=> Kaltdruck * (Felgentemp + <?php echo (int)$row['x'];?>) / <?php echo (int)$row['y'];?> + <?php echo (int)$row['z']; ?> * (Felgentemp - <?php echo (int)$row['t']; ?>) / <?php echo (int)$row['y']; ?></label><br>
                                                                                        <?php
                                                                                        $valExists = true;
                                                                                    }
                                                                                    if (!$valExists)
                                                                                    {
                                                                                        ?>
                                                                                        <label name="formelschema">Kaltdruck*(Felgentemp+X)/Y+Z*(Felgentemp-T)/Y</label>
                                                                                        <br>
                                                                                        <label name="formelinfo">Ohne Formel können die Reifendrücke nicht richtig berechnet werden!</label>
                                                                                        
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            ?>
                                                                </div>
                                                        </div>
                                                        <form id="formAwesome" action="./logic.php" method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group row mt-3 mb-2">
                                                                    <label for="firstName" class="col-sm-6 col-form-label">
                                                                       X Wert 
                                                                    </label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="inp_x"  class="form-control" id="x" placeholder="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-2">
                                                                    <label for="lastName" class="col-sm-6 col-form-label">
                                                                        Y Wert 
                                                                    </label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="inp_y"  class="form-control" id="lastName" placeholder="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-2">
                                                                    <label for="email" class="col-sm-6 col-form-label">
                                                                        Z Wert
                                                                    </label>
                                                                    <div class="col-sm-6">
                                                                         <input type="text" name="inp_z"  class="form-control" id="lastName" placeholder="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-2">
                                                                    <label for="awesomeness" class="col-sm-6 col-form-label">
                                                                        T Wert
                                                                    </label>
                                                                    <div class="col-sm-6 mb-2">
                                                                        <input type="text" name="inp_t"  class="form-control" id="lastName" placeholder="" required>
                                                                    </div>
                                                                </div>
                                                            
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"  class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="formel" id="fo" class="btn btn-outline-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                <form name="4" action="./logic.php" method="post">
                        <div class="card mb-4 border-dark" >
                            <div class="card-header">
                              <i class="fas fa-table me-1"></i>
                                Übersicht
                            </div>
                            <div class="card-body">
                            <div class="row">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                    <th></th>
                                    <th>setID</th>
                                    <th>Reifenbezeichnung</th>
                                    <th>Timer</th>
                                    <th>Reifendruck</th>
                                    <th>
                                        Temperatur<br>
                                        Heizdecke
                                    </th>
                                    <th>Status</th>
                                </tr>
                                    </thead>
                                    </div>
                                    <?php
                                    $result = $reifenset->alleAktivenReifensetsLaden();
                                    if ($result) 
                                    {
                                        while($row = $result->fetch())
                                        {
                                            ?>
                                            <div class="tbl-content">
                                               <tbody>
                                                 <tr>
                                                    <!-- Bearbeiten-Button -->
                                                    <td>
                                                        <?php 
                                                            $rsBez = $reifenset->getReifZeich($row['mischungID'], $row['setNR'], $row['bearbeitungID_V'], $row['bearbeitungID_H']);
                                                            echo "<button type='button' class='btn btn-outline-dark' name='editRS' value='Bearbeiten' onClick='editReifenset(".$row['setID'].", \"$rsBez\")' class='edit'>Bearbeiten</button>";
                                                        ?>
                                                    </td>
                                                       <!-- SetID -->
                                                       <td><?php echo $row['setID'];?></td>
                                                        <!-- Reifenbezeichnung -->
                                                        <td><?php echo $reifenset->getReifZeich($row['mischungID'], $row['setNR'], $row['bearbeitungID_V'], $row['bearbeitungID_H']);?></td>
                                                        <td class="timer" id="timer<?php echo $row['setID']; ?>" dateEnd ="<?php echo $row['bestellung_fertig']; ?>" dateStart ="<?php echo $row['bestellt_um']; ?>"> </td>
                                                        <!-- Reifendrücke -->
                                                        <td>
                                                            <table >
                                                                <tr>
                                                                    <td><?php echo $row['druck_VL'];?></td>
                                                                    <td><?php echo $row['druck_VR'];?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?php echo $row['druck_HL'];?></td>
                                                                    <td><?php echo $row['druck_HR'];?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <!-- Temperatur Heizdecke -->
                                                        <td><?php echo $row['hdTemp']; ?></td>
                                                         <!-- Status -->
                                                        <?php 
                                                            if ($row['montiert'] == 1)
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
