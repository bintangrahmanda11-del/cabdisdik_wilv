<?php
require "koneksi.php";

// Cek apakah ada ID pengumuman yang dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_pengumuman = (int) $_GET['id'];

// Ambil data pengumuman berdasarkan ID
$stmt = mysqli_prepare($koneksi, "SELECT * FROM pengumuman WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id_pengumuman);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$pengumuman = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan, kembali ke halaman utama
if (!$pengumuman) {
    header("Location: index.php");
    exit;
}

$tanggal_publikasi = isset($pengumuman['created_at']) ? date('d F Y', strtotime($pengumuman['created_at'])) : '-';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo htmlspecialchars($pengumuman['judul']); ?> - Cabdisdik Wilayah V</title>
  
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <style>
    body { background-color: #f8fafc; font-family: 'Open Sans', sans-serif; color: #334155; }
    .header { background-color: #ffffff; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08); padding: 15px 0; }
    .sitename { color: #1e3a8a !important; font-weight: 800 !important; font-size: 24px; letter-spacing: 0.5px; margin: 0; }
    .btn-back {
      background-color: #ffffff; color: #1e3a8a; border: 2px solid #1e3a8a; 
      border-radius: 8px; padding: 8px 20px; font-weight: 600; transition: all 0.3s;
      text-decoration: none; display: inline-flex; align-items: center;
    }
    .btn-back:hover { background-color: #1e3a8a; color: #ffffff; transform: translateY(-2px); }
    
    .edaran-container { background: #ffffff; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); padding: 50px; margin-top: 40px; margin-bottom: 60px; border-top: 8px solid #1a56db; }
    .edaran-title { color: #1e3a8a; font-family: 'Raleway', sans-serif; font-weight: 800; font-size: 2rem; line-height: 1.3; margin-bottom: 20px; text-align: center; }
    .edaran-meta { color: #64748b; font-size: 0.95rem; font-weight: 500; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 2px solid #f1f5f9; text-align: center; }
    
    .edaran-content { font-size: 1.1rem; line-height: 1.8; color: #1e293b; text-align: justify; }
    
    .footer { background-color: #1e293b; color: white; padding: 30px 0; text-align: center; }
  </style>
</head>

<body>

  <!-- Header -->
  <header class="header sticky-top">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center text-decoration-none">
        <img src="assets/img/logo-sumut.png" alt="Logo" style="height: 45px; margin-right: 15px;">
        <h1 class="sitename">Cabdisdik Wilayah V</h1>
      </a>
      <a href="index.php#services" class="btn-back"><i class="bi bi-arrow-left me-2"></i> Kembali</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        
        <article class="edaran-container">
          
          <div class="text-center mb-4">
             <i class="bi bi-megaphone-fill" style="font-size: 3rem; color: #1a56db;"></i>
          </div>

          <!-- Judul Pengumuman -->
          <h1 class="edaran-title"><?php echo htmlspecialchars($pengumuman['judul']); ?></h1>
          
          <!-- Meta Data -->
          <div class="edaran-meta">
            <span class="me-4"><i class="bi bi-calendar-check me-1"></i> Diterbitkan: <?php echo $tanggal_publikasi; ?></span>
            <span><i class="bi bi-building me-1"></i> Cabang Dinas Pendidikan Wilayah V</span>
          </div>
          
          <!-- Isi Pengumuman -->
          <div class="edaran-content">
            <?php echo nl2br(htmlspecialchars($pengumuman['isi'])); ?>
          </div>

          <!-- Tombol Aksi Bawah -->
          <div class="mt-5 pt-4 border-top d-flex justify-content-center align-items-center">
             <a href="index.php#services" class="btn px-4 py-2" style="background-color: #f1f5f9; color: #334155; font-weight: 600; border-radius: 8px;"><i class="bi bi-arrow-left-circle me-1"></i> Tutup Edaran</a>
             <button onclick="window.print()" class="btn px-4 py-2 ms-3" style="background-color: #1a56db; color: white; font-weight: 600; border-radius: 8px;"><i class="bi bi-printer me-1"></i> Cetak</button>
          </div>

        </article>

      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p class="mb-1">© Copyright <strong style="color: #93c5fd;">CABANG DINAS PENDIDIKAN PROVINSI SUMATERA UTARA</strong></p>
      <small style="color: #94a3b8;">Developed by Bintang Rahmanda Putra S</small>
    </div>
  </footer>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>