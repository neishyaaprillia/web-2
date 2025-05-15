<?php
session_start();

// Inisialisasi array jika belum ada data
if (!isset($_SESSION['penelitian'])) {
    $_SESSION['penelitian'] = [];
}

// Menyimpan data jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $mulai = $_POST['mulai'];
    $akhir = $_POST['akhir'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $bidang_ilmu_id = $_POST['bidang_ilmu_id'];

    $_SESSION['penelitian'][] = [
        'id' => $id,
        'judul' => $judul,
        'mulai' => $mulai,
        'akhir' => $akhir,
        'tahun_ajaran' => $tahun_ajaran,
        'bidang_ilmu_id' => $bidang_ilmu_id
    ];
}

// Proses hapus data
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($_SESSION['penelitian'][$index])) {
        unset($_SESSION['penelitian'][$index]);
        $_SESSION['penelitian'] = array_values($_SESSION['penelitian']); // reset indeks
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Penelitian</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }

    h1, h2 {
      margin-top: 0;
    }

    form {
      margin-bottom: 30px;
      background-color: #f4f4f4;
      padding: 15px;
      border-radius: 10px;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #999;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #eaeaea;
    }

    caption {
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <h1>Data Penelitian</h1>

  <h2>Form Tambah Penelitian</h2>
  <form method="post">
    <label for="id">ID Penelitian:</label>
    <input type="text" name="id" id="id" required>

    <label for="judul">Judul:</label>
    <input type="text" name="judul" id="judul" required>

    <label for="mulai">Tanggal Mulai:</label>
    <input type="date" name="mulai" id="mulai" required>

    <label for="akhir">Tanggal Akhir:</label>
    <input type="date" name="akhir" id="akhir" required>

    <label for="tahun_ajaran">Tahun Ajaran:</label>
    <input type="text" name="tahun_ajaran" id="tahun_ajaran" placeholder="Contoh: 2024/2025" required>

    <label for="bidang_ilmu_id">Bidang Ilmu ID:</label>
    <input type="text" name="bidang_ilmu_id" id="bidang_ilmu_id" required>

    <button type="submit">Tambah</button>
  </form>

  <table>
    <caption>Daftar Penelitian</caption>
    <thead>
      <tr>
        <th>No</th>
        <th>ID</th>
        <th>Judul</th>
        <th>Mulai</th>
        <th>Akhir</th>
        <th>Tahun Ajaran</th>
        <th>Bidang Ilmu ID</th>
        <th>Aksi</th> <!-- Kolom aksi -->
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($_SESSION['penelitian'] as $index => $penelitian) {
          echo "<tr>
                  <td>{$no}</td>
                  <td>{$penelitian['id']}</td>
                  <td>{$penelitian['judul']}</td>
                  <td>{$penelitian['mulai']}</td>
                  <td>{$penelitian['akhir']}</td>
                  <td>{$penelitian['tahun_ajaran']}</td>
                  <td>{$penelitian['bidang_ilmu_id']}</td>
                  <td><a href='?hapus={$index}' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' style='color:red;'>Hapus</a></td>
                </tr>";
          $no++;
      }
      ?>
    </tbody>
  </table>

</body>
</html>
