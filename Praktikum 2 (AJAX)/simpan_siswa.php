<?php
header("Content-Type: application/json");
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $kode_siswa = trim($_POST['kode_siswa'] ?? '');
    $nama_siswa = trim($_POST['nama_siswa'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $kota       = trim($_POST['kota'] ?? '');
    $kecamatan  = trim($_POST['kecamatan'] ?? '');
    $kelurahan  = trim($_POST['kelurahan'] ?? '');

    if (empty($kode_siswa) || empty($nama_siswa) || empty($alamat) || empty($kota) || empty($kecamatan) || empty($kelurahan)) {
        echo json_encode([
            "status" => "error",
            "message" => "Semua field wajib diisi!"
        ]);
        exit;
    }

    $stmt = $koneksi->prepare("INSERT INTO siswa (kode_siswa, nama_siswa, alamat, kota, kecamatan, kelurahan) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode([
            "status" => "error",
            "message" => "Prepare statement gagal: " . $koneksi->error
        ]);
        exit;
    }

    $stmt->bind_param("ssssss", $kode_siswa, $nama_siswa, $alamat, $kota, $kecamatan, $kelurahan);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Data siswa berhasil disimpan ke database!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menyimpan data: " . $stmt->error
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Metode request tidak valid!"
    ]);
}
?>
