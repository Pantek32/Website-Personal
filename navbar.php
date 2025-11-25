<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Navbar Minimalis</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Tambahan gaya minimalis */
    .navbar {
      background-color: #84994F;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      font-family: 'Times New Roman', Times, serif;

    }

    .navbar-brand {
      font-weight: 600;
      color: #555 !important;
      font-family: 'Times New Roman', Times, serif;

    }

    .nav-link {
      color: #555 !important;
      transition: 0.3s;
      font-weight: 500;
      font-family: 'Times New Roman', Times, serif;

    }

    .nav-link:hover {
      color: #0df1fdff !important;
    }

    /* Responsif padding di HP */
    @media (max-width: 576px) {
      .navbar {
        padding: 0.5rem 1rem;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">Dayak Aksesoris Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        arial-controls="navbarNav" arial-expanded="false" arial-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" arial-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="produk.php">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tentang.php">Tentang</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
