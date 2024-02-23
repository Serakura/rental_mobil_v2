<?php
session_start();
require '../database/db.php';
if (!isset($_SESSION['email'])) {
    header('Location: ../index.php');
}
function format_money($angka)
{

    $new_price = "$" . number_format($angka, 2, ',', '.');
    return $new_price;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rentalyuk - Rent a vehicle</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/logo.png" />
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" integrity="sha256-ZCK10swXv9CN059AmZf9UzWpJS34XvilDMJ79K+WOgc=" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript">
        function change(id) {
            var cname = document.getElementById(id).className;
            var ab = document.getElementById(id + "_hidden").value;
            document.getElementById(cname + "rating").innerHTML = ab;

            for (var i = ab; i >= 1; i--) {
                document.getElementById(cname + i).src = "../assets/star2.png";
            }
            var id = parseInt(ab) + 1;
            for (var j = id; j <= 5; j++) {
                document.getElementById(cname + j).src = "../assets/star1.png";
            }
        }
    </script>

</head>

<body>
    <div class="bg-white p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
 -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg  bg-dark navbar-dark shadow sticky-top p-0">
            <a href="" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <img src="../assets/logo.png" alt="villaggio qatar" style="margin-bottom: 5px;margin-top:2px; width:90px; height: 80px;">

            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php?page=rent" class="nav-item nav-link">Rent</a>
                    <a href="index.php?page=history" class="nav-item nav-link">History</a>
                    <a href="index.php?page=feedback" class="nav-item nav-link">Feedback</a>
                </div>
                <a href="../function/funct_logout.php" class="btn btn-primary rounded-0 py-4 px-lg-3 d-none d-lg-block mr-5">Logout<i class="fa fa-arrow-right ms-3"></i></a>
                <!-- <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Post A Job<i class="fa fa-arrow-right ms-3"></i></a> -->
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- content -->
        <?php
        if (!isset($_GET['page'])) {
            $page = 'rent';
        } else {
            $page = $_GET['page'];
        }

        include './page/' . $page . '.php';
        ?>

        <!-- Vehicle List End -->


        <!-- History Start -->

        <!-- History End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <div class="modal fade" id="rents" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">rents vehicles</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-start">
                    <form action="./function/rent.php" method="POST" enctype="multipart/form-data">
                        <?php
                        $idvehicles = $_GET['id_vehicle'];
                        $query = mysqli_query($conn, "SELECT * FROM vehicles WHERE id_vehicle='$idvehicles'");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_vehicle = $data['id_vehicle'];
                            $vehicle_name = $data['vehicle_name'];
                            $brand  = $data['brand'];
                            $amount = $data['price'];
                        }
                        ?>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label ">Vehicle name:</label>
                            <input type="text" class="form-control" id="id_vehicle" name="id_vehicle" value="<?php echo $id_vehicle; ?>" hidden>
                            <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $_SESSION['id_user']; ?>" hidden>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $vehicle_name ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label ">Brand:</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="<?= $brand ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label ">Price/day:</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="<?= $amount ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label ">Rent Date:</label>

                            <input type="date" class="form-control" id="rent_date" name="rent_date" value="<?= $_GET['date'] ?>" readonly required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="tanggal" class="col-form-label ">Rent return date:</label>
                            <input type="date" class="form-control" id="return_date" name="return_date" min="<?= date('Y-m-d', strtotime("+1 day", strtotime($_GET['date']))) ?>" required>
                        </div>

                        <!-- <div class="form-group mb-3">
                                                        <label for="foto" class="col-form-label">Upload Bukti Pembayaran:</label>
                                                        <input type="file" class="form-control" id="foto" name="foto" required>
                                                    </div> -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Rent now</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js" integrity="sha256-IW9RTty6djbi3+dyypxajC14pE6ZrP53DLfY9w40Xn4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <?php
    if (isset($_GET['msg']) && ($_GET['funct'] == "check failed")) {
    ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "<?= $_GET['msg'] ?>",
                text: "This vehicle is not available, select other dates or other vehicles",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php';
                }
            });
        </script>
    <?php
    } ?>
    <?php
    if (isset($_GET['msg']) && ($_GET['funct'] == "booking failed")) {
    ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Something went wrong",
                text: "<?= $_GET['msg'] ?>",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php';
                }
            });
        </script>
    <?php
    } ?>
    <?php
    if (isset($_GET['msg']) && ($_GET['funct'] == "feed success")) {
    ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "<?= $_GET['msg'] ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php?page=feedback';
                }
            });
        </script>
    <?php
    } ?>
    <?php
    if (isset($_GET['msg']) && ($_GET['funct'] == "rate success")) {
    ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "<?= $_GET['msg'] ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php?page=history';
                }
            });
        </script>
    <?php
    } ?>
    <?php
    if (isset($_GET['msg']) && ($_GET['funct'] == "booking success")) {
    ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "<?= $_GET['msg'] ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php?page=history';
                }
            });
        </script>
    <?php
    } ?>
    <?php
    if (isset($_GET['msg']) && ($_GET['funct'] == "payment success")) {
    ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "<?= $_GET['msg'] ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php?page=history';
                }
            });
        </script>
    <?php
    } ?>
    <?php
    if (isset($_GET['msg']) && ($_GET['funct'] == "check success")) {
    ?>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#rents').modal('show');
            });
        </script>
    <?php
    } ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>