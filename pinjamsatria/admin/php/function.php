<?php
$conn = mysqli_connect("localhost", "root", "", "ukom_satria");


if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $spek = $_POST['spek'];
    $lokasi = $_POST['lokasi'];
    $kondisi = $_POST['kondisi'];
    $jumlah = $_POST['jumlah'];
    $sumber = $_POST['sumber'];
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $namaimage = $_FILES['file']['name'];
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        $dot = explode('.', $namaimage);
        $ekstensi = strtolower(end($dot));

        $allowed_extension = array('png', 'jpg', 'jpeg', 'svg', 'webp');
        if (in_array($ekstensi, $allowed_extension)) {
            $image = md5(uniqid($namaimage, true) . time()) . '.' . $ekstensi;

            $upload_path = '../assets/img/' . $image;
            move_uploaded_file($file_tmp, $upload_path);

            $insert = mysqli_query($conn, "INSERT INTO alatbahan (nama_barang, spesifikasi, image, lokasi, kondisi, jumlah_barang, sumber_dana) VALUES ('$nama', '$spek', '$image', '$lokasi', '$kondisi', '$jumlah', '$sumber')");
            if ($insert) {
                $idb = mysqli_insert_id($conn);
                $insert2 = mysqli_query($conn, "INSERT INTO stok (id_barang, nama_barang) VALUES ('$idb', '$nama')");
                if ($insert2) {
                    header("location:?url=product");
                }
            }
        }
    }
}

if (isset($_POST['user'])) {
    $nama =  $_POST['nama'];
    $user = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $insert = mysqli_query($conn, "INSERT INTO user (nama, username, password, level) VALUES ('$nama', '$user', '$password', '$level')");
    if ($insert) {
        echo '<script>
        alert("User ' . $nama . ' telah dibuat!");
        window.location.href = "?url=user";
        </script>';
    }
}

if (isset($_POST['addpenyedia'])) {
    $nama =  $_POST['nama'];
    $telpon = $_POST['telpon'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($conn, "INSERT INTO penyedia (nama_penyedia, alamat_penyedia, telpon_penyedia) VALUES ('$nama', '$alamat', '$telpon')");
    if ($insert) {
        echo '<script>
        alert("Supplier ' . $nama . ' telah dibuat!");
        window.location.href = "?url=penyedia";
        </script>';
    }
}

if (isset($_POST['editpenyedia'])) {
    $nama = $_POST['nama'];
    $telpon = $_POST['telpon'];
    $alamat = $_POST['alamat'];
    $idp = $_POST['idp'];

    $update = mysqli_query($conn, "UPDATE penyedia SET nama_penyedia = '$nama', telpon_penyedia = '$telpon', alamat_penyedia = '$alamat' WHERE id_penyedia = $idp");
    if ($update) {
        header("location:?url=penyedia");
    }
}

if (isset($_POST['hapuspenyedia'])) {
    $idp =  $_POST['idp'];
    $nama = $_POST['nama'];

    $delete = mysqli_query($conn, "DELETE FROM penyedia WHERE id_penyedia = '$idp'");
    if ($delete) {
        echo '<script>
        alert("Supplier ' . $nama . ' telah dihapus!");
        window.location.href = "?url=penyedia";
        </script>';
    }
}

if (isset($_POST['barangmasuk'])) {
    $nama = $_POST['nama'];
    $qty = $_POST['qty'];
    $penyedia = $_POST['penyedia'];
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');

    $select = mysqli_query($conn, "SELECT jumlah_barang, id_barang, id_penyedia FROM alatbahan, penyedia WHERE nama_penyedia = '$penyedia' AND nama_barang = '$nama'");
    $assoc = mysqli_fetch_array($select);
    $idb =  $assoc['id_barang'];
    $idp = $assoc['id_penyedia'];
    $jml =  $assoc['jumlah_barang'];
    $total = $jml + $qty;
    if ($select) {
        $insert = mysqli_query($conn, "INSERT INTO barang_masuk(id_barang, nama_barang, tgl_masuk, jml_masuk, id_penyedia, jml_sebelum, jml_sesudah) VALUES ('$idb', '$nama', '$date', '$qty', '$idp', '$jml', '$total')");
        if ($insert) {
            $update = mysqli_query($conn, "UPDATE alatbahan SET jumlah_barang = '$total' WHERE id_barang = '$idb'");
            if ($update) {
                $select = mysqli_query($conn, "SELECT jml_masuk, total_barang FROM stok WHERE id_barang = '$idb'");
                $array = mysqli_fetch_array($select);
                $masuk = $array['jml_masuk'];
                $total = $array['total_barang'];
                $masuk1 = $masuk + $qty;
                $total1 = $total + $qty;
                if ($select) {
                    $stok = mysqli_query($conn, "UPDATE stok SET jml_masuk = '$masuk1', total_barang = '$total1'");
                }
            }
        }
    }
}
