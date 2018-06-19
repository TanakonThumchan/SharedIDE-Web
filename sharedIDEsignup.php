<html>
	<head>
    	<style>
        body {
          display: -ms-flexbox;
          -ms-flex-align: center;
          align-items: center;          
          
        }
          .form-signup {
          width: 100%;
          max-width: 330px;
          padding: 15px;
          margin: auto;
          }
    	</style>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	</head>
	<body style ="text-align: center">
      <form class="form-signup" method="post">
          <table>
          	  <tr>				
                  <th>Nome: </th>
                  <td><input type="text" name="name" required></td>
              </tr>
              <tr>				
                  <th>Cognome: </th>
                  <td><input type="text" name="surname" required></td>
              </tr>
              <tr>				
                  <th>Scegli Username: </th>
                  <td><input type="text" name="username" required></td>
              </tr>
              <tr>
                  <th>Scegli Password: </th>
                  <td><input type="password" name="password" required></td>
              </tr>
              <tr>
                  <th>Conferma Password: </th>
                  <td><input type="password" name="repassword" required></td>
              </tr>
          </table>
          <input class="btn btn-lg btn-primary btn-block" type="submit" name="signup" value="Registrati"> <input type="button" class="btn btn-lg btn-primary btn-block"name="home" value="HOME" onclick="location.href='./sharedIDE.php';">
      </form>
      <?php
      	if (isset($_POST['signup']))
		{
			$user=$_POST['username'];
			$pass=$_POST['password'];
			$repass=$_POST['repassword'];
            $name=$_POST['name'];
            $surname=$_POST['surname'];
			if ($pass==$repass)
			{
            	$postdata = http_build_query(
                  array(
                      'username' => $user,
                      'password' => $pass,
                      'name'=> $name,
                      'surname'=> $surname
                  )
              );

              $opts = array('http' =>
                  array(
                      'method'  => 'POST',
                      'header'  => 'Content-type: application/x-www-form-urlencoded',
                      'content' => $postdata
                  )
              );

              $context  = stream_context_create($opts);
              $result = file_get_contents("http://thumchant.altervista.org/ProgettoEsame/UserSignUp.php",false,$context);
				
                if($result=="Registrazione completata"){
                	echo "Registrazione completata";
                }
                else {
                	echo "Errore nella registrazione";
                }
			}
			else 
			{
				echo "Le password non corrispondono";
			}
		}
      ?>
    </body>
</html>