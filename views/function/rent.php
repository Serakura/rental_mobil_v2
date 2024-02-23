<?php
require '../../database/db.php';

$id_vehicle       = $_POST['id_vehicle'];
$id_user        = $_POST['id_user'];
$rent_date   = $_POST['rent_date'];
$return_date = $_POST['return_date'];
$amount          = $_POST['amount'];

$datediff = strtotime($return_date) - strtotime($rent_date);
$total_date = round($datediff / (60 * 60 * 24));



$total = $amount * $total_date;

$status     = "Unpaid";




$query = mysqli_query($conn, "INSERT INTO rents 
                (id_vehicle,id_user,rent_date,return_date,total_date,amount,status)
                VALUES 
                ('$id_vehicle','$id_user','$rent_date','$return_date','$total_date','$total','$status')");
if ($query) {
    echo "<script>
                    window.location='../index.php?page=history&funct=booking success&msg=Booking is success, please pay the bill';
                </script>";
} else {
    echo "<script>
                    window.location='../index.php?page=history&funct=booking failed&msg=Booking is failed!';
                </script>";
}
