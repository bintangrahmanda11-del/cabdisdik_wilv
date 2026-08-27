<?php
require "koneksi.php";

// Ambil 3 berita terbaru
$query_berita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 3");

// Ambil 4 pengumuman terbaru
$query_pengumuman = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY created_at DESC LIMIT 4");

// Ambil semua event
$query_event = mysqli_query($koneksi, "SELECT * FROM event ORDER BY tanggal_mulai ASC");

// Proses form tambah event (jika ada submit dari form di section Event)
$event_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama_event'])) {
    $nama_event     = trim($_POST['nama_event']);
    $tanggal_mulai  = $_POST['tanggal_mulai'];
    $tanggal_akhir  = $_POST['tanggal_akhir'];
    $deskripsi      = trim($_POST['deskripsi']);

    if ($nama_event !== "" && $deskripsi !== "" && $tanggal_mulai !== "" && $tanggal_akhir !== "") {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO event (nama_event, tanggal_mulai, tanggal_akhir, deskripsi) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $nama_event, $tanggal_mulai, $tanggal_akhir, $deskripsi);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect agar form tidak ter-submit ulang saat refresh, lalu scroll ke section event
            header("Location: index.php?sukses=1#event");
            exit;
        } else {
            $event_message = "Gagal menyimpan event. Silakan coba lagi.";
        }
    } else {
        $event_message = "Semua field wajib diisi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cabdisdik Wilayah V - Provinsi Sumatera Utara</title>
  <meta content="Website Resmi Cabang Dinas Pendidikan Wilayah V Provinsi Sumatera Utara" name="description">
  <meta content="Cabdisdik, Pendidikan, Sumut" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * CUSTOM CSS UNTUK TAMPILAN INSTANSI PEMERINTAHAN
  ======================================================== -->
  <style>
    /* Ubah warna dasar ke Biru Pendidikan/Pemerintah */
    :root {
      --accent-color: #1a56db; 
      --heading-color: #1e3a8a;
    }
    .header {
      background-color: #ffffff;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    }
    .sitename {
      color: #1e3a8a !important;
      font-weight: 800 !important;
      font-size: 24px;
      letter-spacing: 0.5px;
    }
    .hero {
  /* Memanggil background dari index.php */
  background: linear-gradient(rgba(240, 247, 255, 0.85), rgba(255, 255, 255, 0.4)), url('assets/img/cabdis.png') center center no-repeat;
  background-size: cover;
  background-attachment: fixed;
  padding-top: 140px;
  padding-bottom: 120px;
  min-height: 80vh;
  display: flex;
  align-items: center;
}
    .hero h1 {
      color: #1e3a8a;
      font-size: 42px;
      font-weight: 800;
      line-height: 1.2;
    }
    .hero h2 {
      font-size: 22px;
      color: #475569;
      font-weight: 600;
      margin-top: 15px;
      margin-bottom: 20px;
    }
    .hero p {
      color: #64748b;
      font-size: 17px;
      margin-bottom: 30px;
    }
    .btn-get-started {
      background-color: #1a56db;
      color: white;
      border-radius: 8px;
      padding: 12px 30px;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(26, 86, 219, 0.3);
      transition: all 0.3s;
    }
    .btn-get-started:hover {
      background-color: #1e3a8a;
      color: white;
      transform: translateY(-2px);
    }
    .btn-secondary-custom {
      background-color: #ffffff;
      color: #1a56db;
      border: 2px solid #1a56db;
    }
    .btn-secondary-custom:hover {
      background-color: #f0f7ff;
      color: #1e3a8a;
    }
    /* Styling List Berita */
    .about-content ul li {
      background: #ffffff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      margin-bottom: 20px;
      display: flex;
      align-items: flex-start;
      transition: all 0.3s ease;
      border-left: 5px solid #1a56db;
    }
    .about-content ul li:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .img-berita-front {
      width: 120px;
      height: 90px;
      object-fit: cover;
      border-radius: 8px;
      margin-right: 20px;
    }
    .icon-berita-default {
      font-size: 45px;
      color: #1a56db;
      margin-right: 20px;
      line-height: 1;
    }
    /* Styling Kartu Pengumuman */
    .service-item {
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      border: 1px solid #f1f5f9;
      transition: 0.3s;
    }
    .service-item:hover {
      border-color: #1a56db;
      transform: translateY(-5px);
    }
    .service-item h4 {
      color: #1e3a8a;
      font-weight: 700;
    }
    /* Button Event */
    .btn-simpan-event {
      background-color: #1a56db !important;
      border: none;
      border-radius: 8px;
      padding: 12px 30px;
      font-weight: 600;
      color: white;
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto text-decoration-none">
        <!-- Memanggil gambar logo Sumut -->
        <img src="assets/img/logo-sumut.png" alt="Logo Pemprov Sumut" style="height: 50px; margin-right: 15px;">
        <h1 class="sitename mb-0">Cabdisdik Wilayah V</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php#hero" class="active">Beranda</a></li>
          <li><a href="index.php#about">Berita</a></li>
          <li><a href="index.php#services">Pengumuman</a></li>
          <li><a href="index.php#event">Event</a></li>
          <li><a href="index.php#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="login.php" style="background-color: #1a56db; border-radius: 6px;">Login Admin</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="section hero">

      <div class="container">
        <div class="row gy-4">
          <!-- Kolom diperlebar menjadi col-lg-8 agar teks lebih lega -->
          <div class="col-lg-8 d-flex flex-column justify-content-center" data-aos="fade-up">
            <h1 style="color: #1e3a8a; font-size: 46px; font-weight: 800; text-shadow: 1px 1px 2px rgba(255,255,255,0.8);">Cabang Dinas Pendidikan Wilayah V</h1>
            <h2 style="color: #1a56db; font-size: 24px; font-weight: 700; margin-top: 10px;">Dinas Pendidikan Provinsi Sumatera Utara</h2>
            <p style="color: #334155; font-size: 18px; font-weight: 500; margin-bottom: 30px; margin-top: 20px;">Melayani dengan Profesional, Berintegritas, dan Inovatif untuk Mewujudkan Pendidikan yang Unggul dan Berkualitas di Sumatera Utara.</p>
            <div class="d-flex mt-2">
              <a href="#about" class="btn-get-started me-3">Informasi Terbaru</a>
              <a href="login.php" class="btn-get-started btn-secondary-custom">Masuk Admin</a>
            </div>
          </div>
          <!-- Kolom gambar dihapus karena gambar sudah menjadi background penuh -->
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Berita Section (Dulu About) -->
    <section id="about" class="section about bg-light" style="padding-top: 80px;">

      <div class="container section-title pb-3" data-aos="fade-up">
        <h2 style="color: #1e3a8a; display: inline-block; padding-bottom: 5px;">Berita Terbaru</h2>
        <p>Informasi dan liputan kegiatan terkini di lingkungan Cabdisdik Wilayah V</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          
          <?php
          $i = 0;
          while ($row_berita = mysqli_fetch_assoc($query_berita)) {
              $delay_b = 100 + ($i * 100);
              echo '<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="' . $delay_b . '">';
              echo '<div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">';
              
              // Cek apakah ada gambar yang diupload
              echo '<div style="height: 200px; width: 100%; overflow: hidden; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center;">';
              if(!empty($row_berita['gambar']) && file_exists('admin/uploads/'.$row_berita['gambar'])) {
                  echo '<img src="admin/uploads/' . $row_berita['gambar'] . '" class="card-img-top" alt="Gambar Berita" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform=\'scale(1.05)\'" onmouseout="this.style.transform=\'scale(1)\'">';
              } else {
                  // Tampilkan logo instansi jika berita tidak punya gambar
                  echo '<i class="bi bi-newspaper" style="font-size: 5rem; color: #cbd5e1;"></i>';
              }
              echo '</div>';
              
              echo '<div class="card-body p-4 d-flex flex-column">';
              // Tanggal di atas judul
              echo '<div class="d-flex align-items-center mb-2" style="font-size: 0.85rem; color: #1a56db; font-weight: 600;">';
              echo '<i class="bi bi-calendar3 me-2"></i>' . date('d M Y', strtotime($row_berita['tanggal']));
              echo '</div>';
              
              // Judul Berita
              echo '<h5 class="card-title" style="font-weight: 700; color: #1e293b; line-height: 1.4; margin-bottom: 15px;">' . htmlspecialchars($row_berita['judul']) . '</h5>';
              
              // Potong keterangan agar tidak terlalu panjang di card
              $keterangan = htmlspecialchars($row_berita['keterangan']);
              if(strlen($keterangan) > 120) {
                  $keterangan = substr($keterangan, 0, 120) . '...';
              }
              echo '<p class="card-text text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">' . $keterangan . '</p>';
              
              // Tombol Baca Selengkapnya yang sudah terhubung dengan ID Berita
              echo '<a href="detail_berita.php?id=' . $row_berita['id'] . '" class="mt-auto d-inline-flex align-items-center" style="color: #1a56db; font-weight: 600; text-decoration: none; font-size: 0.9rem; transition: 0.3s;" onmouseover="this.style.color=\'#1e3a8a\'" onmouseout="this.style.color=\'#1a56db\'">Baca Selengkapnya <i class="bi bi-arrow-right ms-2" style="font-size: 1.1rem;"></i></a>';
              
              echo '</div>';
              echo '</div>';
              echo '</div>';
              $i++;
          }
          if ($i === 0) {
              echo '<div class="col-12 text-center py-5">';
              echo '<i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>';
              echo '<p class="text-muted mt-3" style="font-size: 1.1rem;">Belum ada data berita yang dipublikasikan.</p>';
              echo '</div>';
          }
          ?>

        </div>
      </div>

    </section><!-- /Berita Section -->
    <!-- Pengumuman Section -->
    <section id="services" class="services section" style="background-color: #f8fafc; padding-top: 80px; padding-bottom: 80px;">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2 style="color: #1e3a8a; display: inline-block; padding-bottom: 5px;">Pengumuman Resmi</h2>
        <p>Informasi, surat edaran, dan pemberitahuan terbaru dari Cabang Dinas Pendidikan Wilayah V</p>
      </div><!-- End Section Title -->

      <div class="container">
        <!-- Menggunakan justify-content-center agar rapi di tengah -->
        <div class="row gy-4 justify-content-center">

          <?php
          $no_icon_p = ['bi-megaphone', 'bi-file-earmark-text', 'bi-info-circle', 'bi-bookmark-star'];
          $j = 0;
          while ($row_p = mysqli_fetch_assoc($query_pengumuman)) {
              $icon_p = $no_icon_p[$j % count($no_icon_p)];
              $delay = 100 + ($j * 100);
              
              // Format tanggal dari database (created_at)
              $tanggal_pengumuman = isset($row_p['created_at']) ? date('d M Y', strtotime($row_p['created_at'])) : 'Info Terbaru';

              echo '<div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="' . $delay . '">';
              // Desain Kartu Pengumuman
              echo '<div class="card w-100 border-0" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); transition: all 0.3s ease; border-top: 4px solid #1a56db !important; overflow: hidden;" onmouseover="this.style.transform=\'translateY(-8px)\'; this.style.boxShadow=\'0 15px 35px rgba(0,0,0,0.1)\';" onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 10px 30px rgba(0,0,0,0.06)\';">';
              
              echo '<div class="card-body p-4 d-flex flex-column">';
              
              // Baris Ikon dan Tanggal
              echo '<div class="d-flex justify-content-between align-items-start mb-3">';
              echo '<div style="width: 50px; height: 50px; background-color: #eff6ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #1a56db;">';
              echo '<i class="bi ' . $icon_p . '" style="font-size: 1.6rem;"></i>';
              echo '</div>';
              echo '<span class="badge" style="background-color: #e0f2fe; color: #0284c7; font-weight: 600; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem;"><i class="bi bi-clock me-1"></i> ' . $tanggal_pengumuman . '</span>';
              echo '</div>';
              
              // Judul Pengumuman
              echo '<h4 style="font-size: 1.1rem; font-weight: 700; color: #1e293b; margin-bottom: 12px; line-height: 1.4;">' . htmlspecialchars($row_p['judul']) . '</h4>';
              
              // Isi Pengumuman (Dipotong agar rapi)
              $isi_pengumuman = htmlspecialchars($row_p['isi']);
              if(strlen($isi_pengumuman) > 90) {
                  $isi_pengumuman = substr($isi_pengumuman, 0, 90) . '...';
              }
              echo '<p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; flex-grow: 1;">' . $isi_pengumuman . '</p>';
              
              // Footer / Tombol Link
              echo '<div class="mt-3 pt-3 border-top" style="border-color: #f1f5f9 !important;">';
              // Link diubah agar mengarah ke detail_pengumuman.php dengan membawa ID
              echo '<a href="detail_pengumuman.php?id=' . $row_p['id'] . '" class="d-flex align-items-center justify-content-between" style="color: #1a56db; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.3s;" onmouseover="this.style.color=\'#1e3a8a\'" onmouseout="this.style.color=\'#1a56db\'">';
              echo '<span>Baca Edaran</span>';
              echo '<i class="bi bi-arrow-right-circle-fill" style="font-size: 1.2rem;"></i>';
              echo '</a>';
              echo '</div>';

              echo '</div>'; // Tutup card-body
              echo '</div>'; // Tutup card
              echo '</div>'; // Tutup col
              $j++;
          }
          if ($j === 0) {
              echo '<div class="col-12 text-center py-5">';
              echo '<i class="bi bi-folder-x text-muted" style="font-size: 4rem;"></i>';
              echo '<p class="text-muted mt-3" style="font-size: 1.1rem;">Belum ada data pengumuman.</p>';
              echo '</div>';
          }
          ?>

        </div>
      </div>

    </section><!-- /Pengumuman Section -->
    <!-- Event Section -->
    <section id="event" class="contact section" style="background-color: #ffffff; padding-top: 80px; padding-bottom: 80px;">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2 style="color: #1e3a8a; display: inline-block; padding-bottom: 5px;">Agenda & Kegiatan</h2>
        <p>Jadwal pelaksanaan program dan acara di lingkungan Cabdisdik Wilayah V</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5 justify-content-between">

          <!-- Kolom Kiri: Daftar Agenda -->
          <div class="col-lg-5">
            <div class="d-flex align-items-center mb-4">
              <div style="background-color: #eff6ff; padding: 10px; border-radius: 10px; color: #1a56db; margin-right: 15px;">
                <i class="bi bi-calendar-range" style="font-size: 1.5rem;"></i>
              </div>
              <h3 style="color: #1e3a8a; font-weight: 700; margin: 0; font-size: 1.4rem;">Daftar Agenda</h3>
            </div>
            
            <!-- Container dengan Scrollbar (jika event banyak) -->
            <div class="agenda-list-container" style="max-height: 550px; overflow-y: auto; padding-right: 10px; padding-bottom: 10px;">
              <?php
              $k = 0;
              while ($row_event = mysqli_fetch_assoc($query_event)) {
                  $delay_e = 100 + ($k * 50);
                  
                  // Mengambil format tanggal untuk tampilan 'Lembar Kalender'
                  $start_date = strtotime($row_event['tanggal_mulai']);
                  $end_date = strtotime($row_event['tanggal_akhir']);
                  
                  $start_day = date("d", $start_date);
                  $start_month = date("M", $start_date); // Singkatan bulan (Jan, Feb, dst)
                  $end_str = date("d M Y", $end_date);
                  
                  echo '<div class="card mb-3 border-0 shadow-sm" data-aos="fade-up" data-aos-delay="' . $delay_e . '" style="border-radius: 12px; transition: 0.3s; border-left: 4px solid #1a56db !important; background-color: #f8fafc;" onmouseover="this.style.transform=\'translateX(5px)\'" onmouseout="this.style.transform=\'translateX(0)\'">';
                  echo '<div class="card-body p-3 d-flex align-items-start">';
                  
                  // Ikon/Kotak Kalender Visual
                  echo '<div class="calendar-box text-center me-3 flex-shrink-0 shadow-sm" style="width: 65px; background: #ffffff; border-radius: 8px; overflow: hidden; border: 1px solid #e0eaff;">';
                  echo '<div style="background: #1a56db; color: white; font-weight: 700; font-size: 0.75rem; padding: 4px 0; text-transform: uppercase; letter-spacing: 1px;">' . $start_month . '</div>';
                  echo '<div style="color: #1e3a8a; font-weight: 800; font-size: 1.6rem; padding: 5px 0; line-height: 1;">' . $start_day . '</div>';
                  echo '</div>';
                  
                  // Detail Event
                  echo '<div class="flex-grow-1">';
                  echo '<h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 6px;">' . htmlspecialchars($row_event['nama_event']) . '</h4>';
                  echo '<div style="color: #0284c7; font-size: 0.8rem; font-weight: 600; margin-bottom: 8px; background: #e0f2fe; display: inline-block; padding: 3px 8px; border-radius: 4px;"><i class="bi bi-clock-history me-1"></i> s/d ' . $end_str . '</div>';
                  echo '<p style="color: #64748b; font-size: 0.85rem; margin: 0; line-height: 1.5;">' . htmlspecialchars($row_event['deskripsi']) . '</p>';
                  echo '</div>';
                  
                  echo '</div>'; // card-body
                  echo '</div>'; // card
                  $k++;
              }
              if ($k === 0) {
                  echo '<div class="text-center py-5 border rounded" style="background: #f8fafc; border-style: dashed !important; border-width: 2px !important; border-color: #cbd5e1 !important;">';
                  echo '<i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>';
                  echo '<p class="text-muted mt-3 font-weight-bold">Belum ada agenda terjadwal.</p>';
                  echo '</div>';
              }
              ?>
            </div>
          </div>

          <!-- Kolom Kanan: Form Usulan Event -->
          <div class="col-lg-6">
            <div class="card border-0 shadow" style="border-radius: 15px; background: #ffffff;">
              <div class="card-body p-4 p-md-5">
                
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                  <div style="width: 45px; height: 45px; background: #f0fdf4; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                      <i class="bi bi-pencil-square text-success" style="font-size: 1.3rem;"></i>
                  </div>
                  <div>
                    <h3 style="color: #1e3a8a; font-weight: 700; margin: 0; font-size: 1.3rem;">Usulkan Event Baru</h3>
                    <span style="font-size: 0.85rem; color: #64748b;">Kirimkan usulan kegiatan Anda di sini</span>
                  </div>
                </div>
                
                <?php if ($event_message !== "") : ?>
                  <div class="alert alert-danger" style="border-radius: 8px; font-size: 0.9rem;"><i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo htmlspecialchars($event_message); ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['sukses'])) : ?>
                  <div class="alert alert-success" style="border-radius: 8px; font-size: 0.9rem;"><i class="bi bi-check-circle-fill me-2"></i> Usulan event Anda berhasil dikirim!</div>
                <?php endif; ?>
                
                <form action="index.php#event" method="post" data-aos="fade-up" data-aos-delay="200">
                  <div class="row gy-4">
                    
                    <div class="col-md-12">
                      <label for="name-field" class="form-label fw-bold" style="color: #334155; font-size: 0.85rem;">Nama Kegiatan / Acara</label>
                      <input type="text" name="nama_event" id="name-field" class="form-control form-control-lg bg-light" style="border-radius: 8px; font-size: 0.9rem; border: 1px solid #e2e8f0;" required placeholder="Contoh: Rapat Koordinasi MKKS SMA/SMK">
                    </div>

                    <div class="col-md-6">
                      <label for="email-field" class="form-label fw-bold" style="color: #334155; font-size: 0.85rem;">Tanggal Mulai</label>
                      <input type="date" class="form-control form-control-lg bg-light" name="tanggal_mulai" id="email-field" style="border-radius: 8px; font-size: 0.9rem; border: 1px solid #e2e8f0;" required>
                    </div>

                    <div class="col-md-6">
                      <label for="subject-field" class="form-label fw-bold" style="color: #334155; font-size: 0.85rem;">Tanggal Selesai</label>
                      <input type="date" class="form-control form-control-lg bg-light" name="tanggal_akhir" id="subject-field" style="border-radius: 8px; font-size: 0.9rem; border: 1px solid #e2e8f0;" required>
                    </div>

                    <div class="col-md-12">
                      <label for="message-field" class="form-label fw-bold" style="color: #334155; font-size: 0.85rem;">Deskripsi Singkat Acara</label>
                      <textarea class="form-control bg-light" name="deskripsi" rows="5" id="message-field" style="border-radius: 8px; font-size: 0.9rem; border: 1px solid #e2e8f0;" required placeholder="Tuliskan sasaran, peserta, atau keterangan detail mengenai acara ini..."></textarea>
                    </div>

                    <div class="col-md-12 text-end mt-2">
                      <button type="submit" class="btn btn-primary w-100 shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 12px; background: linear-gradient(135deg, #1a56db 0%, #3b82f6 100%); border: none; transition: 0.3s;" onmouseover="this.style.transform=\'translateY(-2px)\'" onmouseout="this.style.transform=\'translateY(0)\'">
                        <i class="bi bi-send-check me-2"></i> Kirim Usulan Event
                      </button>
                    </div>

                  </div>
                </form>

              </div>
            </div>
          </div><!-- End Contact Form -->

        </div>
      </div>

    </section><!-- /Event Section -->
    <!-- Profil Mahasiswa / Kontak Section -->
    <section id="contact" class="contact section bg-light">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak Developer</h2>
        <p>Pengembang Sistem Informasi Website Cabdisdik</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 justify-content-center">

          <div class="col-lg-5">
            <div class="info-wrap" style="background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 30px;">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-person-badge flex-shrink-0" style="color: #1a56db; background: #f0f7ff;"></i>
                <div>
                  <h3 style="color: #1e3a8a;">Nama Lengkap</h3>
                  <p class="fw-bold text-dark">Bintang Rahmanda Putra S</p>
                </div>
              </div>

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0" style="color: #1a56db; background: #f0f7ff;"></i>
                <div>
                  <h3 style="color: #1e3a8a;">Nomor Telepon</h3>
                  <p>0823-1591-7952</p>
                </div>
              </div>

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-mortarboard flex-shrink-0" style="color: #1a56db; background: #f0f7ff;"></i>
                <div>
                  <h3 style="color: #1e3a8a;">Kelas dan Jurusan</h3>
                  <p>Kelas SI4N - Sistem Informasi</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 text-center">
            <div class="info-wrap" style="background: transparent; box-shadow: none;">
                <img src="img/bintang.jpeg" class="img-fluid" alt="Foto Bintang" style="border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-height: 350px; object-fit: cover; border: 5px solid white;">
            </div>
          </div>

        </div>
      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer position-relative" style="background-color: #1e293b; color: white;">

    <div class="container copyright text-center mt-4 pb-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename" style="color: #93c5fd !important;">CABANG DINAS PENDIDIKAN PROVINSI SUMATERA UTARA</strong> <span>All Rights Reserved</span></p>
      <div class="credits" style="color: #94a3b8;">
        Designed by <a href="https://bootstrapmade.com/" style="color: #60a5fa;">BootstrapMade</a> | Developed by Bintang Rahmanda Putra S
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center" style="background-color: #1a56db;"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>