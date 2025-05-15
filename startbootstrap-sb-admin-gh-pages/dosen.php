<?php
session_start();

// Inisialisasi data jika belum ada
if (!isset($_SESSION['dosen'])) {
    $_SESSION['dosen'] = [];
}

// Proses penghapusan data
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    if (isset($_SESSION['dosen'][$index])) {
        unset($_SESSION['dosen'][$index]);
        $_SESSION['dosen'] = array_values($_SESSION['dosen']); // reset index array
    }
}

// Proses jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $_POST['id'],
        'nidn' => $_POST['nidn'],
        'nama' => $_POST['nama'],
        'gelar_belakang' => $_POST['gelar_belakang'],
        'gelar_depan' => $_POST['gelar_depan'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'tempat_lahir' => $_POST['tempat_lahir'],
        'tanggal_lahir' => $_POST['tanggal_lahir'],
        'alamat' => $_POST['alamat'],
        'email' => $_POST['email'],
        'tahun_masuk' => $_POST['tahun_masuk'],
        'prodi_id' => $_POST['prodi_id']
    ];

    $_SESSION['dosen'][] = $data;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tabel Dosen</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #999; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    caption { font-size: 1.5em; margin-bottom: 10px; }
    form {
      background: #f9f9f9; padding: 15px; border-radius: 10px;
      box-shadow: 0 0 5px #ccc; max-width: 800px;
    }
    input, select {
      padding: 5px; margin-bottom: 10px; width: 100%;
    }
    label { font-weight: bold; }
    button {
      padding: 8px 15px; background-color: #007bff;
      color: white; border: none; border-radius: 5px; cursor: pointer;
    }
    .btn-hapus {
      background-color: #dc3545; color: white;
      padding: 5px 10px; text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<h1>Data Dosen</h1>

<form method="POST">
  <label>ID:</label><input type="text" name="id" required>
  <label>NIDN:</label><input type="text" name="nidn" required>
  <label>Nama:</label><input type="text" name="nama" required>
  <label>Gelar Belakang:</label><input type="text" name="gelar_belakang">
  <label>Gelar Depan:</label><input type="text" name="gelar_depan">
  <label>Jenis Kelamin:</label>
  <select name="jenis_kelamin" required>
    <option value="Laki-laki">Laki-laki</option>
    <option value="Perempuan">Perempuan</option>
  </select>
  <label>Tempat Lahir:</label><input type="text" name="tempat_lahir">
  <label>Tanggal Lahir:</label><input type="date" name="tanggal_lahir">
  <label>Alamat:</label><input type="text" name="alamat">
  <label>Email:</label><input type="email" name="email">
  <label>Tahun Masuk:</label><input type="number" name="tahun_masuk">
  <label>Prodi ID:</label><input type="text" name="prodi_id">
  <button type="submit">Simpan</button>
</form>

<table>
  <caption>Daftar Dosen</caption>
  <thead>
    <tr>
      <th>No</th>
      <th>ID</th>
      <th>NIDN</th>
      <th>Nama</th>
      <th>Gelar Belakang</th>
      <th>Gelar Depan</th>
      <th>Jenis Kelamin</th>
      <th>Tempat Lahir</th>
      <th>Tanggal Lahir</th>
      <th>Alamat</th>
      <th>Email</th>
      <th>Tahun Masuk</th>
      <th>Prodi ID</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach ($_SESSION['dosen'] as $index => $dosen) {
        echo "<tr>
          <td>{$no}</td>
          <td>{$dosen['id']}</td>
          <td>{$dosen['nidn']}</td>
          <td>{$dosen['nama']}</td>
          <td>{$dosen['gelar_belakang']}</td>
          <td>{$dosen['gelar_depan']}</td>
          <td>{$dosen['jenis_kelamin']}</td>
          <td>{$dosen['tempat_lahir']}</td>
          <td>{$dosen['tanggal_lahir']}</td>
          <td>{$dosen['alamat']}</td>
          <td>{$dosen['email']}</td>
          <td>{$dosen['tahun_masuk']}</td>
          <td>{$dosen['prodi_id']}</td>
          <td><a class='btn-hapus' href='?hapus={$index}' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a></td>
        </tr>";
        $no++;
    }
    ?>
  </tbody>
</table>

</body>
</html>
