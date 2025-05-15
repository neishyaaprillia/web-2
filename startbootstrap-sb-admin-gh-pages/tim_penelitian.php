<?php
session_start();

// Data tim penelitian disimpan dalam session agar data tetap ada antara refresh halaman
if (!isset($_SESSION['tim_penelitian'])) {
    $_SESSION['tim_penelitian'] = [
        [
            'dosen_id' => 'DS001',
            'penelitian_id' => 'PN001',
            'peran' => 'Ketua'
        ],
        [
            'dosen_id' => 'DS002',
            'penelitian_id' => 'PN001',
            'peran' => 'Anggota'
        ]
    ];
}

// Jika form disubmit (POST), tambahkan data ke array tim penelitian
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dosen_id'])) {
    $dosen_id = $_POST['dosen_id'] ?? '';
    $penelitian_id = $_POST['penelitian_id'] ?? '';
    $peran = $_POST['peran'] ?? '';

    // Tambahkan ke session tim penelitian
    $_SESSION['tim_penelitian'][] = [
        'dosen_id' => $dosen_id,
        'penelitian_id' => $penelitian_id,
        'peran' => $peran
    ];
}

// Menghapus data tim penelitian berdasarkan index
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($_SESSION['tim_penelitian'][$index])) {
        unset($_SESSION['tim_penelitian'][$index]);
        $_SESSION['tim_penelitian'] = array_values($_SESSION['tim_penelitian']); // Reset indeks array
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tim Penelitian</title>
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

  <h1>Tim Penelitian</h1>

  <!-- Form untuk menambah data tim penelitian -->
  <h2>Tambah Tim Penelitian</h2>
  <form method="POST">
    <label for="dosen_id">Dosen ID:</label>
    <input type="text" id="dosen_id" name="dosen_id" required>

    <label for="penelitian_id">Penelitian ID:</label>
    <input type="text" id="penelitian_id" name="penelitian_id" required>

    <label for="peran">Peran:</label>
    <input type="text" id="peran" name="peran" required>

    <button type="submit">Tambah</button>
  </form>

  <!-- Tabel data tim penelitian -->
  <table>
    <caption>Daftar Tim Penelitian</caption>
    <thead>
      <tr>
        <th>No</th>
        <th>Dosen ID</th>
        <th>Penelitian ID</th>
        <th>Peran</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($_SESSION['tim_penelitian'] as $index => $item): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($item['dosen_id']) ?></td>
          <td><?= htmlspecialchars($item['penelitian_id']) ?></td>
          <td><?= htmlspecialchars($item['peran']) ?></td>
          <td>
            <a href="?hapus=<?= $index ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</body>
</html>
