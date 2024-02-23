<?php
require '../../database/db.php';

$feed       = $_POST['feedback'];
$id_user        = $_POST['id_user'];


$query = mysqli_query($conn, "INSERT INTO feedback 
                (id_user,feed)
                VALUES 
                ('$id_user','$feed')");
if ($query) {
    echo "<script>
                    window.location='../index.php?page=feedback&funct=feed success&msg=Feedback have been succes include';
                </script>";
} else {
    echo "<script>
                    window.location='../index.php?page=feedback&funct=feed failed&msg=Feedback failed input on database!';
                </script>";
}
