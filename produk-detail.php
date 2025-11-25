<?php
require "koneksi.php";

// Ambil ID produk
$idProduk = isset($_GET['p']) ? $_GET['p'] : 0;

// Query produk
$query = mysqli_query($mysqli, "SELECT * FROM produk WHERE id='$idProduk'");
$produk = mysqli_fetch_assoc($query);

// Jika produk tidak ditemukan
if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan'); window.location='produk.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $produk['nama'] ?> | Dayak Aksesoris Home</title>
<link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
<style>
.detail-img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 15px;
}
.price-label {
    font-size: 1.3rem;
    font-weight: bold;
    color: brown;
}
</style>
</head>
<body>

<?php require "navbar.php"; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        
        <!-- Foto Produk -->
        <div class="col-md-5 mb-4">
            <img src="image/<?= $produk['foto'] ?>" class="detail-img shadow" alt="<?= $produk['nama'] ?>">
        </div>

        <!-- Detail Produk -->
        <div class="col-md-7">
            <h2><?= $produk['nama'] ?></h2>
            <p class="price-label">Rp <?= number_format($produk['harga'],0,',','.') ?></p>

            <p><?= nl2br($produk['detail']) ?></p>

            <!-- Tombol -->
            <div class="mt-4 d-flex gap-2">
                <a href="produk.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <!-- Tombol WhatsApp (opsional) -->
                <a href="https://wa.me/6285752443191?text=Halo, saya ingin pesan produk <?= urlencode($produk['nama']) ?>" 
                   class="btn btn-success" target="_blank">
                    <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                </a>
            </div>
        </div>

    </div>
</div>

<script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
</body>
</html>
