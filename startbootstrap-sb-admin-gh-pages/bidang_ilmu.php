<?php
session_start();

// Inisialisasi array data bidang ilmu jika belum ada
if (!isset($_SESSION['bidang_ilmu'])) {
    $_SESSION['bidang_ilmu'] = [];
}

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    // Tambahkan ke session
    $_SESSION['bidang_ilmu'][] = [
        'id' => $id,
        'nama' => $nama,
        'deskripsi' => $deskripsi
    ];
}

// Proses hapus data
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($_SESSION['bidang_ilmu'][$index])) {
        unset($_SESSION['bidang_ilmu'][$index]);
        $_SESSION['bidang_ilmu'] = array_values($_SESSION['bidang_ilmu']); // reset indeks array
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Bidang Ilmu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f2f2f2;
    }

    h1 {
      margin-bottom: 20px;
    }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    input[type="text"], textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    textarea {
      resize: vertical;
      height: 60px;
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
      background-color: #e0e0e0;
    }

    caption {
      font-size: 1.3em;
      margin-bottom: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <h1>Data Bidang Ilmu</h1>

  <form method="POST">
    <label for="id">ID Bidang Ilmu:</label>
    <input type="text" name="id" id="id" required>

    <label for="nama">Nama Bidang Ilmu:</label>
    <input type="text" name="nama" id="nama" required>

    <label for="deskripsi">Deskripsi:</label>
    <textarea name="deskripsi" id="deskripsi" required></textarea>

    <button type="submit">Tambah Data</button>
  </form>

  <table>
    <caption>Daftar Bidang Ilmu</caption>
    <thead>
      <tr>
        <th>No</th>
        <th>ID</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Aksi</th> <!-- Kolom Aksi -->
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($_SESSION['bidang_ilmu'] as $index => $data) {
          echo "<tr>
                  <td>{$no}</td>
                  <td>{$data['id']}</td>
                  <td>{$data['nama']}</td>
                  <td>{$data['deskripsi']}</td>
                  <td><a href='?hapus={$index}' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' style='color:red;'>Hapus</a></td>
                </tr>";
          $no++;
      }
      ?>
    </tbody>
  </table>

</body>
</html>
