<?php
session_start();

// Inisialisasi array jika belum ada data kegiatan
if (!isset($_SESSION['kegiatan'])) {
    $_SESSION['kegiatan'] = [];
}

// Proses penghapusan data
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($_SESSION['kegiatan'][$index])) {
        unset($_SESSION['kegiatan'][$index]);
        $_SESSION['kegiatan'] = array_values($_SESSION['kegiatan']); // reset index array
    }
}

// Jika form dikirim, simpan data ke session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $tempat = $_POST['tempat'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_kegiatan = $_POST['jenis_kegiatan'];

    $_SESSION['kegiatan'][] = [
        'id' => $id,
        'tanggal_mulai' => $tanggal_mulai,
        'tanggal_selesai' => $tanggal_selesai,
        'tempat' => $tempat,
        'deskripsi' => $deskripsi,
        'jenis_kegiatan' => $jenis_kegiatan
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Kegiatan</title>
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

    input, textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #007bff;
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
      background-color: #f2f2f2;
    }

    caption {
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .btn-hapus {
      background-color: #dc3545;
      color: white;
      padding: 5px 10px;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>

  <h1>Data Kegiatan</h1>

  <h2>Tambah Kegiatan</h2>
  <form method="POST">
    <label for="id">ID Kegiatan:</label>
    <input type="text" name="id" id="id" required>

    <label for="tanggal_mulai">Tanggal Mulai:</label>
    <input type="date" name="tanggal_mulai" id="tanggal_mulai" required>

    <label for="tanggal_selesai">Tanggal Selesai:</label>
    <input type="date" name="tanggal_selesai" id="tanggal_selesai" required>

    <label for="tempat">Tempat:</label>
    <input type="text" name="tempat" id="tempat" required>

    <label for="deskripsi">Deskripsi:</label>
    <textarea name="deskripsi" id="deskripsi" rows="3" required></textarea>

    <label for="jenis_kegiatan">Jenis Kegiatan:</label>
    <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" required>

    <button type="submit">Tambah</button>
  </form>

  <table>
    <caption>Daftar Kegiatan</caption>
    <thead>
      <tr>
        <th>No</th>
        <th>ID</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Tempat</th>
        <th>Deskripsi</th>
        <th>Jenis Kegiatan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($_SESSION['kegiatan'] as $index => $k) {
          echo "<tr>
                  <td>{$no}</td>
                  <td>{$k['id']}</td>
                  <td>{$k['tanggal_mulai']}</td>
                  <td>{$k['tanggal_selesai']}</td>
                  <td>{$k['tempat']}</td>
                  <td>{$k['deskripsi']}</td>
                  <td>{$k['jenis_kegiatan']}</td>
                  <td><a class='btn-hapus' href='?hapus={$index}' onclick='return confirm(\"Yakin ingin menghapus kegiatan ini?\")'>Hapus</a></td>
                </tr>";
          $no++;
      }
      ?>
    </tbody>
  </table>

</body>
</html>
