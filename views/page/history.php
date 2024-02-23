<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" id="history" data-wow-delay="0.1s">Rent History</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3 active" data-bs-toggle="pill" href="#tab-2">
                        <h6 class="mt-n1 mb-0">List of rent</h6>
                    </a>
                </li>

            </ul>

            <div class="tab-content">

                <div id="tab-2" class="tab-pane fade show p-0 active">
                    <?php
                    $idu = $_SESSION['id_user'];
                    $query = "SELECT vehicles.vehicle_name,vehicles.image,rents.* FROM rents 
                            INNER JOIN vehicles ON vehicles.id_vehicle = rents.id_vehicle    
                            WHERE rents.id_user = '$idu' ORDER BY rents.status DESC";

                    $data = mysqli_query($conn, $query);
                    while ($d = mysqli_fetch_array($data)) {
                        $tgl_rents = date_create($d['rent_date']);
                        $tgl_kembali = date_create($d['return_date']);
                    ?>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded" src="./../assets/images/<?= $d['image'] ?>" alt="" style="width: 100px; height: 90px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3"><?= $d['vehicle_name'] ?></h5>

                                        <span class="text-truncate me-3"><i class="fas fa-calendar-alt text-primary me-2"></i>Rent Date : <?= date_format($tgl_rents, "d-m-Y") ?></span>
                                        <span class="text-truncate me-3"><i class="far fa-calendar-alt text-primary me-2"></i>Rent Return Date : <?= date_format($tgl_kembali, "d-m-Y") ?></span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= $d['total_date'] ?> days</span>
                                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?= format_money($d['amount']) ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <?php if ($d['status'] == "Paid") { ?>
                                        <div class="d-flex mb-3">
                                            <?php
                                            $date_now = date("Y-m-d");
                                            $idr = $d['id_rents'];
                                            $query = mysqli_query($conn, "SELECT rates.*,rents.return_date FROM rates 
                                            INNER JOIN rents ON rents.id_rents = rates.id_rents WHERE rates.id_rents='$idr' OR rents.return_date < $date_now");
                                            if (mysqli_num_rows($query) == 0) {
                                            ?>
                                                <a data-bs-toggle="modal" data-bs-target="#rate<?php echo $d['id_rents'] ?>" class="btn btn-warning text-white mx-2">Rate</a>
                                            <?php } ?>
                                            <a href="./function/print_invoice.php?id_rents=<?php echo $d['id_rents'] ?>" class="btn btn-primary"><i class="far fa-address-card text-light me-2"></i>Invoice</a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="d-flex mb-3">
                                            <a data-bs-toggle="modal" data-bs-target="#bayar<?php echo $d['id_rents'] ?>" class="btn btn-primary">PAY NOW</a>
                                        </div>
                                    <?php } ?>

                                    <div class="d-flex mb-3">
                                        <span class="text-truncate me-0"><i class="far fa-list-alt text-primary me-2"></i>Status:
                                            <?php
                                            if ($d['status'] == "Paid") {
                                                echo "<span class='badge bg-success'>PAID</span>";
                                            } else {
                                                echo "<span class='badge bg-danger'>UNPAID</span>";
                                            }

                                            ?> </span>
                                    </div>
                                    <!-- <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Post: 06 Sept, 2023</small> -->
                                </div>
                            </div>
                        </div>
                        <?php if ($d['status'] == "Paid") { ?>
                            <div class="modal fade" id="rate<?php echo $d['id_rents'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">RATE</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <form action="./function/rate.php" method="POST" enctype="multipart/form-data">
                                                <?php
                                                $ids = $d['id_rents'];

                                                ?>
                                                <div class="form-group mb-4">
                                                    <label for="tanggal" class="col-form-label ">Star:</label>
                                                    <input type="text" class="form-control" id="id_rents" name="id_rents" value="<?php echo $ids; ?>" hidden>
                                                    <select name="star" id="star" class="form-control" required>
                                                        <option value="">--- Select total star ---</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Send</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } else { ?>

                            <div class="modal fade" id="bayar<?php echo $d['id_rents'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">PAYMENT</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <form action="./function/payment.php" method="POST" enctype="multipart/form-data">
                                                <?php
                                                $ids = $d['id_rents'];

                                                ?>
                                                <div class="form-group">
                                                    <label for="tanggal" class="col-form-label ">Payment Method:</label>
                                                    <input type="text" class="form-control" id="id_rents" name="id_rents" value="<?php echo $ids; ?>" hidden>
                                                    <select name="payment_method" id="payment_method" class="form-control" required>
                                                        <option value="">--- Select a payment method ---</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Transfer">Transfer</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-4" id="bukti">
                                                    <label for="tanggal" class="col-form-label ">Proof:</label>
                                                    <input type="text" class="form-control" id="id_rents" name="id_rents" value="<?php echo $ids; ?>" hidden>
                                                    <input type="file" class="form-control" name="image">
                                                </div>



                                                <!-- <div class="form-group mb-3">
                                                        <label for="foto" class="col-form-label">Upload Bukti Pembayaran:</label>
                                                        <input type="file" class="form-control" id="foto" name="foto" required>
                                                    </div> -->
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Pay</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>


                </div>

            </div>
        </div>
    </div>
</div>