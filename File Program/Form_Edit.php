<?php
  // periksa apakah user sudah login, cek kehadiran session name
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: Login.php");
  }

  // buka koneksi dengan MySQL
  include("Connection.php");

  // cek apakah form telah di submit
  if (isset($_POST["submit"])) {
    // form telah disubmit, cek apakah berasal dari edit_mahasiswa.php
    // atau update data dari form_edit.php

    if ($_POST["submit"]=="Edit") {
      //nilai form berasal dari halaman edit_mahasiswa.php

      // ambil nilai ID
      $ID = htmlentities(strip_tags(trim($_POST["ID"])));
      // filter data
      $ID = mysqli_real_escape_string($link,$ID);

      // ambil semua data dari database untuk menjadi nilai awal form
      $query = "SELECT * FROM master WHERE ID='$ID'";
      $result= mysqli_query($link, $query);

      if(!$result){
        die ("Query Error: ".mysqli_errno($link).
             " - ".mysqli_error($link));
      }

      // tidak perlu pakai perulangan while, karena hanya ada 1 record
      $data = mysqli_fetch_assoc($result);

      $nama_lengkap  = $data["Nama_Lengkap"];
      $jenis_kelamin = $data["Jenis_Kelamin"];
      $tempat_lahir  = $data["Tempat_Lahir"];
      $alamat        = $data["Alamat"];
      $provinsi      = $data["Provinsi"];
      $Kabupaten     = $data["Kabupaten"];
      $kecamatan     = $data["Kecamatan"];
      $kode_pos      = $data["Kode_Pos"];
      $no_hp         = $data["No_HP"];
      $email         = $data["Email"];

      // untuk tanggal harus dipecah
      $tanggal = substr($data["Tanggal_Lahir"],8,2);
      $bulan = substr($data["Tanggal_Lahir"],5,2);
      $tahun = substr($data["Tanggal_Lahir"],0,4);

    // bebaskan memory
    mysqli_free_result($result);
    }

    else if ($_POST["submit"]=="Update Data") {
      // nilai form berasal dari halaman form_edit.php
      // ambil semua nilai form
    $ID                 = htmlentities(strip_tags(trim($_POST["ID"])));
    $nama_lengkap       = htmlentities(strip_tags(trim($_POST["Nama_Lengkap"])));
    $jenis_kelamin      = htmlentities(strip_tags(trim($_POST["Jenis_Kelamin"])));
    $tempat_lahir       = htmlentities(strip_tags(trim($_POST["Tempat_Lahir"])));
    $tanggal            = htmlentities(strip_tags(trim($_POST["Tanggal"])));
    $bulan              = htmlentities(strip_tags(trim($_POST["Bulan"])));
    $tahun              = htmlentities(strip_tags(trim($_POST["Tahun"])));
    $alamat             = htmlentities(strip_tags(trim($_POST["Alamat"])));
    $provinsi           = htmlentities(strip_tags(trim($_POST["Provinsi"])));
    $kabupaten          = htmlentities(strip_tags(trim($_POST["Kabupaten"])));
    $kecamatan          = htmlentities(strip_tags(trim($_POST["Kecamatan"])));
    $kode_pos           = htmlentities(strip_tags(trim($_POST["Kode_Pos"])));
    $no_hp              = htmlentities(strip_tags(trim($_POST["No_HP"])));
    $email              = htmlentities(strip_tags(trim($_POST["Email"])));
    }

    // proses validasi form
    // siapkan variabel untuk menampung pesan error
    $pesan_error="";

    // cek apakah "ID" sudah diisi atau tidak
    if (empty($ID)) {
      $pesan_error .= "ID belum diisi <br>";
    }
    $ID = mysqli_real_escape_string($link,$ID);
    $query = " SELECT * FROM master WHERE ID='$ID'";
    $hasil_query = mysqli_query($link, $query);


    if (empty($nama_lengkap)) {
        $pesan_error .= "Nama belum diisi <br>";
      }
    if (empty($jenis_kelamin)){
        $pesan_error .= "Jenis Kelamin belmum diisi <br>";
    }
    if (empty($tempat_lahir)) {
        $pesan_error .= "Tempat lahir belum diisi <br>";
      }
    if (empty($alamat)) {
        $pesan_error .= "Alamat belum diisi <br>";
      }
    if (empty($provinsi)) {
          $pesan_error .= "Provinsi belum diisi <br>";
        }
    if (empty($kabupaten)) {
          $pesan_error .= "Kabupaten belum diisi <br>";
        }
    if (empty($kecamatan)) {
          $pesan_error .= "kecamatan belum diisi <br>";
        }
    if (empty($kode_pos)) {
          $pesan_error .= "kode pos belum diisi <br>";
        }
    if (empty($no_hp)) {
          $pesan_error .= "No Hp belum diisi <br>";
        }
    if (empty($email)) {
          $pesan_error .= "Email belum diisi <br>";
        }

        $lakilaki=""; $perempuan="";

      switch($jenis_kelamin) {
        case "laki laki" : $lakilaki       = "selected";  break;
        case "perempuan" : $perempuan      = "selected";  break;
      }

    // jika tidak ada error, input ke database
    if (($pesan_error === "") AND ($_POST["submit"]=="Update Data")) {

      // buka koneksi dengan MySQL
      include("Connection.php");

      // filter semua data
      $ID                   = mysqli_real_escape_string($link,$ID);
      $nama_lengkap         = mysqli_real_escape_string($link,$nama_lengkap);
      $jenis_kelamin        = mysqli_real_escape_string($link,$jenis_kelamin);
      $tempat_lahir         = mysqli_real_escape_string($link,$tempat_lahir);
      $tanggal              = mysqli_real_escape_string($link,$tanggal);
      $bulan                = mysqli_real_escape_string($link,$bulan);
      $tahun                = mysqli_real_escape_string($link,$tahun);
      $alamat               = mysqli_real_escape_string($link,$alamat);
      $provinsi             = mysqli_real_escape_string($link,$provinsi);
      $kabupaten            = mysqli_real_escape_string($link,$kabupaten);
      $kecamatan            = mysqli_real_escape_string($link,$kecamatan);
      $kode_pos             = mysqli_real_escape_string($link,$kode_pos);
      $no_hp                = mysqli_real_escape_string($link,$no_hp);
      $email                = mysqli_real_escape_string($link,$email);

      //gabungkan format tanggal agar sesuai dengan date MySQL
      $tanggal_lahir = $tahun."-".$bulan."-".$tanggal;

      //buat dan jalankan query UPDATE
      $query  = "UPDATE master SET ";
      $query .= "Nama_Lengkap  = '$nama_lengkap', Jenis_Kelamin = '$jenis_kelamin', Tempat_Lahir = '$tempat_lahir',";
      $query .= "Tanggal_Lahir = '$tanggal_lahir', Alamat='$alamat', Provinsi='$provinsi', Kabupaten='$kabupaten', ";
      $query .= "Kecamatan = '$kecamatan', Kode_Pos='$kode_pos', No_HP='$no_hp', Email='$email' ";
      $query .= "WHERE ID='$ID'";

      $result = mysqli_query($link, $query);

      //periksa hasil query
      if($result) {
      // INSERT berhasil, redirect ke Tampil_Penerima.php + pesan
        $pesan = "Penerima dengan nama = \"<b>$nama_lengkap</b>\" sudah berhasil di update";
        $pesan = urlencode($pesan);
        header("Location: Tampil_Penerima.php?pesan={$pesan}");
      }
      else {
      die ("Query gagal dijalankan: ".mysqli_errno($link).
           " - ".mysqli_error($link));
      }
    }
  }
  else {
    // form diakses secara langsung!
    // redirect ke Edit_Penerima.php
    header("Location: Edit_Penerima.php");
  }

  // siapkan array untuk nama bulan
  $arr_bulan = array( "1"=>"Januari",
                    "2"=>"Februari",
                    "3"=>"Maret",
                    "4"=>"April",
                    "5"=>"Mei",
                    "6"=>"Juni",
                    "7"=>"Juli",
                    "8"=>"Agustus",
                    "9"=>"September",
                    "10"=>"Oktober",
                    "11"=>"Nopember",
                    "12"=>"Desember" );
