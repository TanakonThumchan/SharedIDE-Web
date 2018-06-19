<?php
	include_once './config/database.php';
    $database = new Database();
    $db = $database -> getConnection();
    if (isset($_POST['username'])){
    	$user=$_POST['username'];
        $userToChange=$_POST['userChange'];
        $fileName=$_POST['fileName'];
        $query="select * from Partecipa where username='".$user."' and ruolo='admin' and id_collaborazione=(select id_collaborazione from Collaborazione where nomeFile='".$fileName."')";
      	$stmt = $db->prepare($query); 
      	$stmt->execute();
        if ($stmt->rowCount()>0){
        	
        }
?>