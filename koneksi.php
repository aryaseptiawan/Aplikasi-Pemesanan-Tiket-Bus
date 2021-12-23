<?php
// konfigurasi database
session_start();
$host       =   "localhost";
$user       =   "root";
$password   =   "";
$database   =   "umn-bus";
// perintah php untuk akses ke database
$koneksi = mysqli_connect($host, $user, $password, $database);
?>
