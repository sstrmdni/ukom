<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 mb-2">
                <h6>List History Vinyl Yang Masuk</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center justify-content-center mb-0" style="width:100%" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gambar</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jml Sebelum</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Penambah</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jml Sesudah</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Penyedia</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $per_page = 10;
                            $page_number = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                            $start = ($page_number - 1) * $per_page;

                            // Query dengan LIMIT dan OFFSET untuk pagination
                            $ambil = mysqli_query($conn, "SELECT * FROM barang_masuk, alatbahan, penyedia WHERE barang_masuk.id_barang = alatbahan.id_barang AND barang_masuk.id_penyedia = penyedia.id_penyedia");

                            $i = ($page_number - 1) * $per_page + 1;
                            while ($data = mysqli_fetch_array($ambil)) {
                                $gambar = $data['image'];

                                if ($gambar == null) {

                                    $img = '<img src="/assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                } else {


                                    $img = '<img src="../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                                }
                            ?>
                                <tr class="parentRow">
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0 text-center"><?= $i++; ?></p>
                                    </td>
                                    <td>



                                        <div class="d-flex px-1">



                                            <div>



                                                <?= $img; ?>



                                            </div>


                                        </div>



                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-boldn text-wrap"><?= $data['nama_barang']; ?></a></span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold"><?= $data['jml_sebelum']; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-xs text-success font-weight-bold">+ <?= $data['jml_masuk']; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold"><?= $data['jml_sesudah']; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold"><?= $data['nama_penyedia']; ?></span>
                                    </td>


                                    <td>
                                        <span class="text-xs font-weight-bold"><?= $data['tgl_masuk']; ?></span>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>