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
    // form telah disubmit, proses data

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

    // siapkan variabel untuk menampung pesan error
    $pesan_error="";

    // cek apakah "ID" sudah diisi atau tidak
    if (empty($ID)) {
      $pesan_error .= "ID belum diisi <br>";
    }
    // ID harus angka 
    elseif (!preg_match("/^[0-9]{4}$/",$ID) ) {
      $pesan_error .= "ID harus berupa 4 digit angka <br>";
    }

    // cek ke database, apakah sudah ada nomor ID yang sama
    // filter data $ID
    $nim = mysqli_real_escape_string($link,$ID);
    $query = "SELECT * FROM master WHERE ID='$ID'";
    $hasil_query = mysqli_query($link, $query);

    // cek jumlah record (baris), jika ada, $ID tidak bisa diproses
    $jumlah_data = mysqli_num_rows($hasil_query);
     if ($jumlah_data >= 1 ) {
       $pesan_error .= "ID yang sama sudah digunakan <br>";
    }

    if (empty($nama_lengkap)) {
      $pesan_error .= "Nama belum diisi <br>";
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
    // siapkan variabel untuk menggenerate pilihan jenis kelamin
    $lakilaki=""; $perempuan=""; 

    switch($jenis_kelamin) {
     case "laki laki" : $lakilaki       = "selected";  break;
     case "perempuan" : $perempuan      = "selected";  break;
    }

    // jika tidak ada error, input ke database
    if ($pesan_error === "") {

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

      //buat dan jalankan query INSERT
      $query = "INSERT INTO master VALUES ";
      $query .= "('$ID','$nama_lengkap','$jenis_kelamin','$tempat_lahir',";
      $query .= "'$tanggal_lahir','$alamat','$provinsi','$kabupaten',";
      $query .= "'$kecamatan','$kode_pos','$no_hp','$email')";

      $result = mysqli_query($link, $query);

      //periksa hasil query
      if($result) {
      // INSERT berhasil, redirect ke tampil_mahasiswa.php + pesan
        $pesan = "Penerima dengan nama = \"<b>$nama_lengkap</b>\" sudah berhasil di tambah";
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
    // form belum disubmit atau halaman ini tampil untuk pertama kali
    // berikan nilai awal untuk semua isian form
    $pesan_error       = "";
    $ID                = "";
    $nama_lengkap      = "";
    $jenis_kelamin     = "";
    $lakilaki          = "Selected"; $perempuan = "";
    $tempat_lahir      = "";
    $tanggal=1;$bulan="1";$tahun=1996;
    $alamat            = "";
    $provinsi          = "";
    $kabupaten         = "";
    $kecamatan         = "";
    $kode_pos          = "";
    $no_hp             = "";
    $email             = "";
    $lakilaki = "selected";
    $perempuan = "";  
    $tanggal=1;$bulan="1";$tahun=1996;
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
    <li><a href="Lpgout.php">Logout</a>
  </ul>
  </nav>
 
<h2>Tambah Data Penerima</h2>
<?php
  // tampilkan error jika ada
  if ($pesan_error !== "") {
      echo "<div class=\"error\">$pesan_error</div>";
  }
?>
<form id="form_penerima" action="Tambah_Penerima.php" method="post">
<fieldset>
<legend>Penerima Baru</legend>
  <p>
    <label for="ID">ID : </label>
    <input type="text" name="ID" id="ID" value="<?php echo $ID ?>"
    placeholder="Contoh: 1001">
    (4 digit angka)
  </p>
  <p>
    <label for="Nama_Lengkap">Nama Lengkap : </label>
    <input type="text" name="Nama_Lengkap" id="Nama_Lengkap" value="<?php echo $nama_lengkap ?>">
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
  </fieldset>
  <br>
  <p>
    <input type="submit" name="submit" value="Tambah Data">
    </P>
    </form>
</div>
</body>
</html>
<?php
  // tutup koneksi dengan database mysql
  mysqli_close($link);
?>
