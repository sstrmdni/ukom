<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Add New User</p>
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
                    <h6>List Kaset Vinyl</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center justify-content-center mb-0" style="width:100%" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th data-column="nama" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Password</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $per_page = 10;
                                $page_number = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                                $start = ($page_number - 1) * $per_page;

                                // Query dengan LIMIT dan OFFSET untuk pagination
                                $ambil = mysqli_query($conn, "SELECT * FROM user");

                                $i = ($page_number - 1) * $per_page + 1;
                                while ($data = mysqli_fetch_array($ambil)) {
                                ?>
                                    <tr class="parentRow">
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 text-center"><?= $i++; ?></p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-boldn text-wrap"><?= $data['nama']; ?></a></span>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold"><?= $data['username']; ?></span>
                                        </td>
                                        <td>
                                            <span class="password-mask"><?= str_repeat('*', strlen($data['password'])); ?></span>
                                            <span class="text-xs password-open" style="display: none;"><?= $data['password']; ?></span>

                                            <button class="btn btn-link btn-toggle-password" type="button">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>


                                        <td>
                                            <span class="text-xs font-weight-bold"><?= $data['level']; ?></span>
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
                                <input class="form-control" type="text" name="nama">
                            </div>
                            <div class="col-lg-6">
                                <label for="">User</label>
                                <input class="form-control" type="text" name="username">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Level</label>
                                <select name="level" class="form-control">
                                    <option value="administrator">administrator</option>
                                    <option value="peminjam">peminjam</option>
                                    <option value="manajemen">manajemen</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-end mt-2">
                            <button class="btn btn-primary" name="user">SUBMIT</button>
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