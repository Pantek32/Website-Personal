<?php
require "koneksi.php";

// Ambil keyword pencarian
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

// Ambil kategori jika ada (walau sidebar dihapus, tetap aman)
$kategoriDipilih = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Query produk
$queryProduk = "SELECT * FROM produk WHERE 1=1";

if (!empty($kategoriDipilih)) {
    $queryProduk .= " AND kategori='$kategoriDipilih'";
}

if (!empty($cari)) {
    $queryProduk .= " AND nama LIKE '%$cari%'";
}

$queryProduk .= " ORDER BY id DESC";
$produk = mysqli_query($mysqli, $queryProduk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produk | Dayak Aksesoris</title>
<link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
<style>
.product-card {
    border-radius: 12px;
    transition: .3s;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}
.product-img {
    height: 220px;
    object-fit: cover;
    border-radius: 12px 12px 0 0;
}
.product-title {
    font-weight: bold;
    font-size: 1.1rem;
}
.product-price {
    color: #a52a2a;
    font-weight: bold;
}
</style>
</head>
<body>

<?php require "navbar.php"; ?>

<!-- Banner -->
<div class="container-fluid banner-produk d-flex align-items-center">
    <div class="container">
        <h1 class="text-white text-center"></h1>
    </div>
</div>

<!-- Produk -->
<div class="container mt-5 mb-5">

    <!-- Pencarian -->
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari produk..."
                value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
            <button class="btn btn-dark" type="submit">Cari</button>
        </div>
    </form>

    <div class="row g-4 justify-content-center">

        <?php if (mysqli_num_rows($produk) == 0) { ?>
            <div class="col-12 text-center">
                <h5 class="text-muted">Produk tidak ditemukan 😢</h5>
            </div>
        <?php } ?>

        <?php while($row = mysqli_fetch_array($produk)){ ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card product-card">
                <img src="image/<?= $row['foto'] ?>" class="product-img" alt="<?= $row['nama'] ?>">
                <div class="card-body text-center">
                    <div class="product-title"><?= $row['nama'] ?></div>
                    <div class="product-price">Rp <?= number_format($row['harga'],0,',','.') ?></div>
                    <a href="produk-detail.php?p=<?= $row['id'] ?>" class="btn btn-dark mt-2 w-100">Detail</a>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>

<script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
</body>
</html>
