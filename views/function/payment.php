<?php
require '../../database/db.php';
$fil_dir = '../../upload_files/bukti_bayar/';
$id_rents       = $_POST['id_rents'];
$payment_method        = $_POST['payment_method'];
$status     = "Paid";

$image     = $_FILES['image']['name'];
$tmpimage  = $_FILES['image']['tmp_name'];


$ekstensifile     = explode('.', $image);
$ekstensifile    = strtolower(end($ekstensifile));

if ($payment_method == 'Cash') {
    $query = mysqli_query($conn, "INSERT INTO transactions 
                (id_rents,payment_method)
                VALUES 
                ('$id_rents','$payment_method')");
    $query1 = mysqli_query($conn, "UPDATE rents SET status='$status' WHERE id_rents = '$id_rents'");

    echo "<script>
            window.location='../index.php?page=history&funct=payment success&msg=Payment is success, please print the invoice!';
        </script>";
} else {
    if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
        echo "<script>
                window.location='../index.php?page=history&funct=payment failed&msg=Transaction failed!';
            </script>";
    } else {
        $nameFileBaru  = uniqid() . '_' . $image;
        $pidah_folder = move_uploaded_file($tmpimage, $fil_dir . $nameFileBaru);

        if ($pidah_folder) {
            $query = mysqli_query($conn, "INSERT INTO transactions 
                    (id_rents,payment_method,payment_proof)
                    VALUES 
                    ('$id_rents','$payment_method','$nameFileBaru')");
            $query1 = mysqli_query($conn, "UPDATE rents SET status='$status' WHERE id_rents = '$id_rents'");

            echo "<script>
                    window.location='../index.php?page=history&funct=payment success&msg=Payment is success, please print the invoice!';
                </script>";
        } else {
            echo "<script>
                    window.location='../index.php?page=history&funct=payment failed&msg=Transaction failed!';
                </script>";
        }
    }
}
