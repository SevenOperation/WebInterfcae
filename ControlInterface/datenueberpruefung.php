<?php
session_name('WATGSESSID');
session_start();

$daten;

if (isset($_POST['username']) && !checklogIn()){
  if(isset($_POST['lastSide'])){
  header('Location: ' . $_POST['lastSide']);
  }else{
  header('Location: /index');
  }
}
  

//Gets all data from every user for checking credentials
function getUserData(){
global $daten;
session_name('WATGSESSID');
session_start();
$db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
//var_dump($db->errorInfo());
$db->query('Set names utf8');
$daten = $db->query('Select username , password from user ');
}


//Checks the login request
function checklogIn(){
getUserData();
global $daten;
if (isset($daten) && isset($_POST["username"]) && isset($_POST["password"])) {
    foreach ($daten as $user) {
        if ($user["username"] == $_POST["username"] && $user["password"] == $_POST['password']) {
         setLoggedIn($user["username"] , $user["password"], true); 
         return true;
        }
    }
}
return false;
}

//Set the cookies and Session if he was authenticated successfully
function setLoggedIn($username , $password, $logedIn){
  $_SESSION['angemeldet' . $username ] = true;
  setcookie('benutzerdaten', $username . "-" . $password, 0 , "/" );
   if(isset($_POST['lastSide'])){
  header('Location: ' . $_POST['lastSide']);
  }else{
  header('Location: /index');
  }
}


//Checks if he is already logged in don't try to exploit by just setting wrong data
function checkLoggedIn(){
global $daten;
 if(isset($_COOKIE['benutzerdaten'])){
        getUserData();
 	$username = explode("-", $_COOKIE['benutzerdaten'])[0];
	$password = explode("-", $_COOKIE['benutzerdaten'])[1];
 foreach ($daten as $user){
   if($user["username"] == $username && $user['password'] == $password){
   return true;
 }
}
}
return false;
}

function getPermission(){
        $username = explode("-", $_COOKIE['benutzerdaten'])[0];
        $password = explode("-", $_COOKIE['benutzerdaten'])[1];
 	$db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
	$db->query('Set names utf8');
	$daten = $db->query("Select permission from user where username = '$username' and password = '$password'" );
        foreach ($daten as $permission){
	return $permission['permission'];
	}
}


?>
