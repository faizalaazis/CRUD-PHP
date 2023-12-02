<?php
  // periksa apakah user sudah login, cek kehadiran session name
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: Login.php");
  }

  // buka koneksi dengan MySQL
  include("Connection.php");

  // cek apakah form telah di submit (untuk menghapus data)
  if (isset($_POST["submit"])) {
    // form telah disubmit, proses data

    // ambil nilai nim
    $ID = htmlentities(strip_tags(trim($_POST["ID"])));
    // filter data
    $ID = mysqli_real_escape_string($link,$ID);

    //jalankan query DELETE
    $query = "DELETE FROM master WHERE ID='$ID' ";
    $hasil_query = mysqli_query($link, $query);

    //periksa query, tampilkan pesan kesalahan jika gagal
    if($hasil_query) {
      // DELETE berhasil, redirect ke tampil_mahasiswa.php + pesan
        $pesan = "Penerima dengan ID = \"<b>$ID</b>\" sudah berhasil di hapus";
      $pesan = urlencode($pesan);
        header("Location: Tampil_Penerima.php?pesan={$pesan}");
    }
    else {
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
    }
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Penerima Mahasiswa Bidikmisi</title>
  <link href="Style.css" rel="stylesheet" >
  <link rel="icon" href="favicon.png" type="image/png" >
</head>
<body>
<div class="container">
<div id="header">
  <h1 id="logo">Data Penerima <span>BIDIKMISI</span></h1>
  <p id="tanggal"><?php echo date("d M Y"); ?></p>
</div>
<hr>
  <nav>
  <ul>
    <li><a href="Tampil_Penerima.php">Tampil</a></li>
    <li><a href="Tambah_Penerima.php">Tambah</a>
    <li><a href="Edit_Penerima.php">Edit</a>
    <li><a href="Hapus_Penerima.php">Hapus</a></li>
    <li><a href="Logout.php">Logout</a>
  </ul>
  </nav>
 
<h2>Hapus Data Mahasiswa</h2>
<?php
  // tampilkan pesan jika ada
  if ((isset($_GET["pesan"]))) {
      echo "<div class=\"pesan\">{$_GET["pesan"]}</div>";
  }
?>
 <table border="1">
   <tr>
   <th>ID</th>
   <th>Nama Lengkap</th>
   <th>Jenis Kelamin</th>
   <th>Tempat Lahir</th>
   <th>Tanggal Lahir</th>
   <th>Alamat</th>
   <th>Provinsi</th>
   <th>Kabupaten</th>
   <th>Kecamatan</th>
   <th>Kode Pos</th>
   <th>No HP</th>
   <th>Email</th>
   <th></th>
   </tr>
  <?php
  // buat query untuk menampilkan seluruh data tabel mahasiswa
  $query = "SELECT * FROM master ORDER BY Nama_Lengkap ASC";
  $result = mysqli_query($link, $query);

  if(!$result){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }

  //buat perulangan untuk element tabel dari data mahasiswa
  while($data = mysqli_fetch_assoc($result))
  {
    echo "<tr>";
    echo "<td>$data[ID]</td>";
    echo "<td>$data[Nama_Lengkap]</td>";
    echo "<td>$data[Jenis_Kelamin]</td>";
    echo "<td>$data[Tempat_Lahir]</td>";
    echo "<td>$data[Tanggal_Lahir]</td>";
    echo "<td>$data[Alamat]</td>";
    echo "<td>$data[Provinsi]</td>";
    echo "<td>$data[Kabupaten]</td>";
    echo "<td>$data[Kecamatan]</td>";
    echo "<td>$data[Kode_Pos]</td>";
    echo "<td>$data[No_HP]</td>";
    echo "<td>$data[Email]</td>";
    echo "<td>";
    ?>
      <form action="Hapus_Penerima.php" method="post" >
      <input type="hidden" name="ID" value="<?php echo "$data[ID]"; ?>" >
      <input type="submit" name="submit" value="Hapus" >
      </form>
    <?php
    echo "</td>";
    echo "</tr>";
  }

  // bebaskan memory
  mysqli_free_result($result);

  // tutup koneksi dengan database mysql
  mysqli_close($link);
  ?>
  </table>
  
</div>
</body>
</html>
