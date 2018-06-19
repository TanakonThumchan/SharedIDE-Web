<?php
	include_once './config/database.php';
    include_once './Object/User.php';
    $database = new Database();
    $db = $database -> getConnection();
    $username=$_POST['username'];
    $password=$_POST['password'];
    $nome=$_POST['name'];
    $cognome=$_POST['surname'];
    $user= new User($username,$password,$db);
    if($user->registra($nome,$cognome)){
    	echo "Registrazione completata";
    }
    else{
    	echo "Errore nella registrazione";
    }
?>