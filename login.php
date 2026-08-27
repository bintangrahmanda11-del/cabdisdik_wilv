<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login Sistem - Modern Blue Tech</title>

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --dark-blue-deep: #060b19;
      --dark-blue-card: rgba(13, 27, 56, 0.65);
      --border-blue: rgba(0, 180, 216, 0.25);
      --light-blue-glow: #00b4d8;
      --light-blue-bright: #90e0ef;
      --text-muted: #a0aec0;
    }

    * {
      font-family: 'Plus Jakarta Sans', sans-serif;
      box-sizing: border-box;
    }

    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--dark-blue-deep);
      /* Menggunakan perpaduan gradient mesh modern dengan background image_25d845.png */
      background-image: 
        radial-gradient(circle at 80% 20%, rgba(0, 180, 216, 0.15) 0%, transparent 40%),
        radial-gradient(circle at 10% 80%, rgba(13, 27, 56, 0.8) 0%, transparent 50%),
        url('image_25d845.png');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      padding: 20px;
      position: relative;
      overflow-x: hidden;
    }

    /* Efek garis teknologi abstrak latar belakang */
    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: linear-gradient(rgba(0, 180, 216, 0.02) 1px, transparent 1px),
                  linear-gradient(90deg, rgba(0, 180, 216, 0.02) 1px, transparent 1px);
      background-size: 50px 50px;
      z-index: 0;
      pointer-events: none;
    }

    .login-container {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 450px;
    }

    .login-card {
      background: var(--dark-blue-card);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--border-blue);
      border-radius: 24px;
      padding: 45px 40px;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4), 
                  inset 0 1px 2px rgba(255, 255, 255, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
      border-color: rgba(0, 180, 216, 0.4);
      box-shadow: 0 25px 60px rgba(0, 180, 216, 0.15), 
                  0 20px 50px rgba(0, 0, 0, 0.4);
    }

    .brand-section {
      text-align: center;
      margin-bottom: 35px;
    }

    .tech-icon {
      width: 65px;
      height: 65px;
      background: linear-gradient(135deg, rgba(0, 180, 216, 0.2) 0%, rgba(13, 27, 56, 0.6) 100%);
      border: 1px solid var(--light-blue-glow);
      color: var(--light-blue-bright);
      border-radius: 16px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      margin-bottom: 20px;
      box-shadow: 0 0 20px rgba(0, 180, 216, 0.2);
    }

    .brand-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 6px;
      letter-spacing: 0.5px;
    }

    .brand-subtitle {
      font-size: 0.85rem;
      color: var(--text-muted);
      font-weight: 400;
    }

    .form-group-custom {
      position: relative;
      margin-bottom: 22px;
    }

    .form-group-custom label {
      display: block;
      color: var(--light-blue-bright);
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 8px;
    }

    .input-wrapper {
      position: relative;
    }

    .input-wrapper i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--light-blue-glow);
      font-size: 1.1rem;
      transition: color 0.3s;
    }

    .form-control-custom {
      width: 100%;
      background: rgba(6, 11, 25, 0.5);
      border: 1px solid rgba(0, 180, 216, 0.2);
      border-radius: 12px;
      padding: 14px 16px 14px 48px;
      color: #ffffff;
      font-size: 0.95rem;
      outline: none;
      transition: all 0.3s ease;
    }

    .form-control-custom::placeholder {
      color: rgba(255, 255, 255, 0.25);
    }

    .form-control-custom:focus {
      border-color: var(--light-blue-glow);
      background: rgba(6, 11, 25, 0.8);
      box-shadow: 0 0 15px rgba(0, 180, 216, 0.25);
    }

    .form-control-custom:focus + i {
      color: var(--light-blue-bright);
    }

    .btn-submit-tech {
      width: 100%;
      background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
      border: none;
      color: #ffffff;
      padding: 14px;
      font-size: 0.95rem;
      font-weight: 600;
      border-radius: 12px;
      margin-top: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 180, 216, 0.3);
    }

    .btn-submit-tech:hover {
      background: linear-gradient(135deg, #00b4d8 0%, #90e0ef 100%);
      color: #060b19;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 180, 216, 0.5);
    }

    .btn-submit-tech:active {
      transform: translateY(0);
    }

    .alert-custom {
      font-size: 0.85rem;
      border-radius: 12px;
      padding: 12px 16px;
      margin-bottom: 25px;
      border: 1px solid transparent;
    }

    .alert-danger-custom {
      background: rgba(239, 68, 68, 0.15);
      border-color: rgba(239, 68, 68, 0.3);
      color: #f87171;
    }

    .alert-success-custom {
      background: rgba(16, 185, 129, 0.15);
      border-color: rgba(16, 185, 129, 0.3);
      color: #34d399;
    }

    .footer-section {
      text-align: center;
      margin-top: 30px;
      font-size: 0.8rem;
      color: var(--text-muted);
      line-height: 1.5;
    }

    .back-node-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: var(--light-blue-glow);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
      margin-top: 5px;
    }

    .back-node-link:hover {
      color: var(--light-blue-bright);
      text-shadow: 0 0 8px rgba(144, 224, 239, 0.6);
    }
  </style>
