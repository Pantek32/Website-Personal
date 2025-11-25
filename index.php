<?php 
require "koneksi.php";

// Produk Terlaris (ambil 5 produk terbaru sementara)
$queryTerlaris = mysqli_query($mysqli, "SELECT id, nama, harga, foto 
                                       FROM produk 
                                       ORDER BY id DESC LIMIT 5");

// Ambil produk terbaru 
$queryProduk = mysqli_query($mysqli, "SELECT id, nama, harga, foto, detail FROM produk ORDER BY id DESC LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dayak Aksesoris | Home</title>

<!-- CSS -->
<link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome/css/all.min.css">
<link rel="stylesheet" href="css/style.css">

<style>
    body { font-family: "Poppins", sans-serif; background:#fafafa; }

    .banner{
        height: 75vh;
        background: linear-gradient(rgba(0,0,0,.4),rgba(0,0,0,.4)),
                    url("image/dayak-tribal-motif-vector.jpg") center/cover no-repeat;
        animation: fadeBanner 1.3s ease-in;
    }
    @keyframes fadeBanner{ from{opacity:0;} to{opacity:1;} }

    .banner h1{ font-size:3rem; font-family: "Times New Roman", serif; font-weight:bold; }
    .banner h3{ font-size:1.7rem; }

    .highlighted-kategori{
        border-radius:15px;
        height:130px;
        background:#fff;
        box-shadow:0 3px 10px rgba(0,0,0,0.1);
        transition:.3s;
    }
    .highlighted-kategori:hover{
        transform: translateY(-5px);
        box-shadow:0 8px 18px rgba(0,0,0,0.2);
    }

    .card{
        border:none;
        border-radius:15px;
        box-shadow:0 2px 10px rgba(0,0,0,.08);
        transition:.3s;
    }
    .card:hover{ transform: translateY(-4px); box-shadow:0 6px 18px rgba(0,0,0,.15); }

    .image-box{
        height:250px;
        overflow:hidden;
        border-radius:15px 15px 0 0;
    }
    .image-box img{
        height:100%; width:100%; object-fit:cover;
        transition:.4s;
    }
    .card:hover img{ transform:scale(1.05); }

    h3{ font-family:"Times New Roman", serif; font-weight:600; }
</style>
</head>
<body>

<?php require "navbar.php"; ?>

<!-- Banner -->
<div class="banner d-flex align-items-center justify-content-center text-center text-white">
    <div class="container">
        <h1 class="mb-3">Dayak Aksesoris Home</h1>
        <h3 class="mb-4">Temukan Keindahan Budaya Lokal ✨</h3>
    </div>
</div>

<!-- Produk Terlaris (Versi Grid Elegan) -->
<section class="container py-5">
    <h3 class="text-center mb-4">Produk Terlaris</h3>
    <div class="row g-4 justify-content-center">
        <!-- Kalung Keramik -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-3 h-100">
                <img src="image/WzpD8Lf4FDueNkFBk0Tt.jpg" class="card-img-top img-fluid" style="height:250px; object-fit:cover;" alt="Kalung Keramik">
                <div class="card-body">
                    <h5 class="card-title">Kalung Keramik</h5>
                    <p class="text-muted">Perhiasan etnik khas suku dayak dari keramik pilihan.</p>
                </div>
            </div>
        </div>

        <!-- Syal Tenun -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-3 h-100">
                <img src="image/GNcG8JAkdC700TmqT4ET.jpg" class="card-img-top img-fluid" style="height:250px; object-fit:cover;" alt="Syal Tenun Dayak">
                <div class="card-body">
                    <h5 class="card-title">Syal Tenun</h5>
                    <p class="text-muted">Syal tenun khas suku dayak, handmade dan eksklusif.</p>
                </div>
            </div>
        </div>

        <!-- Tas Anyam -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-3 h-100">
                <img src="image/wN6CAOMy98apSqWcRDOR.jpg" class="card-img-top img-fluid" style="height:250px; object-fit:cover;" alt="Tas Anyam Dayak">
                <div class="card-body">
                    <h5 class="card-title">Tas Anyam</h5>
                    <p class="text-muted">Tas anyaman rotan tradisional dengan motif unik.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Produk -->
<div class="container py-5">
    <div class="text-center mb-4">
        <h3>Produk Terbaru</h3>
    </div>

    <div class="row">
        <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
        <div class="col-sm-6 col-md-4 mb-4">
            <div class="card">
                <div class="image-box">
                    <img src="image/<?php echo $data['foto']; ?>" alt="<?php echo $data['nama']; ?>">
                </div>
                <div class="card-body text-center">
                    <h5><?php echo $data['nama']; ?></h5>
                    <p class="text-truncate"><?php echo $data['detail']; ?></p>
                    <p class="fw-bold">Rp <?php echo number_format($data['harga'],0,',','.'); ?></p>
                    <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-dark px-4">Detail</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php require "footer.php"; ?>
<script src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
</body>
</html>
