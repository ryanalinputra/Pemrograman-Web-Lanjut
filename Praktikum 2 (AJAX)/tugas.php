<?php
session_start();
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $kode_siswa = trim($_POST['kode_siswa'] ?? '');
    $nama_siswa = trim($_POST['nama_siswa'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $kota       = trim($_POST['nama_kota'] ?? '');
    $kecamatan  = trim($_POST['nama_kecamatan'] ?? '');
    $kelurahan  = trim($_POST['nama_kelurahan'] ?? '');

    if (!empty($kode_siswa) && !empty($nama_siswa) && !empty($alamat) && !empty($kota) && !empty($kecamatan) && !empty($kelurahan)) {
        $stmt = $koneksi->prepare("INSERT INTO siswa (kode_siswa, nama_siswa, alamat, kota, kecamatan, kelurahan) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssssss", $kode_siswa, $nama_siswa, $alamat, $kota, $kecamatan, $kelurahan);
            if ($stmt->execute()) {
                $_SESSION['status'] = "success";
                $_SESSION['pesan'] = "Data siswa berhasil disimpan ke database!";
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['pesan'] = "Gagal menyimpan data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['pesan'] = "Gagal menyiapkan query: " . $koneksi->error;
        }
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['pesan'] = "Semua field (termasuk Kota, Kecamatan, dan Kelurahan) wajib diisi!";
    }

    header("Location: tugas.php");
    exit;
}

$pesan = $_SESSION['pesan'] ?? "";
$status = $_SESSION['status'] ?? "";
unset($_SESSION['pesan'], $_SESSION['status']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Input Data Siswa</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 40px 20px;
            color: #222;
        }

        .container {
            width: 820px;
            max-width: 100%;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            display: block;
            font-size: 13px;
            margin-bottom: 5px;
            color: #222;
        }

        input[type="text"], select {
            width: 100%;
            height: 36px;
            padding: 6px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 13.5px;
            outline: none;
            background: #fff;
        }

        input[type="text"]::placeholder, textarea::placeholder {
            color: #6c757d;
            font-size: 13px;
        }

        .alamat-wrapper {
            padding-left: 36px;
            margin-bottom: 8px;
        }

        textarea {
            width: 380px;
            height: 220px;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 2px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            resize: both;
            display: block;
        }

        .btn-submit {
            display: inline-block;
            margin-top: 20px;
            padding: 9px 24px;
            background-color: #2563eb;
            color: #ffffff;
            font-size: 14px;
            font-weight: 500;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        .alert {
            padding: 10px 14px;
            margin-bottom: 16px;
            border-radius: 4px;
            font-size: 13.5px;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Input Data</h2>

        <?php if (!empty($pesan)): ?>
            <div id="alertMessage" class="alert <?= $status === 'success' ? 'alert-success' : 'alert-error' ?>">
                <?= htmlspecialchars($pesan) ?>
            </div>
        <?php endif; ?>

        <form id="formSiswa" method="POST" action="tugas.php">
            <input type="hidden" name="nama_kota" id="nama_kota">
            <input type="hidden" name="nama_kecamatan" id="nama_kecamatan">
            <input type="hidden" name="nama_kelurahan" id="nama_kelurahan">

            <div class="form-group">
                <label for="kode_siswa">Kode Siswa</label>
                <input type="text" id="kode_siswa" name="kode_siswa" placeholder="Masukkan kode siswa" required>
            </div>

            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" id="nama_siswa" name="nama_siswa" placeholder="Masukkan nama siswa" required>
            </div>

            <div class="alamat-wrapper">
                <textarea id="alamat" name="alamat" placeholder="Silakan isi alamat" required></textarea>
            </div>

            <div class="form-group">
                <label for="alamat_text" style="margin-top: -4px;">Alamat</label>
                <label for="kota">Kota</label>
                <select id="kota" name="kota" required>
                    <option value="">-- Pilih Kota --</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <select id="kecamatan" name="kecamatan" required>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kelurahan">Kelurahan</label>
                <select id="kelurahan" name="kelurahan" required>
                    <option value="">-- Pilih Kelurahan --</option>
                </select>
            </div>

            <button type="submit" id="btnSimpan" class="btn-submit">Input Data</button>
        </form>
    </div>

    <script>
        fetch("getKota.php?id=35")
            .then(response => response.json())
            .then(data => {

                let kota = document.getElementById("kota");

                kota.innerHTML =
                    "<option value=''>-- Pilih Kota --</option>";

                data.forEach(function(item) {

                    kota.innerHTML +=
                        `<option value="${item.id}">
  ${item.name}
  </option>`;

                });

            });

        document.getElementById("kota")
            .addEventListener("change", function() {

                let idKota = this.value;

                resetKecamatan();
                resetKelurahan();

                if (idKota == "") return;

                fetch("getKecamatan.php?id=" + idKota)
                    .then(response => response.json())
                    .then(data => {

                        let kecamatan = document.getElementById("kecamatan");

                        kecamatan.innerHTML =
                            "<option value=''>-- Pilih Kecamatan --</option>";

                        data.forEach(function(item) {

                            kecamatan.innerHTML +=
                                `<option value="${item.id}">
  ${item.name}
  </option>`;

                        });

                    });

            });

        function resetKecamatan() {
            let kecamatan = document.getElementById("kecamatan");
            if (kecamatan) {
                kecamatan.innerHTML = "<option value=''>-- Pilih Kecamatan --</option>";
            }
        }

        function resetKelurahan() {
            let kelurahan = document.getElementById("kelurahan");
            if (kelurahan) {
                kelurahan.innerHTML = "<option value=''>-- Pilih Kelurahan --</option>";
            }
        }

        document.getElementById("kecamatan")
            .addEventListener("change", function() {

                let idKecamatan = this.value;

                resetKelurahan();

                if (idKecamatan == "") return;

                fetch("getKelurahan.php?id=" + idKecamatan)
                    .then(response => response.json())
                    .then(data => {

                        let kelurahan = document.getElementById("kelurahan");

                        kelurahan.innerHTML =
                            "<option value=''>-- Pilih Kelurahan --</option>";

                        data.forEach(function(item) {

                            kelurahan.innerHTML +=
                                `<option value="${item.id}">
  ${item.name}
  </option>`;

                        });

                    });

            });

        document.getElementById("formSiswa")
            .addEventListener("submit", function(e) {

                let kota = document.getElementById("kota");
                let kecamatan = document.getElementById("kecamatan");
                let kelurahan = document.getElementById("kelurahan");

                if (kota.selectedIndex > 0) {
                    document.getElementById("nama_kota").value =
                        kota.selectedOptions[0].text;
                }

                if (kecamatan.selectedIndex > 0) {
                    document.getElementById("nama_kecamatan").value =
                        kecamatan.selectedOptions[0].text;
                }

                if (kelurahan.selectedIndex > 0) {
                    document.getElementById("nama_kelurahan").value =
                        kelurahan.selectedOptions[0].text;
                }

            });

        let alertBox = document.getElementById("alertMessage");
        if (alertBox) {
            setTimeout(function() {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = "0";
                setTimeout(function() {
                    alertBox.remove();
                }, 500);
            }, 3000);
        }
    </script>
</body>
</html>