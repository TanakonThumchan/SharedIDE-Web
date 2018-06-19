<?php
	include_once './config/database.php';
    $database = new Database();
    $db = $database -> getConnection();
    if (isset($_POST['username'])){
    	$user=$_POST['username'];
        $userToAdd=$_POST['userAdd'];
        $fileName=$_POST['fileName'];
        echo $user."<br>".$userToAdd."<br>".$fileName."<br>";
        $query="select * from Partecipa where username='".$user."' and ruolo='admin' and id_collaborazione=(select id_collaborazione from Collaborazione where nomeFile='".$fileName."')";
      	$stmt = $db->prepare($query); 
      	$stmt->execute();
        echo $stmt->rowCount();
        if ($stmt->rowCount()>0){
        	$query="select * from Partecipa where username='".$userToAdd."' and id_collaborazione=(select id_collaborazione from Collaborazione where nomeFile='".$fileName."')";
        	$stmt = $db->prepare($query); 
      		$stmt->execute();            
            echo $query;
            echo $stmt->rowCount();
            if ($stmt->rowCount()<=0){
                $query="insert into Partecipa (ruolo,username,id_collaborazione) values('contributor','".$userToAdd."',(select id_collaborazione from Collaborazione where nomeFile='".$fileName."'))";
                $stmt = $db->prepare($query); 
                $stmt->execute();
                echo "fatto";
            }
            else  {
             echo "no1";
            }
        }
        else{
        echo "no";
        }
    }
?>