?>
<!DOCTYPE html>
<html lang="ID">
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
<h2>Edit Data Mahasiswa</h2>
<?php
  // tampilkan error jika ada
  if ($pesan_error !== "") {
      echo "<div class=\"error\">$pesan_error</div>";
  }
?>
<form id="form_penerima" action="Form_Edit.php" method="post">
<fieldset>
<legend>Penerima Baru</legend>
  <p>
    <label for="ID">ID : </label>
    <input type="text" name="ID" id="ID" value="<?php echo $ID ?>"
    placeholder="Contoh : 10000">
  </p>
  <p>
    <label for="Nama_Lengkap">Nama Lengkap : </label>
    <input type="text" name="Nama_Lengkap" id="Nama_lengkap" value="<?php echo $nama_lengkap ?>">
  </p>
  <p>
    <label for="Jenis Kelamin" >Jenis Kelamin : </label>
      <select name="Jenis_Kelamin" id="Jenis_Kelamin">
        <option value="Laki Laki" <?php echo $lakilaki ?>>
        Laki Laki </option>
        <option value="Perempuan" <?php echo $perempuan ?>>
        perempuan</option>
      </select>
  </p>
  <p>
    <label for="Tempat_Lahir">Tempat Lahir : </label>
    <input type="text" name="Tempat_Lahir" id="Tempat_Lahir" 
    value="<?php echo $tempat_lahir ?>">
  </p>
  <p>
    <label for="Tanggal" >Tanggal Lahir : </label>
      <select name="Tanggal" id="Tanggal">
        <?php
          for ($i = 1; $i <= 31; $i++) {
            if ($i==$tgl){
              echo "<option value = $i selected>";
            }
            else {
              echo "<option value = $i >";
            }
            echo str_pad($i,2,"0",STR_PAD_LEFT);
            echo "</option>";
          }
        ?>
      </select>
        <select name="Bulan">
        <?php
        foreach ($arr_bulan as $key => $value) {
          if ($key==$bulan){
            echo "<option value=\"{$key}\" selected>{$value}</option>";
          }
          else {
            echo "<option value=\"{$key}\">{$value}</option>";
          }
        }
        ?>
      </select>
      <select name="Tahun">
        <?php
          for ($i = 1990; $i <= 2005; $i++) {
          if ($i==$tahun){
              echo "<option value = $i selected>";
            }
            else {
              echo "<option value = $i >";
            }
            echo "$i </option>";
          }
        ?>
      </select>
  </p>
  
  <p>
    <label for="Alamat">Alamat : </label>
    <input type="text" name="Alamat" id="Alamat" value="<?php echo $alamat ?>">
  </p>

  <p>
    <label for="Provinsi">Provinsi : </label>
    <input type="text" name="Provinsi" id="Provinsi" value="<?php echo $provinsi ?>">
  </p>

  <p>
    <label for="Kabupaten">Kabupaten : </label>
    <input type="text" name="Kabupaten" id="Kabupaten" value="<?php echo $kabupaten ?>">
  </p>

  <p>
    <label for="Kecamatan">Kecamatan : </label>
    <input type="text" name="Kecamatan" id="Kecamatan" value="<?php echo $kecamatan?>">
  </p>

  <p>
    <label for="Kode_Pos">Kode Pos : </label>
    <input type="text" name="Kode_Pos" id="Kode_Pos" value="<?php echo $kode_pos ?>">
  </p>

  <p>
    <label for="No_HP">No HP : </label>
    <input type="text" name="No_HP" id="No_HP" value="<?php echo $no_hp ?>">
  </p>

  <p>
    <label for="Email">Email : </label>
    <input type="text" name="Email" id="Email" value="<?php echo $email ?>">
  </p>
  </p>

</fieldset>
  <br>
  <br>
  <p>
    <input type="submit" name="submit" value="Update Data">
  </p>
</form>

</div>

</body>
</html>
<?php
  mysqli_close($link);
?>