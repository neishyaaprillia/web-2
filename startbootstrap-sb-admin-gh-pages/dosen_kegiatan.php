<?php
session_start();

// Inisialisasi jika belum ada data
if (!isset($_SESSION['dosen_kegiatan'])) {
    $_SESSION['dosen_kegiatan'] = [];
}

// Tangani pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dosen_id = $_POST['dosen_id'];
    $kegiatan_id = $_POST['kegiatan_id'];

    // Tambahkan ke data sesi
    $_SESSION['dosen_kegiatan'][] = [
        'dosen_id' => $dosen_id,
        'kegiatan_id' => $kegiatan_id
    ];
}

// Menangani aksi hapus berdasarkan index
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($_SESSION['dosen_kegiatan'][$index])) {
        unset($_SESSION['dosen_kegiatan'][$index]);
        $_SESSION['dosen_kegiatan'] = array_values($_SESSION['dosen_kegiatan']); // Reset index array
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dosen Kegiatan</title>
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
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 500px;
      margin-bottom: 30px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 10px;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
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
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    caption {
      font-size: 1.3em;
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

  <h1>Relasi Dosen & Kegiatan</h1>

  <form method="POST">
    <label for="dosen_id">ID Dosen:</label>
    <input type="text" name="dosen_id" id="dosen_id" required>

    <label for="kegiatan_id">ID Kegiatan:</label>
    <input type="text" name="kegiatan_id" id="kegiatan_id" required>

    <button type="submit">Tambah</button>
  </form>

  <table>
    <caption>Daftar Dosen Kegiatan</caption>
    <thead>
      <tr>
        <th>No</th>
        <th>ID Dosen</th>
        <th>ID Kegiatan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($_SESSION['dosen_kegiatan'] as $index => $item) {
          echo "<tr>
                  <td>{$no}</td>
                  <td>{$item['dosen_id']}</td>
                  <td>{$item['kegiatan_id']}</td>
                  <td><a href='?hapus={$index}' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a></td>
                </tr>";
          $no++;
      }
      ?>
    </tbody>
  </table>

</body>
</html>
