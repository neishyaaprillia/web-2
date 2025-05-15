<?php
session_start();

// Data dummy - bisa diganti dengan data dari database
if (!isset($_SESSION['jenis_kegiatan'])) {
    $_SESSION['jenis_kegiatan'] = [
        [
            'id' => 'JK001',
            'nama' => 'Seminar'
        ],
        [
            'id' => 'JK002',
            'nama' => 'Workshop'
        ]
    ];
}

// Jika form disubmit (POST), tambahkan data ke array jenis kegiatan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'] ?? '';
    $nama = $_POST['nama'] ?? '';

    // Tambahkan ke session jenis kegiatan
    $_SESSION['jenis_kegiatan'][] = [
        'id' => $id,
        'nama' => $nama
    ];
}

// Menghapus data jenis kegiatan berdasarkan index
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($_SESSION['jenis_kegiatan'][$index])) {
        unset($_SESSION['jenis_kegiatan'][$index]);
        $_SESSION['jenis_kegiatan'] = array_values($_SESSION['jenis_kegiatan']); // Reset indeks array
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Jenis Kegiatan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }

    h1 {
      margin-bottom: 20px;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      margin-bottom: 30px;
      max-width: 500px;
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
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
    }

    th, td {
      border: 1px solid #999;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #eee;
    }

    caption {
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 10px;
    }

    a {
      color: red;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <h1>Jenis Kegiatan</h1>

  <!-- Form untuk menambah data jenis kegiatan -->
  <h2>Tambah Jenis Kegiatan</h2>
  <form method="POST">
    <label for="id">ID Kegiatan:</label>
    <input type="text" id="id" name="id" required>

    <label for="nama">Nama Kegiatan:</label>
    <input type="text" id="nama" name="nama" required>

    <button type="submit">Tambah</button>
  </form>

  <!-- Tabel data jenis kegiatan -->
  <table>
    <caption>Daftar Jenis Kegiatan</caption>
    <thead>
      <tr>
        <th>No</th>
        <th>ID</th>
        <th>Nama</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($_SESSION['jenis_kegiatan'] as $index => $item): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($item['id']) ?></td>
          <td><?= htmlspecialchars($item['nama']) ?></td>
          <td>
            <a href="?hapus=<?= $index ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>
</html>
