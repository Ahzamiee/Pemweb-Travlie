<?php

class PromoController extends Controller {

  public function index() {
    $promoModel = $this->loadModel('Promo');

    $category = $_GET['category'] ?? 'All';
    $allowedCategories = ['All', 'Flight', 'Accommodation', 'Vehicle Rent'];
    if (!in_array($category, $allowedCategories)) {
        $category = 'All';
    }

    $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
    $limit = 6;
    $offset = ($page - 1) * $limit;

    $promos = $promoModel->getActivePromos($category, $limit, $offset);
    $totalPromos = $promoModel->countActivePromos($category);
    $totalPages = ceil($totalPromos / $limit);

    $this->loadView('dashboard/promo', [
        'promos' => $promos,
        'activeCategory' => $category,
        'pageTitle' => 'Promo | Travlie',
        'currentPage' => $page,
        'totalPages' => $totalPages
    ]);
  }

  public function checkCode() {
    $promoModel = $this->loadModel('Promo');
    $code = $_POST['promo_code'] ?? '';

    $promo = $promoModel->findByCode($code);

    $message = '';
    $success = false;

    if ($promo) {
        $message = "✅ Promo ditemukan: {$promo->title}";
        $success = true;
    } else {
        $message = "❌ Kode promo tidak valid atau sudah tidak aktif.";
    }

    // Tampilkan kembali halaman promo dengan pesan
    $category = 'All';
    $promos = $promoModel->getActivePromos($category);

    $this->loadView('dashboard/promo', [
        'promos' => $promos,
        'activeCategory' => $category,
        'pageTitle' => 'Promo | Travlie',
        'promoMessage' => $message,
        'promoSuccess' => $success,
        'currentPage' => 1,
        'totalPages' => ceil($promoModel->countActivePromos($category) / 6)
    ]);
  }

  public function delete() {
    $promoModel = $this->loadModel('Promo');
    $promoId = $_GET['id'] ?? null;

    if ($promoId && is_numeric($promoId)) {
        $promoModel->deletePromoById($promoId);
    }

    // Redirect kembali ke halaman utama
    header("Location: index.php?c=promo&m=index");
    exit;
  }
}
