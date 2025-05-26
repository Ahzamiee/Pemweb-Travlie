<?php
session_start();

if (!isset($_SESSION['fullname'])) {
    $_SESSION['error'] = "Silakan login terlebih dahulu.";
    header('Location: login.php');
    exit();
}
?>



<!doctype html>
<html lang="en">
<head>
  <title>Account Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@200..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/style-profile.css">  
</head>  

<body>
<?php include_once('layout/header.php'); ?>

<main>
  <div class="container mt-4">
    <div class="row justify-content-center">
      
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white fw-bold">
            Informasi Pengguna
          </div>
          <div class="card-body">
            <p><strong>Nama:</strong> <?= htmlspecialchars($_SESSION['fullname']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
            <p><strong>Nomor Telepon:</strong> 08123456789</p>
          </div>
        </div>
      </div>

      <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-dark text-white fw-bold">
            Pengaturan Akun
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="#">Ubah Profil</a></li>
              <li class="list-group-item"><a href="#">Ganti Password</a></li>
              <li class="list-group-item"><a href="#">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-10 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-warning text-dark fw-bold">
            Wishlist Destinasi
          </div>
          <div class="card-body">
            <p>Berikut adalah daftar destinasi yang ingin Anda kunjungi:</p>
            <ul class="list-group mb-3" id="wishlist">
              <?php foreach ($wishlist as $item): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                  <i class="fa-solid fa-heart text-danger me-2"></i>
                  <?= htmlspecialchars($item['destination']) ?>
                </span>
                <form method="post" action="hapus-wishlist.php" style="margin:0;">
                  <input type="hidden" name="id" value="<?= $item['id'] ?>">
                  <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              </li>
              <?php endforeach; ?>
            </ul>
            <form method="post" action="tambah-wishlist.php" class="input-group">
              <input type="text" name="destination" class="form-control" placeholder="Tambahkan destinasi baru..." required>
              <button class="btn btn-outline-primary" type="submit">Tambah</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>

<?php include_once 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  </body>
</html> 