<?php
define('DBSERVER', 'localhost:3307'); 
define('DBUSERNAME', 'root'); 
define('DBPASSWORD', '');  
define('DBNAME', 'login_practice'); 

 $db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

 if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 // echo "Mubarak ho! Connection successfully ho gaya."; 
?>