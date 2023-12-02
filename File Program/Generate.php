<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpss  = "";
$link   = mysqli_connect($dbhost,$dbuser,$dbpss);

if(!$link){
    die("koneksi database gagal: ".mysqli_connect_errno().
    " - ".mysqli_connect_error());
}


$query = "CREATE DATABASE IF NOT EXISTS UASKU";
$result = mysqli_query($link, $query);
if(!$result){
    die("Query Error: ".mysqli_errno().
    " - ".mysqli_error());
}
else{
    echo "Database <b>'UASKU'</b> berhasil dibuat. <br>";
}


$result = mysqli_select_db($link, "UASKU");
if(!$result){
    die("Query Error: ".mysqli_errno().
    " - ".mysqli_error());
}
else{
    echo "Database <b>'UASKU'</b> berhasil dipilih. <br>";
}

$query = "DROP TABLE IF EXISTS master";
$hasil_query = mysqli_query($link, $query);

if(!$hasil_query){
  die ("Query Error: ".mysqli_errno($link).
       " - ".mysqli_error($link));
}
else {
  echo "Tabel <b>'master'</b> berhasil dihapus. <br>";
}

$query = "CREATE TABLE master (ID Int(11), Nama_Lengkap Varchar(100),";
$query .= "Jenis_Kelamin Varchar(30), Tempat_Lahir Varchar(50),";
$query .= "Tanggal_Lahir DATE, Alamat Varchar(100),";
$query .= "Provinsi Varchar(100), Kabupaten Varchar(100),";
$query .= "Kecamatan Varchar(100), Kode_Pos int(10),";
$query .= "No_HP varchar(15), Email Varchar(50), PRIMARY KEY (ID))";
$hasil_query = mysqli_query($link, $query);
if(!$hasil_query){
    die("Query Error: ".mysqli_errno($link).
    " - ".mysqli_error($link));
}
else{
    echo "Tabel <b>'master'</b> berhasil dibuat. <br>";
}


$query  = "INSERT INTO master VALUES";
$query .= "('1001', 'Putri Anna', 'Perempuan', 'Sragen', '1999-11-08', ";
$query .= "'kampung baru', 'Jawa Tengah', 'Sragen', 'Kedawung', '57292', '0895800258', 'Riana01@gmail.com'), ";
$query .= "('1002', 'Bagus Pambudi', 'Laki-laki', 'Karanganyar', '2000-08-10', ";
$query .= "'Dagen', 'Jawa Tengah', 'Karanganyar', 'Jaten', '57771', '0895829159', 'Bagus88@gmail.com'), ";
$query .= "('1003', 'Dandi Pranowo', 'Laki-laki', 'Surakarta', '2001-01-27', ";
$query .= "'kauman', 'Jawa Tengah', 'Surakarta', 'Pasar Kliwon', '57110', '0817776120', 'Dragdi@gmail.com'), ";
$query .= "('1004', 'Arwindita Ayu', 'Perempuan', 'Karanganyar', '2001-09-12', ";
$query .= "'Bulu', 'Jawa Tengah', 'Karanganyar', 'Jaten', '57771', '0890077112', 'Arwndt@gmail.com'), ";
$query .= "('1005', 'Banafsa Zumna', 'Perempuan', 'Surakarta', '2002-05-10', ";
$query .= "'Joyotakan', 'Jawa Tengah', 'Surakarta', 'Serengan', '57150', '0890012030', 'Banafsa09@gmail.com')";

  
$hasil_query = mysqli_query($link, $query);
if(!$hasil_query){
    die("Query Error: ".mysqli_errno($link).
    " - ".mysqli_error($link));
}
else{
    echo "Tabel <b>'master'</b> berhasil diisi. <br>";
}
$query = "DROP TABLE IF EXISTS Admin";
  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'Admin'</b> berhasil dihapus... <br>";
  }
$query = "CREATE TABLE Admin (username varchar(15), password varchar(15))";
$hasil_query = mysqli_query($link, $query);
if(!$hasil_query){
    die("Query Error: ".mysqli_errno($link).
    ' - '.mysqli_error($link));
}
else{
    echo "Tabel <b>'Admin'</b> berhasil dibuat. <br>";
}
$username = "adminganteng";
$password = "lenteramerah";


$query = "INSERT INTO Admin Values ('$username', '$password')";
$hasil_query = mysqli_query($link, $query);
if(!$hasil_query){
    die("Query Error: ".mysqli_errno($link).
    " - ".mysqli_error($link));
}
else{
    echo "Tabel <b>'Admin'</b> berhasil diisi. <br> ";
}


mysqli_close($link);
?>