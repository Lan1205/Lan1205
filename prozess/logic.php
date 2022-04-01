<?php
    include_once '../objects/reifenset.php';
    include_once '../objects/reifendruck.php'; 
    include_once '../objects/heizdecke.php'; 
    include_once '../database.php';

    // Create connection
    $db = new Database();
    $conn = $db->getConnection();

    $reifenSet = new Reifen($conn);
    $heizdecke= new Heizdecke($conn);
    $reifendruck= new Reifendruck($conn);

    //Bestellen Button
    if(isset($_POST['best']))
    { 
        $setNR = $reifenSet->getSetNR();

        $lieferdauer = (string)$_POST['lieferzeit'];
        $mischung = $_POST['bestellung'];
        $bearb_V = $_POST['vorder'];
        $bearb_H = $_POST['hinter'];
        $now = date("Y-m-d H:i:s");
        $lieferzeit = date("Y-m-d H:i:s", strtotime($now . "+".$lieferdauer." minutes"));

        if(empty($lieferzeit))
        {
            echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>";  
        }
        else
        {
            $saved=$reifenSet->neuesReifensetSpeichern($setNR, $mischung, $bearb_V, $bearb_H, $now, $lieferzeit);
            $saved=$reifenSet->kontingentMindern($mischung);
            echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>";
        }
    }
    //Formel speichern Button
    else if(isset($_POST['formel']))
    {
        if($reifendruck->checkFormulaInput())
        {
            if ($reifendruck->checkForFormula())
            {
                $reifendruck->updateFormulaInDB(); 
                echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>";  
            }
            else
            {
                $reifendruck->addNewFormulaInDB(); 
                echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>";  
            }
        }
        else
        {
            echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>";  
        }
    }
    //Reifendrücke speichern Button
    else if(isset($_POST['reifendruck']))
    {
        if ($reifendruck->checkForFormula())
        {
            if($reifendruck->checkTemperaturInput())
            {
              if($reifendruck->checkReifenIDInput())
              {
                if($reifendruck->checkReifendruckInput())
                {
                    $formulaList= $reifendruck->getFormulaFromDB(); 

                    $dbX = $formulaList[0]; 
                    $dbY = $formulaList[1]; 
                    $dbZ = $formulaList[2]; 
                    $dbT = $formulaList[3];

                    $temp= $_POST['inp_tmp']; 
                    $setID=$_POST['ReifenID']; 

                    $vl = $reifendruck->calcReifendruck($_POST['inp_vl'],  $temp, $dbX, $dbY, $dbZ, $dbT);
                    $vr = $reifendruck->calcReifendruck($_POST['inp_vr'],  $temp, $dbX, $dbY, $dbZ, $dbT);
                    $hl = $reifendruck->calcReifendruck($_POST['inp_hl'],  $temp, $dbX, $dbY, $dbZ, $dbT);
                    $hr = $reifendruck->calcReifendruck($_POST['inp_hr'],  $temp, $dbX, $dbY, $dbZ, $dbT);  
    

                    $reifendruck->UpdateReifenDruck($vl, $vr, $hl, $hr, $setID);

                    echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
                }
                else
                {
                    echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
                } 

              }
              else
              {
                echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
              }
            }
            else
            {
                echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('Error: no Formula was found');</script>";
            echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>";  
        } 
    }
    //In die Heizdecke Button
    else if(isset($_POST['inHeizdecke']))
    {
        $setID=$_POST['ReifenID_2']; 
        $hdTemp=$_POST['temp'];

        if(!empty($setID))
        {
           $heizdecke->HeizdeckeSpeichern($setID, $hdTemp); 
           echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
        }
        else
        {  
           session_start();
          # echo $_SESSION["form_1"]; 
           #echo "<script type='text/javascript'>alert('Reifen ID ist leer');</script>";
           echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
        }
    }
    //Montiert Button
    else if (isset($_POST['montieren']))
    {
        $setID = $_POST['ReifenID_2'];

        if(!empty($setID))
        {
           $reifenSet->montieren($setID); 
           //echo "<script type='text/javascript'>alert('Reifendruck is successfully updated');</script>";
           echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
        }
        else
        {  
           echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
        }
    }
    //Angekommen/in der Box Button
    else if (isset($_POST['angekommen']))
    {
        $setID = $_POST['ReifenID_2'];

        if(!empty($setID))
        {
           $reifenSet->angekommen($setID); 
           //echo "<script type='text/javascript'>alert('Reifendruck is successfully updated');</script>";
           echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
        }
        else
        {  
           echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
        }        
    }
    //Verbraucht Button
    else if (isset($_POST['verbraucht']))
    {
        $setID = $_POST['ReifenID_2'];

        if(!empty($setID))
        {
           $reifenSet->verbraucht($setID); 
           //echo "<script type='text/javascript'>alert('Reifendruck is successfully updated');</script>";
           echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
        }
        else
        {  
           echo"<meta http-equiv='refresh' content='0;url=./prozess.php'>"; 
        }        
    }
    else if (isset($_POST['editRS']))
    {
    }
?> 
