<?php
$host = "localhost";
$uname = "root";
$pass = "";
$db = "politeknik";

$koneksi = new mysqli($host, $uname, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>
