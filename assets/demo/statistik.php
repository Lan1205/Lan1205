<?php
    include_once './database.php';
    include_once './reifenset.php';

    $db = new Database();
    $conn = $db->getConnection();
    
    $reifenset = new Reifen($conn);

    $query = "SELECT * FROM reifenset ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $count = array(0,0,0,0,0,0);
    $temp = "";

    while($result = $stmt->fetch())
    {
         $reifen =  $reifenset->getReifZeich
        ($result['mischungID'], 
         $result['setNR'],
         $result['bearbeitungID_V'],
         $result['bearbeitungID_H'],
         $conn); 
        if(substr( $reifen ,0,1) == 1)
        {
            $count[0]=   $count[0] +1;
            
        }
        else if (substr( $reifen ,0,1)  == 2)
        {
            $count[1]=  $count[1] +1; 
        }
        else if (substr( $reifen ,0,1)  == 3)
        {
            $count[2]=  $count[2] +1; 
        }
        else if (substr( $reifen ,0,1)  == 4)
        {
            $count[3]=  $count[3] +1; 
        }
        else if (substr( $reifen ,0,1)  == 5)
        {
            $count[4]=  $count[4] +1; 
        }
        else
        {
            $count[5]=  $count[5] +1; 
        }
        echo json_encode ($reifen);
        echo "!";
        echo json_encode($result['bestellt_um']);
        echo "!";
        echo json_encode($result['bestellung_fertig']);
        echo "?";
    }
   echo "%";  
   echo $count[0];
   echo ","; 
   echo $count[1];
   echo ","; 
   echo $count[2];
   echo ","; 
   echo $count[3];
   echo ","; 
   echo $count[4];
   echo ","; 
   echo $count[5];
   echo "%";
?>