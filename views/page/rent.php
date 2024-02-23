<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" id="list" data-wow-delay="0.1s">Rent a vehicle</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="tab-content">

                <div id="tab-2" class="tab-pane fade show p-0 active">
                    <?php
                    $query = "SELECT * FROM vehicles";

                    $data = mysqli_query($conn, $query);
                    while ($d = mysqli_fetch_array($data)) {

                    ?>
                        <!-- Card Start -->
                        <div class="job-item p-4 mb-4">
                            <div class="d-flex row g-4">
                                <div class="col-sm-12 col-md-8 d-flex flex-grow-1">
                                    <img class="flex-shrink-0 img-fluid rounded" src="./../assets/images/<?= $d['image'] ?>" alt="" style="width: 400px; height: 300px;">
                                    <div class="text-start ps-4 justify-content-between d-flex flex-column flex-grow-1">
                                        <div class="flex">
                                            <h4 class="mb-3"><?= $d['vehicle_name'] ?></h4>
                                            <span class="text-truncate me-3"><i class="fa fa-bus text-primary me-2"></i><?= $d['brand'] ?></span>
                                            <span class="text-truncate me-3"><i class="fa fa-award text-primary me-2"></i><?= ucfirst($d['type']) ?></span>
                                            <div class="mt-3 mb-3">
                                                <?php
                                                $id = $d['id_vehicle'];
                                                $select_rating = mysqli_query($conn, "SELECT id_rates,star_value FROM rates 
                                                INNER JOIN rents ON rents.id_rents = rates.id_rents
                                                INNER JOIN vehicles ON vehicles.id_vehicle = rents.id_vehicle
                                                WHERE vehicles.id_vehicle = '$id'");
                                                $total = mysqli_num_rows($select_rating);
                                                if ($total > 0) {
                                                    $rate = array();
                                                    while ($row = mysqli_fetch_array($select_rating)) {
                                                        array_push($rate, $row['star_value']);
                                                    }
                                                    $total_php_rating = (array_sum($rate) / $total);
                                                ?>
                                                    <span class="fw-bold">Rating</span>
                                                    <?= round($total_php_rating, 1); ?>
                                                    <i class="fa fa-star" style="color: gold;"></i>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="fw-bold">Rating</span>
                                                    <?= 0 ?>
                                                    <i class="fa fa-star" style="color: gold;"></i>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                            <span class="text-truncate"><span class="fw-bold">Price</span> <?= format_money($d['price']) ?>/day</span>
                                        </div>
                                    </div>
                                    <div class="pe-4 text-start d-flex column align-items-center">
                                        <a data-bs-toggle="modal" data-bs-target="#cek<?php echo $d['id_vehicle'] ?>" class="btn btn-primary">Check Availability</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card End -->

                        <div class="modal fade" id="cek<?php echo $d['id_vehicle'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Check Vehicle Availability</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <form action="./function/check_availability.php" method="POST" enctype="multipart/form-data">
                                            <div class="form-group mb-3">
                                                <label for="tanggal" class="col-form-label ">Rent date:</label>
                                                <input type="text" class="form-control" id="id_vehicle" name="id_vehicle" value="<?php echo $d['id_vehicle']; ?>" hidden>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" min="<?= date("Y-m-d") ?>" required>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Submit</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>

            </div>
        </div>
    </div>
</div>