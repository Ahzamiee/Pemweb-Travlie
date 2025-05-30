<?php

class PromoController extends Controller {

    public function index() {
        // Muat model 'Promo'
        $promoModel = $this->loadModel('Promo');

        // Panggil metode untuk mendapatkan SEMUA promo aktif
        // Kita panggil getActivePromos() tanpa parameter, atau
        // jika methodnya butuh parameter, kita kirim 'All'.
        // Pastikan getActivePromos bisa handle 'All' untuk ambil semua.
        $promos = $promoModel->getActivePromos('All'); // Ambil semua promo aktif

        // Siapkan data yang akan dikirim ke view
        $data = [
            'promos'         => $promos,
            // 'activeCategory' tidak terlalu penting lagi untuk PHP,
            // tapi bisa dipakai JS untuk set 'active' awal.
            'activeCategory' => 'All',
            'pageTitle'      => 'Lihat Promo Menarik!'
        ];

        // Muat view 'dashboard/promo.php' dan kirim data
        $this->loadView('dashboard/promo', $data);
    }
}