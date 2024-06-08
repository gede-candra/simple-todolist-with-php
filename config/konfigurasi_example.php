<?php
/**
 * File konfigurasi_example.php adalah template koneksi ke database
 * File konfigurasi_example.php tidak disarankan untuk dihapus
 * Silahkan duplikat file lalu rename file dengan nama konfigurasi.php
 */

$koneksi = mysqli_connect("localhost", "root", "", "todolist");
if (!$koneksi) {
   die("Koneksi ke database gagal: " . mysqli_connect_error());
}

/**
 * Variabel ini digunakan untuk mengambil directory/folder dari /uploads
 * Silahkan buat folder uploads yang setara posisinya dengan Readme.md (jika folder uploads belum ada)
 * lalu klik kanan pada folder uploads pilih "copy path" setelah itu tempelkan dibawah ini
 */
$upload_file_directory = null;