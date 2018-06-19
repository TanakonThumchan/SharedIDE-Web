<?php
	class User{
    	private $username="";
        private $password="";
        private $name="";
        private $surname="";
        public $conn;
        public function __construct($user,$pass,$db){
        	$this->username = $user;
            $this->password = $pass;
            $this->conn = $db;
    	}
    	public function login(){
        	$username=$this->username;
            $password=$this->password;
        	$query="SELECT * FROM Utenti where username='".$username."' AND pass='".$password."'";
            try{
              $stmt = $this->conn->prepare($query); 
              $stmt->execute();
              if ($stmt->rowCount()>0)
              {
              	return true;
              }
              else{
              	return false;
              }
            }
            catch(PDOException $e){
            	echo "Error: " . $e->getMessage();
            }
        }
        public function registra($name,$surname){
        	$username=$this->username;
            $password=$this->password;
           	$this->conn->beginTransaction();
            
        	try{
            	$stmt = $this->conn->prepare("SELECT * FROM Utenti where username='".$username."'");
                $stmt->execute();
                if ($stmt->rowCount()>0)
                {
                	$this->conn->rollBack();
                	return false;
                }
                else {
                  $this->conn->exec("insert into Utenti (username,pass,nome,cognome) values('".$username."','".$password."','".$name."','".$surname."')");
                  $this->conn->commit();
                  return true;
                }
            }
            catch(PDOException $e){
            	return false;
            }
        }
        
    }
?>