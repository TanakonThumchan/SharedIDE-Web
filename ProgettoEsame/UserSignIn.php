<?php
	include_once './config/database.php';
    include_once './Object/User.php';
    $database = new Database();
    $db = $database -> getConnection();
    //$data = json_decode(file_get_contents("php://input"));
    $username=$_POST['username'];
    $password=$_POST['password'];
    //$user= new User($data->username,$data->password,$db);
    $user= new User($username,$password,$db);
    if($user->login()){
    	echo "Autentucazione confermata";
        //return "Autentucazione confermata";
    }
    else{
    	echo "Errore nell'autenticazione";
        //return "Autentucazione confermata";
    }
?>