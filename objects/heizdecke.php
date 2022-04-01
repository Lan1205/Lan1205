<?php
class Heizdecke 
{
    private $conn; 
    //private $table_name = "mischung";

    public function __construct($db)
    {
        $this->conn= $db;
    }

    //Speichern, wenn das Reifenset in der Heizdecke ist
    function HeizdeckeSpeichern($sID, $hdTemp)
    {
        $query = "UPDATE reifenset SET 
                heizdecke = '1',
                hdTemp = '".$hdTemp."'
                WHERE setID = '".$sID."'
                ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(); 
    }

    //Heizdeckentemperatur abrufen
    function getTemperatur($mischID)
    {
        $hdtemp;
        $query = "SELECT heizdeckentemp FROM mischung 
                WHERE mischungID = '".$mischID."'
                ";

        $stmt = $this->conn->query($query);
        while ($row_hdtemp = $stmt->fetch()) 
        {
            $hdtemp = $row_hdtemp['heizdeckentemp'];
        }
        return $hdtemp;
    }
}

?>