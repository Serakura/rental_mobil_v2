<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/logo-webinarin.png" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet">

    <title>Rentalyuk || Register</title>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow mb-5" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="./assets/logo.png" alt="login form" class="img-fluid px-3 py-3" style="border-radius: 1rem 0 0 1rem; margin-top:140px;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center bg-dark shadow">
                                <div class="card-body p-4 p-lg-5 text-light">
                                    <form class="mt-3" action="./function/funct_register.php" method="POST">
                                        <?php if (isset($_GET['msg'])) {
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $_GET['msg'] ?>
                                            </div>
                                        <?php

                                        } ?>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input name="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Name" required autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Telepon" class="form-label">Phone</label>
                                            <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Phone" required autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autofocus>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4 mb-2">
                                            <button type="submit" class="btn form-control btn-primary mb-2 px-4 py-2" name="register">Sign up</button>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <p>Already a user? <a href="index.php">Login</a></p>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>