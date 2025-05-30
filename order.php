<?php
// Setel judul & sertakan Header
$pageTitle = $pageTitle ?? 'Promo | Travlie';

// Definisikan kategori untuk tombol filter
$categories = [
    'All'           => 'Semua',
    'Flight'        => 'Flight',
    'Accommodation' => 'Accommodation', // Sesuaikan nama jika perlu (di DB & View)
    'Vehicle Rent'  => 'Vehicle Rent'
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon.ico" type="x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@200..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/style-order.css">

</head>
<body>
   <?php include_once 'views/layouts/header.php'; ?>

  <div class="container my-4">
    <div class="row align-items-center">
      <div class="col-lg-5">
        <div class="hero-image mb-3" style="background-image: url('<?= STYLES_PATH ?>style/assets/promo .jpg');"></div>
      </div>
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h2><strong>Promo Terbaik Hari Ini</strong></h2>
        <a href="<?= BASE_URL ?>/index.php?c=promo&m=index" class="btn btn-outline-dark mt-3 w-50">Lihat Semua Promo</a>
      </div>
    </div>
  </div>
  
  <hr class="border-2 border-black opacity-100">
  
  <div class="container mb-4 mt-5">
    <h4>Filter Promo:</h4>
    <div class="d-flex gap-2 flex-wrap">
      <?php foreach ($categories as $catKey => $catValue): ?>
          <?php
              // Sesuaikan kunci untuk 'data-filter' agar cocok (Accomodation -> accomodation)
              $dataFilter = strtolower(str_replace(' ', '', $catKey));
              if ($dataFilter === 'all') $dataFilter = 'all'; // Pastikan 'all'
              if ($dataFilter === 'accommodation') $dataFilter = 'accomodation'; // Cocokkan dengan HTML Anda
              if ($dataFilter === 'vehiclerent') $dataFilter = 'rent'; // Cocokkan dengan HTML Anda

              $isActive = ($catKey == $activeCategory) ? 'active' : '';
              $filterLink = BASE_URL . '/index.php?c=promo&m=index&category=' . $catKey;
          ?>
          <a href="<?= $filterLink ?>"
             class="btn btn-outline-secondary filter-btn <?= $isActive ?>"
             data-filter="<?= $dataFilter ?>"> <?= $catValue ?>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
  
  <div class="container mb-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3"> <?php if (!empty($promos)): ?>
          <?php foreach ($promos as $promo): ?>
              <?php
                  $dataKategori = strtolower(str_replace(' ', '', $promo->category));
                   if ($dataKategori === 'accommodation') $dataKategori = 'accomodation';
                   if ($dataKategori === 'vehiclerent') $dataKategori = 'rent';
              ?>
              <div class="col" data-kategori="<?= $dataKategori ?>">
                <a href="#" style="text-decoration: none;" class="text-dark"> <div class="card promo-card h-100"> <img src="<?= STYLES_PATH ?>/assets/<?= htmlspecialchars($promo->image_url) ?>" class="card-img-top" alt="<?= htmlspecialchars($promo->category) ?>">
                    <div class="card-body">
                      <h5 class="card-title"><?= htmlspecialchars($promo->title) ?></h5>
                      <p class="card-text"><?= htmlspecialchars($promo->description) ?></p>
                    </div>
                  </div>
                </a>
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <div class="col-12">
              <div class="alert alert-warning text-center" role="alert">
                  Maaf, saat ini tidak ada promo yang tersedia untuk kategori '<?= htmlspecialchars($activeCategory) ?>'.
              </div>
          </div>
      <?php endif; ?>
      
    </div>
  </div>


  <?php include_once 'views/layouts/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>