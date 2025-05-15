<?php
session_start();

// Contoh data prodi disimpan dalam session agar data tidak hilang
if (!isset($_SESSION['prodi'])) {
    $_SESSION['prodi'] = [
        [
            'id' => 'PR001',
            'nama' => 'Teknik Informatika',
            'alamat' => 'Jl. Teknologi No. 10',
            'telepon' => '08123456789',
            'ketua' => 'Dr. Budi Santoso'
        ],
        [
            'id' => 'PR002',
            'nama' => 'Sistem Informasi',
            'alamat' => 'Jl. Data No. 15',
            'telepon' => '08234567890',
            'ketua' => 'Dr. Siti Aminah'
        ],
    ];
}

// Menambahkan data prodi baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $newProdi = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
        'telepon' => $_POST['telepon'],
        'ketua' => $_POST['ketua']
    ];
    $_SESSION['prodi'][] = $newProdi;
}

// Menghapus data prodi
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($_SESSION['prodi'][$index])) {
        unset($_SESSION['prodi'][$index]);
        $_SESSION['prodi'] = array_values($_SESSION['prodi']); // reset indeks array
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Program Studi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
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
    form {
      margin-bottom: 20px;
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
  </style>
</head>
<body>

  <h1>Data Program Studi</h1>

  <!-- Form untuk menambah data prodi -->
  <h2>Tambah Program Studi</h2>
  <form method="POST">
    <label for="id">ID Prodi:</label>
    <input type="text" name="id" id="id" required>

    <label for="nama">Nama Prodi:</label>
    <input type="text" name="nama" id="nama" required>

    <label for="alamat">Alamat:</label>
    <input type="text" name="alamat" id="alamat" required>

    <label for="telepon">Telepon:</label>
    <input type="text" name="telepon" id="telepon" required>

    <label for="ketua">Ketua:</label>
    <input type="text" name="ketua" id="ketua" required>

    <button type="submit">Tambah Data</button>
  </form>

  <!-- Tabel data prodi -->
  <table>
    <caption>Daftar Program Studi</caption>
    <thead>
      <tr>
        <th>No</th>
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Ketua</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($_SESSION['prodi'] as $index => $p) {
          echo "<tr>
                  <td>{$no}</td>
                  <td>{$p['id']}</td>
                  <td>{$p['nama']}</td>
                  <td>{$p['alamat']}</td>
                  <td>{$p['telepon']}</td>
                  <td>{$p['ketua']}</td>
                  <td><a href='?hapus={$index}' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' style='color:red;'>Hapus</a></td>
                </tr>";
          $no++;
      }
      ?>
    </tbody>
  </table>

</body>
</html>
