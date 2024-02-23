<?php
$id_user = $_SESSION['id_user'];
$query = mysqli_query($conn, "SELECT * FROM feedback WHERE id_user='$id_user'");
if (mysqli_num_rows($query) == 0) {
?>
    <div class="wow fadeInDown" data-wow-delay="0.1s">
        <div class="container bg-success shadow mt-2 py-1 rounded-1" style="width: 50%;">
            <h2 class="text-center text-white mt-3">Gift Feedback</h2>
        </div>
        <div class="container shadow " style="width: 50%;">

            <form class="mt-3" action="./function/gift_feedback.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Feedback:</label>
                    <input type="text" name="id_user" class="form-control" value="<?= $id_user ?>" hidden>
                    <textarea name="feedback" id="feedback" cols="20" rows="5" class="form-control"></textarea>
                </div>
                <div class="d-flex justify-content-end mt-4 mb-2">
                    <button type="submit" class="btn btn-primary mb-2 px-4 py-2" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="text-center mb-5">Feed's</h1>

        <div class="owl-carousel testimonial-carousel">
            <?php
            $query = mysqli_query($conn, "SELECT user.name, feedback.* FROM feedback
            INNER JOIN user ON user.id_user = feedback.id_user ORDER BY feedback.id_feedback DESC LIMIT 10 ");
            while ($data = mysqli_fetch_array($query)) {
                $date = date_create($data['created_at']);
            ?>
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                    <p><?= $data['feed'] ?></p>
                    <div class="d-flex align-items-center">

                        <div class="">
                            <h5 class="mb-1"><?= $data['name'] ?></h5>
                            <small>Created at: <?= date_format($date, "d-m-Y") ?></small>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>
</div>