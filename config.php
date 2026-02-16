<?php
// Aapka port 3307 hai, isliye localhost ke saath port likhna zaroori hai
define('DBSERVER', 'localhost:3307'); 
define('DBUSERNAME', 'root'); 
define('DBPASSWORD', ''); // Agar aapne password set kiya hai toh yahan likhein
define('DBNAME', 'login_practice'); 

/* Database se connect karne ki koshish */
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

// Connection check karein
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Check karne ke liye uncomment karein:
// echo "Mubarak ho! Connection successfully ho gaya."; 
?>