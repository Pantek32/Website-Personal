<?php require 'navbar.php'; ?>

<style>
.hero-section {
    background: linear-gradient(135deg, #84994F, #84994F);
    color: white;
    padding: 80px 20px;
    border-radius: 12px;
}
.section-title {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 15px;
}
.fade-up {
    opacity: 0;
    transform: translateY(25px);
    animation: fadeUp .9s forwards;
}
@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.icon-box {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,.10);
    transition: .3s;
}
.icon-box:hover {
    transform: translateY(-5px);
}
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: 24px;
    background: #84994F;
    color: #fff;
    margin-bottom: 15px;
}
</style>

<div class="container mt-5 fade-up">
    <div class="hero-section text-center">
        <h1 class="fw-bold">Tentang Kami</h1>
        <p class="lead mt-2">Kami menghadirkan kenyamanan berbelanja dengan cara modern, mudah, dan terpercaya.</p>
    </div>
</div>

<div class="container py-5 fade-up">
    <h2 class="section-title text-center">Visi & Misi</h2>

    <p class="text-center fs-5 mb-4">Membangun pengalaman belanja digital terbaik untuk seluruh pelanggan di Indonesia.</p>

    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <div class="icon-box">
                <div class="icon-circle">🎯</div>
                <h5>Visi</h5>
                <p>Menjadi toko online terpercaya dengan layanan terbaik & pilihan produk unggulan.</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="icon-box">
                <div class="icon-circle">🚀</div>
                <h5>Inovasi</h5>
                <p>Terus menghadirkan sistem belanja modern dengan teknologi terbaru.</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="icon-box">
                <div class="icon-circle">🤝</div>
                <h5>Misi</h5>
                <p>Memberikan solusi cepat, aman, dan mudah dalam memenuhi kebutuhan belanja Anda.</p>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5 fade-up">
    <h2 class="section-title text-center">Keunggulan Kami</h2>

    <div class="row text-center">
        <div class="col-md-3 mb-3">
            <div class="icon-box">
                <div class="icon-circle">✅</div>
                <h5>Produk Terpilih</h5>
                <p>Barang berkualitas dan terjamin keasliannya.</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="icon-box">
                <div class="icon-circle">⚡</div>
                <h5>Pengiriman Cepat</h5>
                <p>Proses packing cepat & aman.</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="icon-box">
                <div class="icon-circle">💬</div>
                <h5>Support Ramah</h5>
                <p>Layanan pelanggan responsif & bantu kapan saja.</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="icon-box">
                <div class="icon-circle">🔒</div>
                <h5>Transaksi Aman</h5>
                <p>Sistem pembayaran aman & terverifikasi.</p>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="fontawesome/css/all.min.css">
<?php require 'footer.php'; ?>
