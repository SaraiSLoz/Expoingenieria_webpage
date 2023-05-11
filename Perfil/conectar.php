<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'TC2005B_403_3';
$DATABASE_PASS = '5a?25+e?re*AtraR';
$DATABASE_NAME = 'TC2005B_403_3';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error()); //comprobar la conexión MySQL
}
