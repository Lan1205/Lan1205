<?php
class Reifen{

  private $conn;
  private $table_name = "reifenset";
  

  // constructor with $db as database connection
  public function __construct($db)
  {
      $this->conn = $db;
  }
  
  // neues reifenset anlegen und speichern
  function neuesReifensetSpeichern($xSetNR, $xMischungID, $xBearbeitungID_V, $xBearbeitungID_H, $xBestellt_um, $xBestellung_fertig)
  {
    // query to insert reifenset
    $query = "INSERT INTO ".$this->table_name." SET 
            setNR='$xSetNR', 
            mischungID='$xMischungID',
            bearbeitungID_V='$xBearbeitungID_V',
            bearbeitungID_H='$xBearbeitungID_H',
            bestellt='1',
            angekommen='0',
            heizdecke='0',
            montiert='0',
            verbraucht='0',
            bestellt_um='".$xBestellt_um."',
            bestellung_fertig='$xBestellung_fertig',
            setAktiv='1'
            ";

    // prepare query
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return true;
  }

  // reifensets abrufen zur anzeige im prozess
  function alleAktivenReifensetsLaden()
  { 
    $id = $_COOKIE["daten"];
      // select all query
      $query = "SELECT * FROM $this->table_name INNER JOIN mischung ON reifenset.mischungID = mischung.mischungID WHERE rennID='$id' AND verbraucht='0' AND setAktiv='1' ORDER BY setID DESC ";
      // prepare query statement
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute(); 

      return $stmt;
  }

  // reifensets abrufen zur anzeige in der history
  function alleReifensetsLaden()
  {
      $id = $_COOKIE["daten"];
      // select all query
      $query = "SELECT * FROM $this->table_name INNER JOIN mischung ON reifenset.mischungID = mischung.mischungID WHERE rennID='$id' AND setAktiv='1' ORDER BY setID DESC ";
      // prepare query statement
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute(); 

      return $stmt;
  }

  function kontingentMindern($mischID)
  {
    $query = "SELECT kontingent FROM mischung WHERE mischungID='$mischID'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    while($result = $stmt->fetch())
    {
      $kontingent = json_encode($result['kontingent'], JSON_NUMERIC_CHECK );
    }
    $kontingent = $kontingent - 1;
    $query = "UPDATE mischung
    SET kontingent = '$kontingent'
    WHERE mischungID='$mischID'
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return true;
  }

  // Funktion zur Anzeige des Reifenzeichens
  function getReifZeich($mID, $set_NR, $bID_V, $bID_H)
  {
      //variables
      $misch_R; $misch_BV; $misch_BH; $setAnz;

      //SQL
      $sql_misch = "SELECT bezeichnung FROM mischung WHERE mischungID = '".$mID."'";
      $sql_bearb_V = "SELECT kurzform FROM bearbeitung WHERE bearbeitungID = '".$bID_V."'";
      $sql_bearb_H = "SELECT kurzform FROM bearbeitung WHERE bearbeitungID = '".$bID_H."'";
      
      //get results
      $result_misch = $this->conn->query($sql_misch);
      while ($row_misch = $result_misch->fetch()) 
      {
          $misch_R = $row_misch['bezeichnung'];
      }
      $result_bearb_V = $this->conn->query($sql_bearb_V);
      while ($row_bearb_V = $result_bearb_V->fetch()) 
      {
          $misch_BV = $row_bearb_V['kurzform'];
      }
      $result_bearb_H = $this->conn->query($sql_bearb_H);
      while ($row_bearb_H = $result_bearb_H->fetch()) 
      {
          $misch_BH = $row_bearb_H['kurzform'];
      }

      return $misch_R . str_pad($set_NR, 2, "0", STR_PAD_LEFT) . $misch_BV . "/" . $misch_BH;
  }

  //Funktion zur Anzeige der Heizdeckentemperatur
  function getHdTemp($mID, $con)
  {
    $hdTemp;
    $sql_temp = "SELECT hdTemp FROM reifenset WHERE setID = '".$mID."'";
    $result_temp = $con->query($sql_temp);
    while($row_temp = $result_temp->fetch())
    {
      $hdTemp = $row_temp['hdTemp'];
    }
    
    return $hdTemp;
  }

  //Funktion zur Berechnung der Set Nummer
  function getSetNR()
  {
    $setAnz;
    $sql_setAnz = "SELECT COUNT(*) AS setAnz FROM ".$this->table_name." WHERE setAktiv='1'";
    $result_setAnz = $this->conn->query($sql_setAnz);
    if ($result_setAnz)
    {
      while ($row_setAnz = $result_setAnz->fetch()) 
      {
        $setAnz = $row_setAnz['setAnz'];
      }
    }
    $setAnz++;

    return $setAnz;
  }

  //Funktion montieren
  function montieren($sID)
  {
    $query = "UPDATE ".$this->table_name." SET 
              bestellt='0',
              angekommen = '0',
              heizdecke='0',
              montiert='1',
              verbraucht='0'
              WHERE setID = '".$sID."'
              ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute(); 
  }

  //Funktion angekommen
  function angekommen($sID)
  {
    $query = "UPDATE ".$this->table_name." SET 
              bestellt='0',
              angekommen = '1',
              heizdecke='0',
              montiert='0',
              verbraucht='0'
              WHERE setID = '".$sID."'
              ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute(); 
  }

  //Funktion verbraucht
  function verbraucht($sID)
  {
    $query = "UPDATE ".$this->table_name." SET 
              bestellt='0',
              angekommen='0',
              heizdecke='0',
              montiert='0',
              verbraucht = '1'
              WHERE setID = '".$sID."'
              ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute(); 
  }
}
