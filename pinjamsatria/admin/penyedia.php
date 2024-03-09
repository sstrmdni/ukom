<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Add Penyedia</p>
                            <a class="btn mt-3 btn-primary" data-bs-toggle="modal" data-bs-target="#finishModal">ADD</a>
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

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 mb-2">
                    <h6>List Penyedia</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center justify-content-center mb-0" style="width:100%" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th data-column="nama" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. Telpon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Edit / Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $per_page = 10;
                                $page_number = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                                $start = ($page_number - 1) * $per_page;

                                // Query dengan LIMIT dan OFFSET untuk pagination
                                $ambil = mysqli_query($conn, "SELECT * FROM penyedia");

                                $i = ($page_number - 1) * $per_page + 1;
                                while ($data = mysqli_fetch_array($ambil)) {
                                ?>
                                    <tr class="parentRow">
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-center"><?= $i++; ?></p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-boldn text-wrap"><?= $data['nama_penyedia']; ?></a></span>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold text-wrap"><?= $data['alamat_penyedia']; ?></span>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold"><?= $data['telpon_penyedia']; ?></span>
                                        </td>
                                        <td class="text-center">
                                            <a data-bs-toggle="modal" data-bs-target="#edit<?= $data['id_penyedia']; ?>">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit<?= $data['id_penyedia']; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                                                    <form method="post" action="" enctype="multipart/form-data">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label for="">Nama</label>
                                                                    <input class="form-control" value="<?= $data['nama_penyedia']; ?>" type="text" name="nama">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label for="">Telpon</label>
                                                                    <input class="form-control" value="<?= $data['telpon_penyedia']; ?>" type="text" pattern="\+[0-9]+" name="telpon">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label for="">Alamat</label>
                                                                    <textarea class="form-control" name="alamat" placeholder="Masukkan alamat lengkap penyedia.." required><?= $data['alamat_penyedia']; ?></textarea>
                                                                </div>
                                                                <input type="hidden" value="<?= $data['id_penyedia']; ?>" name="idp">
                                                                <div class="text-end mt-2">
                                                                    <button class="btn btn-danger" name="hapuspenyedia">Hapus</button>
                                                                    <button class="btn btn-warning" name="editpenyedia">Edit</button>
                                                                </div>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


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
</div>
<div class="modal fade" id="finishModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Nama</label>
                                <input class="form-control" type="text" name="nama" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Telpon</label>
                                <input class="form-control" type="text" pattern="\+[0-9]+" name="telpon" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="masukkan alamat lengkap penyedia.." required></textarea>
                            </div>
                            <div class="text-end mt-2">
                                <button class="btn btn-primary" name="addpenyedia">SUBMIT</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const togglePasswordButtons = document.querySelectorAll(".btn-toggle-password");

        togglePasswordButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                const passwordMask = this.parentNode.querySelector(".password-mask");
                const passwordOpen = this.parentNode.querySelector(".password-open");

                if (passwordMask.style.display === 'none') {
                    passwordMask.style.display = 'inline';
                    passwordOpen.style.display = 'none';
                    this.innerHTML = '<i class="fa fa-eye"></i>';
                } else {
                    passwordMask.style.display = 'none';
                    passwordOpen.style.display = 'inline';
                    this.innerHTML = '<i class="fa fa-eye-slash"></i>';
                }

            });
        });
    });
</script>