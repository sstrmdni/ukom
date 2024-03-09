<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">ADD NEW <span style="font-weight: bolder;">Vinyl</span></p>
                </div>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <p class="text-uppercase text-sm">Item Information</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Image</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Item</label>
                                <input type="text" class="form-control" name="nama" require="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Spesifikasi</label>
                                <input type="text" name="spek" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Kondisi Barang</label>
                                <select id="selectReq" name="kondisi" class="form-control" required>
                                    <option value="NEW">NEW</option>
                                    <option value="SECOND">SECOND</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Jumlah Barang</label>
                                <input type="text" name="jumlah" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Sumber Dana</label>
                                <input type="text" name="sumber" class="form-control">
                            </div>
                        </div>
                        <div class="mt-2 text-end">
                            <button class="btn btn-primary" name="add">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>