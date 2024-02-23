<?php
require '../../database/db.php';

$star       = $_POST['star'];
$id_rents        = $_POST['id_rents'];


$query = mysqli_query($conn, "INSERT INTO rates 
                (id_rents,star_value)
                VALUES 
                ('$id_rents','$star')");
if ($query) {
    echo "<script>
                    window.location='../index.php?page=history&funct=rate success&msg=Rate have been succes include';
                </script>";
} else {
    echo "<script>
                    window.location='../index.php?page=history&funct=rate failed&msg=Rate failed input on database!';
                </script>";
}
