<?php 
	session_start();
	if (!isset($_SESSION["iduser"]))
	{
		header("Location: ./sharedIDE.php");
		die();
	}	    
?> 
<html>
  <head>
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body onload="search()">
  	Cerca: <input type="text" id="cerca" onkeyup="search()">
    <button type="button" class="btn btn-danger" onclick="location.href='./sharedIDE.php';">Logout</button>
    <script>
    	function search(){
        	var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {              
                document.getElementById("elenco").innerHTML =
                this.responseText;
              }
            };
            var param="username=<?php echo $_SESSION["iduser"] ?>"+"& cerca="+document.getElementById("cerca").value;
            xhttp.open("POST", "http://thumchant.altervista.org/ProgettoEsame/UserGetFileList.php", true);
            xhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xhttp.send(param);
        }
    </script>
    <div id="elenco">
    </div>
  </body>
</html>