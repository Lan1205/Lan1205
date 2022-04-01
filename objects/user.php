<?php

class User{
 
    //für Database Connection
    private $conn;
    private $table_name = "user";
 
    // für Login
    public $username_login;  
    public $password; 

    //für Signup kommen auch dazu
    public $userID;
    public $lastName;
    public $firstName;
    public $position;
    public $birthdate; 
    public $phonenumber; 
    public $username;
 
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // login user
    function login()
    {
        // select all query
        $query = "SELECT position from ".$this->table_name." where username = '".$this->username_login."' and password = '".$this->password."'"; 
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute(); 

        return $stmt;
    }

    // die Funtion ist nur für den Manager zur verfügung
    function signup()
    {

        // query to insert record
        $query = "INSERT INTO
                 ".$this->table_name."
                 SET
                 lastname=: '".$this->lastName."',
                 firstname=: '".$this->firstname."',
                 birthdate=: '".$this->birthdate."',
                 phonenumber=: '".$this->phonenumber."',
                 position=: '".$this->position."',
                 email=: '".$this->Email."',
                 username=: '".$this->username."',
                 password=: '".$this->password."'"; 
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute())
        {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // die Funtion ist nur für den Manager zur verfügung
    function deleteUser($userID)
    {
         // query to delete
         $query = "DELETE FROM user WHERE userID='$userID'";

         // prepare query statement
         $stmt = $this->conn->prepare($query);
         
         // Sicherheitfrage 
         echo "<script type='text/javascript'>alert('möchten Sie wirklich diesen Benutzer löschen');</script>";
         //...muss weiter bearbeitet werden...

         // execute query
         $stmt->execute(); 
    }
}