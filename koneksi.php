<?php
/**
 * File koneksi database.
 * Di-include di setiap halaman PHP yang membutuhkan akses database.
 * Sesuaikan variabel di bawah dengan konfigurasi server lokal Anda (XAMPP/Laragon).
 */

$host     = "localhost";
$user_db  = "root";
$pass_db  = "";
$database = "dbuas_77";

$koneksi = mysqli_connect($host, $user_db, $pass_db, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");
