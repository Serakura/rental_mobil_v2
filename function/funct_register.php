<?php
require '../database/db.php';

$name       = $_POST['name'];
$email        = $_POST['email'];
$phone       = $_POST['telepon'];
$password   = md5($_POST['password']);

$cek = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

if (mysqli_num_rows($cek) > 0) {
?>
    <script>
        window.location = '../register.php?msg=Gagal membuat akun karena email sudah digunakan';
    </script>


<?php
} else {

    $query = mysqli_query($conn, "INSERT INTO user 
        (name,email,phone,password)
         VALUES 
         ('$name','$email','$phone','$password')");


    echo "
        <script>
        window.location='../index.php?msg=Berhasil membuat akun user';
        </script>
        ";
}

?>