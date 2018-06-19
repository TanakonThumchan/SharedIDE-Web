<?php
	session_start();
	if (isset($_SESSION["iduser"]))
	{		
		session_unset();
		session_destroy();
	}
?>
<html class="h-100">
	<head>
    <style>
    html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
  background-repeat: no-repeat;
  background-size: cover;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="username"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	</head>
	<body class="text-center h-100" background="./Immagine_index/SharedIDE.jpg">
    <div class="w-100 h-100 d-flex justify-content-center">
      <div class="align-items-center">
          <h1 class="display-1" ><font color="white">Shared<b>IDE</b></font></h1>
          <form class="form-signin" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Log In</h1>
            <label for="inputUser" class="sr-only">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <button class="btn btn-lg btn-secondary btn-block" type="button" name="signup" value="SIGN UP" onclick="location.href='./sharedIDEsignup.php';">Registrati</button>
          </form>	
          <?php
              if (isset($_POST['username'])){
                $username=$_POST['username'];
                $password=$_POST['password'];
                /*$url="http://thumchant.altervista.org/ProgettoEsame/UserSignIn.php?username=".$username."&password=".$password;
                $ch= curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch);
                $result = curl_exec($ch);
                curl_close($ch);*/
                $postdata = http_build_query(
                    array(
                        'username' => $username,
                        'password' => $password
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
                $result = file_get_contents("http://thumchant.altervista.org/ProgettoEsame/UserSignIn.php",false,$context);
                //var_dump ($result);            
                if ($result=="Autentucazione confermata"){
                    echo "si";
                    session_start();
                    $_SESSION["iduser"] = $username;
                    header("Location: ./sharedIDEpage.php");                  
                }
                else 
                {                  
                    //echo "<meta http-equiv='refresh' content='0'>";
                    echo "L'autenticazione è fallita";
                }
              }
          ?>
        </div>
      </div>
	</body>
</html>