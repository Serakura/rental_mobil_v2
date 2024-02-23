<?php
session_start();
require '../database/db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);


    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND password='$password'");
    if (mysqli_num_rows($query) == 0) {

?>
        <script>
            alert("Oops! Email or Password is wrong.");
            document.location = "./../index.php";
        </script>


    <?php
    } else {
        $result = mysqli_fetch_assoc($query);

        $_SESSION['id_user'] = $result['id_user'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['password'] = $result['password'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['role']   = "user";

    ?>

        <script>
            document.location = "./../views/index.php";
        </script>

<?php
    }
}
?>