</head>

<body>

  <div class="login-container">
    <div class="login-card">
      
      <div class="brand-section">
        <div class="tech-icon">
          <i class="bi bi-shield-lock-fill"></i>
        </div>
        <h2 class="brand-title">Portal Akses Masuk</h2>
        <p class="brand-subtitle">Silakan autentikasi akun Anda untuk melanjutkan</p>
      </div>

      <?php
      if (isset($_GET['error'])) {
          echo '<div class="alert alert-custom alert-danger-custom d-flex align-items-center gap-2" role="alert">
                  <i class="bi bi-exclamation-octagon-fill"></i>
                  <div>Gagal: Kredensial pengguna tidak valid.</div>
                </div>';
      }
      if (isset($_GET['logout'])) {
          echo '<div class="alert alert-custom alert-success-custom d-flex align-items-center gap-2" role="alert">
                  <i class="bi bi-check-circle-fill"></i>
                  <div>Sistem: Sesi telah ditutup dengan aman.</div>
                </div>';
      }
      ?>

      <form action="proses_login.php" method="post">
        <div class="form-group-custom">
          <label for="username">ID Pengguna / Username</label>
          <div class="input-wrapper">
            <input type="text" class="form-control-custom" id="username" name="username" required autofocus placeholder="Masukkan username...">
            <i class="bi bi-person-fill"></i>
          </div>
        </div>
        
        <div class="form-group-custom">
          <label for="password">Kata Sandi</label>
          <div class="input-wrapper">
            <input type="password" class="form-control-custom" id="password" name="password" required placeholder="Masukkan kata sandi...">
            <i class="bi bi-key-fill"></i>
          </div>
        </div>

        <button type="submit" class="btn btn-submit-tech">
          Autentikasi Aman <i class="bi bi-arrow-right-short font-weight-bold"></i>
        </button>
      </form>

      <div class="footer-section">
        &copy; Website Profil Bintang Rahmanda Putra S 2026<br>
        Sistem Informasi &middot; <a href="index.php" class="back-node-link"><i class="bi bi-house-door-fill"></i> Kembali ke Beranda</a>
      </div>

    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // 1. Konfigurasi dasar untuk Toast Notification
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end', // Posisi di pojok kanan atas
      showConfirmButton: false, // Menyembunyikan tombol OK
      timer: 3000, // Waktu tampil (3000 ms = 3 detik)
      timerProgressBar: true, // Memunculkan garis loading di bawah
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });

    // 2. Logika PHP untuk menangkap pesan error / logout
    <?php if (isset($_GET['error'])) : ?>
      Toast.fire({
        icon: 'error',
        title: 'Akses Ditolak',
        text: 'Kredensial tidak valid!'
      });
    <?php endif; ?>

    <?php if (isset($_GET['logout'])) : ?>
      Toast.fire({
        icon: 'success',
        title: 'Berhasil Logout',
        text: 'Sesi Anda telah diakhiri.'
      });
    <?php endif; ?>
  </script>
</body>

</html>