<?php
require "koneksi.php";

// Cek apakah ada ID berita yang dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_berita = (int) $_GET['id'];

// Ambil data berita berdasarkan ID
$stmt = mysqli_prepare($koneksi, "SELECT * FROM berita WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id_berita);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$berita = mysqli_fetch_assoc($result);

// Jika berita tidak ditemukan di database, kembali ke halaman utama
if (!$berita) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo htmlspecialchars($berita['judul']); ?> - Cabdisdik Wilayah V</title>
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom CSS for Detail Page -->
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
    
    .article-container { background: #ffffff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); padding: 40px; margin-top: 40px; margin-bottom: 60px; }
    .article-title { color: #1e3a8a; font-family: 'Raleway', sans-serif; font-weight: 800; font-size: 2.2rem; line-height: 1.3; margin-bottom: 20px; }
    .article-meta { color: #64748b; font-size: 0.95rem; font-weight: 500; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #e2e8f0; }
    .article-meta i { color: #1a56db; }
    
    .article-image-wrapper { width: 100%; max-height: 500px; overflow: hidden; border-radius: 12px; margin-bottom: 30px; background-color: #f1f5f9; display: flex; justify-content: center; align-items: center; }
    .article-image { width: 100%; height: auto; object-fit: cover; }
    .no-image-icon { font-size: 6rem; color: #cbd5e1; padding: 50px; }
    
    .article-content { font-size: 1.05rem; line-height: 1.8; color: #475569; }
    
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
      <a href="index.php#about" class="btn-back"><i class="bi bi-arrow-left me-2"></i> Kembali</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        
        <article class="article-container">
          
          <!-- Judul Berita -->
          <h1 class="article-title"><?php echo htmlspecialchars($berita['judul']); ?></h1>
          
          <!-- Meta Data (Tanggal & Admin) -->
          <div class="article-meta d-flex align-items-center">
            <span class="me-4"><i class="bi bi-calendar-event me-2"></i> <?php echo date('d F Y', strtotime($berita['tanggal'])); ?></span>
            <span><i class="bi bi-person-circle me-2"></i> Admin Cabdisdik</span>
          </div>
          
          <!-- Gambar Berita -->
          <div class="article-image-wrapper">
            <?php if(!empty($berita['gambar']) && file_exists('admin/uploads/'.$berita['gambar'])) : ?>
                <img src="admin/uploads/<?php echo $berita['gambar']; ?>" class="article-image" alt="Gambar Berita">
            <?php else : ?>
                <!-- Ditampilkan jika berita tidak memiliki gambar -->
                <i class="bi bi-image no-image-icon"></i>
            <?php endif; ?>
          </div>
          
          <!-- Isi Berita -->
          <div class="article-content">
            <!-- nl2br digunakan agar enter/paragraf dari text area di admin terbaca sebagai baris baru di HTML -->
            <?php echo nl2br(htmlspecialchars($berita['keterangan'])); ?>
          </div>

          <!-- Tombol Share & Kembali Bawah -->
          <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
             <div class="share-links">
                 <span class="fw-bold me-3" style="color: #1e3a8a;">Bagikan:</span>
                 <a href="#" class="text-primary fs-4 me-2"><i class="bi bi-facebook"></i></a>
                 <a href="#" class="text-success fs-4 me-2"><i class="bi bi-whatsapp"></i></a>
                 <a href="#" class="text-info fs-4"><i class="bi bi-twitter"></i></a>
             </div>
             <a href="index.php#about" class="btn btn-primary px-4 py-2" style="background-color: #1a56db; border:none; border-radius: 8px;"><i class="bi bi-house-door me-1"></i> Beranda Utama</a>
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