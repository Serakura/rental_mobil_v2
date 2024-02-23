<?php
require '../../database/db.php';
$tanggal = $_POST['tanggal'];
$id_vehicle = $_POST['id_vehicle'];

$cek = mysqli_query($conn, "SELECT * FROM `rents` WHERE id_vehicle='$id_vehicle' AND rent_date <= '$tanggal' AND return_date >= '$tanggal'");

if (mysqli_num_rows($cek) == 0) {
    echo "<script>
                    window.location='../index.php?page=rent&funct=check success&msg=Wow this vehicle is available&id_vehicle=$id_vehicle&date=$tanggal';
                </script>";
} else {
    echo "<script>
                    window.location='../index.php?page=rent&funct=check failed&msg=Vehicle not available!';
                </script>";
}
