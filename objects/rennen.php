<?php
class Rennen{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    function rennenSpeichern($xstandort, $xdatum){
    $query = "INSERT INTO rennen SET
        rennID = '0',
        standort = '$xstandort',
        datum = '$xdatum'
        ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return true;
    }
    function mischungSpeichern($xrennID, $xmischung, $xbezeichnung, $xkontingent){
    $query = "INSERT INTO mischung SET
        rennID = '$xrennID',
        mischung = '$xmischung',
        bezeichnung = '$xbezeichnung',
        kontingent = '$xkontingent'
        ";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return true;
    }   
}
?>
