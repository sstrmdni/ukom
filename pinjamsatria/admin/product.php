<?php

$sku = isset($_GET['sku']) ? $_GET['sku'] : '';

$nama = isset($_GET['nama']) ? $_GET['nama'] : '';

// Buat kondisi untuk memeriksa apakah $sku ada nilai atau kosong

$sku_condition = '';

if (!empty($sku)) {

    $sku_condition = "AND (sku_toko LIKE'%$sku%' OR nama LIKE'%$sku%')";
}

?>




<div class="row">

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">

        <div class="card">

            <div class="card-body p-3">

                <div class="row">

                    <div class="col-8">

                        <div class="numbers">

                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Add New Item</p>

                            <a href="?url=newvinyl" class="btn btn-primary mt-3">Add</a>

                        </div>

                    </div>

                    <div class="col-4 text-end">

                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">

                            <i class="fa fa-plus text-lg opacity-10" aria-hidden="true"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">

        <div class="card">

            <div class="card-body p-3">

                <div class="row">

                    <div class="col-8">

                        <div class="numbers">

                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Barang Masuk</p>

                            <a class="btn mt-3 btn-danger" data-bs-toggle="modal" data-bs-target="#finishModal">ADD</a>

                        </div>

                    </div>

                    <div class="col-4 text-end">

                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">

                            <i class="fa fa-box text-lg opacity-10" aria-hidden="true"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-12">

            <div class="card mb-4">

                <div class="card-header pb-0 mb-2">

                    <h6>List Kaset Vinyl</h6>

                </div>

                <div class="card-body px-0 pt-0 pb-2">

                    <div class="table-responsive">

                        <table class="table align-items-center justify-content-center mb-0" style="width:100%" id="myTable">

                            <thead>

                                <tr>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gambar</th>

                                    <th data-column="nama" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Item</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Spesifikasi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Lokasi</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kondisi</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jumlah</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Sumber Dana</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $per_page = 10;



                                $query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM alatbahan $sku_condition");

                                $row_total = mysqli_fetch_assoc($query_total);

                                $total_data = $row_total['total'];

                                $total_pages = ceil($total_data / $per_page);

                                $page_number = isset($_GET['page']) ? (int) $_GET['page'] : 1;

                                $start = ($page_number - 1) * $per_page;

                                $ambil = mysqli_query($conn, "SELECT * FROM alatbahan");

                                $i = ($page_number - 1) * $per_page + 1;

                                $max_buttons = 5;

                                $start_page = max(1, $page_number - floor($max_buttons / 2));

                                $end_page = min($total_pages, $start_page + $max_buttons - 1);

                                while ($data = mysqli_fetch_array($ambil)) {
                                    $gambar = $data['image'];

                                    if ($gambar == null) {

                                        // jika tidak ada gambar

                                        $img = '<img src="/assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                    } else {

                                        //jika ada gambar

                                        $img = '<img src="../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                    }

                                ?>

                                    <tr class="parentRow">

                                        <td>

                                            <p class="text-sm font-weight-bold mb-0 text-center">
                                                <?= $i++; ?>
                                            </p>

                                        </td>

                                        <td>



                                            <div class="d-flex px-1">



                                                <div>



                                                    <?= $img; ?>



                                                </div>


                                            </div>



                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-boldn text-wrap">
                                                <?= $data['nama_barang']; ?></a></span>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">
                                                <?= $data['spesifikasi']; ?>
                                            </span>

                                        </td>
                                        <td>

                                            <span class="text-xs font-weight-bold">
                                                <?= $data['lokasi']; ?>
                                            </span>

                                        </td>
                                        <td>

                                            <span class="text-xs font-weight-bold">
                                                <?= $data['kondisi']; ?>
                                            </span>

                                        </td>

                                        <td><span class="text-xs font-weight-bold">
                                                <?= $data['jumlah_barang']; ?>
                                            </span></td>

                                        <td>
                                            <span class="text-xs font-weight-bold">
                                                <?= $data['sumber_dana']; ?>
                                            </span>
                                        </td>

                                    </tr>

                                <?php

                                }

                                ?>

                            </tbody>

                        </table>

                    </div>



                </div>


                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



                <script>
                    $(document).ready(function() {

                        // Initialize DataTable for the parent table only

                        $('.parentTable').DataTable({

                            // Add your DataTable options and configurations here

                            // For example:

                            // "paging": false,

                            // "searching": false,

                            // "ordering": false,

                            // "info": false,

                        });

                    });
                </script>

            </div>

        </div>

    </div>

</div>

</div>


<div class="modal fade" id="finishModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Barang Masuk</h5>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Nama</label>
                                <select class="form-control" name="nama" id="">
                                    <?php
                                    $select = mysqli_query($conn, "SELECT nama_barang FROM alatbahan");
                                    while ($row = mysqli_fetch_assoc($select)) {
                                        echo "<option value='" . $row['nama_barang'] . "'>" . $row['nama_barang'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Barang Masuk</label>
                                <input class="form-control" type="text" name="qty">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Penyedia</label>
                                <select class="form-control" name="penyedia" id="">
                                    <?php
                                    $ambil = mysqli_query($conn, "SELECT nama_penyedia FROM penyedia");
                                    while ($row = mysqli_fetch_assoc($ambil)) {
                                        echo "<option value='" . $row['nama_penyedia'] . "'>" . $row['nama_penyedia'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        <div class="text-end mt-2">
                            <button class="btn btn-primary" name="barangmasuk">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>