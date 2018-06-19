<?php
	header("Access-Control-Allow-Origin:*");
	include_once './config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    if (isset($_POST['username'])){
      $username=$_POST['username'];
      $cerca=$_POST['cerca'];
      if (isset($_POST['mode'])){
      	$query="select * from Collaborazione join Partecipa on Collaborazione.id_collaborazione=Partecipa.id_collaborazione where username='$username' and Partecipa.ruolo=('admin' or 'editor')";
        $stmt = $db->prepare($query); 
        $stmt->execute();
      	$json = array();
      	while($row = $stmt->fetch() ){
         	$json[]= array(
						'nome' => $row["nomeFile"],
						'data' => $row["ultimoCaricamento"],
					);
        }
        echo json_encode($json);
      }
      else{
        if ($_POST['cerca']==""){
          $query="select * from Collaborazione join Partecipa on Collaborazione.id_collaborazione=Partecipa.id_collaborazione where username='$username'";
        }
        else{
          $query="select * from Collaborazione join Partecipa on Collaborazione.id_collaborazione=Partecipa.id_collaborazione where username='$username' and nomeFile like '%$cerca%' ";
        }
        $stmt = $db->prepare($query); 
        $stmt->execute();
        echo "<table class=\"table\"><thead class=\"thead-dark\">";
        echo "<tr><th scope=\"col\">Nome File</th><th scope=\"col\">Ultimo carimento</th><th scope=\"col\">Ruolo</th></tr></thead><tbody>";
        while($row = $stmt->fetch() ){  
            //echo var_dump($row);
            echo "<tr>";
            echo "<td><a href=\"http://thumchant.altervista.org/ProgettoEsame/File/".$row["nomeFile"]." \" target=\"_blank\"> ".$row["nomeFile"]."</a></td>";
            echo "<td> ".$row["ultimoCaricamento"]."</td>";
            echo "<td> ".$row["ruolo"]."</td>";
            echo "</tr>";
          } 
          echo "</tbody></table>";
        }        
    }
    
?>