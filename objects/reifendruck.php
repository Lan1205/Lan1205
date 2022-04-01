<?php
class Reifendruck
{
    private $conn; 

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "propra";

        $db= new mysqli($servername, $username, $password, $dbname);
        if ($db->connect_error) 
        {
            $this->conn= null; 
            die("Connection failed: " . $db->connect_error);
        }
        else
        {
            $this->conn= $db; 
        }    
    }

    function checkFormulaInput()
    {
        if(empty($_POST['inp_x'])|| empty($_POST['inp_y'])|| empty($_POST['inp_z']) || empty($_POST['inp_t']) )
        {
            return false; 
        }
        else
        {
            return true; 
        }
    }

    function checkForFormula()
    {
        $formula = false;
        $query = "SELECT * FROM formel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt)
        {
            $row = $stmt->fetch();
            if (empty($row))
            {
                $formula = false;
            }
            else
            {
                $formula = true;
            }
        }
        return $formula;
    }

    function addNewFormulaInDB()
    {
        $query = "INSERT INTO formel SET
        formelID = '1',
        x = '".$_POST['inp_x']."', 
        y = '".$_POST['inp_y']."', 
        z = '".$_POST['inp_z']."', 
        t = '".$_POST['inp_t']."'
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    function updateFormulaInDB()
    {
        $query = "UPDATE formel SET
                    x = '".$_POST['inp_x']."', 
                    y = '".$_POST['inp_y']."', 
                    z = '".$_POST['inp_z']."', 
                    t = '".$_POST['inp_t']."'
                    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();           
    }   
    
    // ruft die Formel aus der Datenbank ab
    function getFormulaFromDB()
    {
        $query = "SELECT * FROM formel";
        $result=  $this->conn->query($query);
        $row =  $result->fetch_assoc(); 

        $dbX = $row['x'];
        $dbY = $row['y'];
        $dbZ = $row['z'];
        $dbT = $row['t'];

        return array($dbX,$dbY,$dbZ,$dbT);
    }

    // berechnet den angepassten Reifendruck
    function calcReifendruck($xKaltdruck, $xFelgentemperatur, $X, $Y, $Z, $T)
    {
        return $xKaltdruck * ($xFelgentemperatur + $X) / $Y + $Z * ($xFelgentemperatur - $T) / $Y;
    }

    // aktualisiert die Reifendrücke in der Datenbank
    function UpdateReifenDruck($vl,$vr,$hl,$hr,$sID)
    {
        $query = "UPDATE reifenset SET 
        druck_VL = '".$vl."', 
        druck_VR = '".$vr."', 
        druck_HL = '".$hl."', 
        druck_HR = '".$hr."'
        WHERE setID = '".$sID."'
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
    }

    function checkTemperaturInput()
    {
        if(empty($_POST['inp_tmp']))
        {
            return false; 
        }
        else
        {
            return true; 
        }
    }

    function checkReifendruckInput()
    {
        if(empty($_POST['inp_vl'])|| empty($_POST['inp_vr'])|| empty($_POST['inp_hl']) || empty($_POST['inp_hr']) )
        {
            return false; 
        }
        else
        {
            return true; 
        }
    }

    function checkReifenIDInput()
    {
        if(empty($_POST['ReifenID']))
        {
            return false; 
        }
        else
        {
            return true; 
        }
    }
}
?>