<?php
require 'config.php';
if(!is_logged_in()){
    header('Location: auth/login.php'); exit;
}
include 'templates/header.php';
?>

<style>
.report-box {
    border-radius: 12px;
    padding: 15px;
    background: linear-gradient(to right, #f5f7fa, #c3cfe2);
    transition: .3s;
}
.report-box:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.dark-theme {
    background: #1b1b1b;
    color: #eaeaea;
    border: 1px solid #333;
}
.theme-btn {
    border-radius: 8px;
    margin-right: 8px;
}
</style>

<div class="container py-5">

  <h1 class="mb-3">👋 Selamat datang, <?= e(current_user()['name']) ?></h1>

  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card p-3 shadow-sm animate-card report-box">
        <h5>Jumlah Barang</h5>
        <?php
          $stmt = $pdo->query("SELECT COUNT(*) as c FROM items");
          $c = $stmt->fetchColumn();
        ?>
        <div class="display-4 fw-bold"><?= e($c) ?></div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card p-3 shadow-sm animate-card report-box">
        <h5>Barang Dipinjam</h5>
        <?php
          $stmt = $pdo->query("SELECT COUNT(*) FROM transactions WHERE type='borrow' AND returned_at IS NULL");
          $borrowed = $stmt->fetchColumn();
        ?>
        <div class="display-4 fw-bold"><?= e($borrowed) ?></div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card p-3 shadow-sm animate-card report-box">
        <h5>Total Pengguna</h5>
        <?php
          $stmt = $pdo->query("SELECT COUNT(*) FROM users");
          $users = $stmt->fetchColumn();
        ?>
        <div class="display-4 fw-bold"><?= e($users) ?></div>
      </div>
    </div>
  </div>

  <hr>

  <a href="items/index.php" class="btn btn-primary">📦 Kelola Barang</a>
  <a href="transactions/index.php" class="btn btn-success">🔄 Transaksi</a>

  <?php if(is_super_admin()): ?>
    <a href="users/index.php" class="btn btn-warning">👤 Manajemen User</a>
  <?php endif; ?>

  <hr class="my-4">

  <!-- Laporan Section -->
  <h4 class="mb-3">📄 Laporan</h4>

  <div class="d-flex mb-3">
      <a href="reports/export_pdf.php?theme=light" class="btn btn-outline-dark theme-btn">
        ☀ Light PDF
      </a>
      <a href="reports/export_pdf.php?theme=dark" class="btn btn-dark theme-btn">
        🌙 Dark PDF
      </a>
  </div>

  <p class="text-muted">*Klik untuk mendownload laporan inventory otomatis.</p>

</div>

<?php include 'templates/footer.php'; ?>
