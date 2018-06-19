<?php
	include_once './config/database.php';
    $database = new Database();
    $db = $database -> getConnection();
    if (isset($_POST['username'])){
    	$user=$_POST['username'];
        $fileName=$_POST['filename'];
        $ultimaModifica=$_POST['lastChange'];
        $query="select nomeFile from Collaborazione where nomeFile='".$fileName."'";
        $stmt = $db->prepare($query); 
      	$stmt->execute();
        if ($stmt->rowCount()>0){
        	$query="select * from Partecipa where username='".$user."' and ruolo='admin' and id_collaborazione=(select id_collaborazione from Collaborazione where nomeFile='".$fileName."')";
            $stmt = $db->prepare($query); 
      		$stmt->execute();
            if ($stmt->rowCount()>0){
              $query="update Collaborazione set ultimaModifica='".$ultimaModifica."' where nomeFile='".$fileName."'";
              $stmt = $db->prepare($query); 
              $stmt->execute();
              echo "updated";
            }
            else{
            	echo "NO";
            }
        }
        else{
        	$query="insert into Collaborazione (nomeFile,ultimaModifica) values('".$fileName."','".$ultimaModifica."')";
            $stmt = $db->prepare($query); 
      		$stmt->execute();
            $query="insert into Partecipa (ruolo,username,id_collaborazione) values('admin','".$user."',(select id_collaborazione from Collaborazione where nomeFile='".$fileName."'))";
        	$stmt = $db->prepare($query); 
      		$stmt->execute();
            echo "created new file";
        }
    }
?>