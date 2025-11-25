<?php  
require "session.php";
require "../koneksi.php";

/* ==============================================
   VALIDASI PARAMETER ID
================================================= */
if (!isset($_GET['p']) || !is_numeric($_GET['p'])) {
    echo "<script>
            alert('ID produk tidak valid!');
            window.location='produk.php';
          </script>";
    exit;
}

$id = intval($_GET['p']);

/* ==============================================
   AMBIL DATA PRODUK BERDASARKAN ID
================================================= */
$query = mysqli_query($mysqli, "
    SELECT a.*, b.nama AS nama_kategori 
    FROM produk a 
    JOIN kategori b ON a.kategori_id = b.id 
    WHERE a.id = $id
");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>
            alert('Produk tidak ditemukan!');
            window.location='produk.php';
          </script>";
    exit;
}

/* ==============================================
   AMBIL DATA KATEGORI LAIN
================================================= */
$queryKategori = mysqli_query($mysqli, "
    SELECT * FROM kategori WHERE id != '{$data['kategori_id']}'
");

/* ==============================================
   FUNGSI RANDOM STRING UNTUK NAMA FILE FOTO
================================================= */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

/* ==============================================
   HAPUS PRODUK
================================================= */
if (isset($_POST['hapus'])) {
    $id_hapus = intval($_POST['hapus']);

    $fotoQuery = mysqli_query($mysqli, "SELECT foto FROM produk WHERE id = $id_hapus");
    $fotoData = mysqli_fetch_assoc($fotoQuery);

    if ($fotoData && !empty($fotoData['foto']) && file_exists("../image/" . $fotoData['foto'])) {
        unlink("../image/" . $fotoData['foto']);
    }

    $deleteQuery = mysqli_query($mysqli, "DELETE FROM produk WHERE id = $id_hapus");

    if ($deleteQuery) {
        echo "<script>
                alert('Produk berhasil dihapus!');
                window.location='produk.php';
              </script>";
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3 text-center'>Gagal menghapus produk.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f9f9f9; }
        form div { margin-bottom: 10px; }
        .produk-list img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; }
        .produk-list td { vertical-align: middle; }
        .container { padding: 25px; border-radius: 12px; box-shadow: 0 3px 8px rgba(0,0,0,0.1); }
        h2 { font-weight: 600; }
    </style>
</head>

<body>
<?php require "navbar.php"; ?>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Detail Produk</h2>

    <div class="col-12 col-md-6 mb-5">
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" class="form-control" required>
            </div>

            <div>
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="<?php echo $data['kategori_id']; ?>"><?php echo htmlspecialchars($data['nama_kategori']); ?></option>
                    <?php while($dataKategori = mysqli_fetch_array($queryKategori)) { ?>
                        <option value="<?php echo $dataKategori['id']; ?>"><?php echo htmlspecialchars($dataKategori['nama']); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" value="<?php echo htmlspecialchars($data['harga']); ?>" required>
            </div>

            <div>
                <label class="form-label">Foto Produk Saat Ini</label><br>
                <img src="../image/<?php echo htmlspecialchars($data['foto']); ?>" width="300px" class="img-thumbnail mb-2">
            </div>

            <div>
                <label for="foto" class="form-label">Ganti Foto (Opsional)</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

            <div>
                <label for="detail" class="form-label">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="8" class="form-control"><?php echo htmlspecialchars($data['detail']); ?></textarea>
            </div>

            <div>
                <label for="ketersediaan_stok" class="form-label">Ketersediaan Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="<?php echo $data['ketersediaan_stok']; ?>"><?php echo ucfirst($data['ketersediaan_stok']); ?></option>
                    <?php if ($data['ketersediaan_stok'] == 'tersedia') { ?>
                        <option value="habis">Habis</option>
                    <?php } else { ?>
                        <option value="tersedia">Tersedia</option>
                    <?php } ?>
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="simpan" class="btn btn-primary px-4">Simpan</button>
                <button type="submit" name="hapus" value="<?php echo $data['id']; ?>" class="btn btn-danger px-4" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus Produk</button>
            </div>
        </form>

        <?php
        /* ==============================================
           UPDATE DATA PRODUK
        =============================================== */
        if (isset($_POST['simpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = intval($_POST['kategori']);
            $harga = intval($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $stok = htmlspecialchars($_POST['ketersediaan_stok']);

            if ($nama == '' || $kategori == 0 || $harga == 0) {
                echo '<div class="alert alert-warning mt-2">Nama, kategori, dan harga wajib diisi!</div>';
            } else {
                $update = mysqli_query($mysqli, "UPDATE produk SET 
                    kategori_id='$kategori', 
                    nama='$nama', 
                    harga='$harga', 
                    detail='$detail', 
                    ketersediaan_stok='$stok' 
                    WHERE id=$id");

                if (!empty($_FILES['foto']['name'])) {
                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $new_name = generateRandomString(20) . "." . $imageFileType;
                    $target_file = $target_dir . $new_name;

                    if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                        echo '<div class="alert alert-warning mt-3">File wajib bertipe JPG, PNG, atau GIF.</div>';
                    } elseif ($image_size > 5000000) {
                        echo '<div class="alert alert-warning mt-3">Ukuran file terlalu besar (maks 5MB).</div>';
                    } else {
                        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                            mysqli_query($mysqli, "UPDATE produk SET foto='$new_name' WHERE id=$id");
                            echo '<div class="alert alert-success mt-3">Foto produk berhasil diperbarui!</div>';
                        }
                    }
                }

                if ($update) {
                    echo '<div class="alert alert-success mt-3">Data produk berhasil diperbarui!</div>';
                    echo '<meta http-equiv="refresh" content="2; url=produk-detail.php?p='.$id.'">';
                } else {
                    echo '<div class="alert alert-danger mt-3">Gagal memperbarui data produk.</div>';
                }
            }
        }
        ?>
    </div>

    <hr>
    <h4 class="mb-3">List Produk</h4>
    <div class="produk-list table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $queryProduk = mysqli_query($mysqli, "
                    SELECT a.*, b.nama AS kategori_nama
                    FROM produk a 
                    JOIN kategori b ON a.kategori_id = b.id
                    ORDER BY a.id DESC
                ");
                while ($produk = mysqli_fetch_array($queryProduk)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><img src="../image/<?php echo htmlspecialchars($produk['foto']); ?>" alt=""></td>
                    <td><?php echo htmlspecialchars($produk['nama']); ?></td>
                    <td><?php echo htmlspecialchars($produk['kategori_nama']); ?></td>
                    <td>Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo ucfirst($produk['ketersediaan_stok']); ?></td>
                    <td>
                        <a href="produk-detail.php?p=<?php echo $produk['id']; ?>" class="btn btn-sm btn-info text-white">Detail</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
