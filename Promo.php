<?php

class Promo extends Model {

    public function getActivePromos() {
        $conn = $this->getDbConnection(); // Dapatkan koneksi
        $today = date("Y-m-d"); // Tanggal hari ini

        // Query dengan placeholder (?) untuk prepared statement
        $sql = "SELECT promo_id, title, description, image_url, category
                FROM promos
                WHERE status = 'Active'
                AND start_date <= ?
                AND end_date >= ?
                ORDER BY end_date ASC"; // Urutkan (misal: yg mau habis duluan)

        $promos = [];

        // Siapkan statement
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
             die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("ss", $today, $today);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $promos[] = $row;
            }
        }
        $stmt->close();

        return $promos;
    }

    // Anda bisa tambahkan method lain di sini jika perlu
    // public function getPromoDetail($id) { ... }
}
