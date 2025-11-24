<?php
require_once __DIR__ . '/../config.php';
require_login();
include __DIR__ . '/../templates/header.php';
$stmt = $pdo->query('SELECT * FROM items ORDER BY id DESC');
$items = $stmt->fetchAll();
?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Barang</h3>
    <a href="create.php" class="btn btn-success">Tambah Barang</a>
  </div>
  <table class="table table-striped table-hover">
    <thead><tr><th>#</th><th>Kode</th><th>Nama</th><th>Stok</th><th>Aksi</th></tr></thead>
    <tbody>
      <?php foreach($items as $it): ?>
      <tr>
        <td><?= e($it['id']) ?></td>
        <td><?= e($it['code']) ?></td>
        <td><?= e($it['name']) ?></td>
        <td><?= e($it['stock']) ?></td>
        <td>
          <a class="btn btn-sm btn-primary" href="edit.php?id=<?= e($it['id']) ?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?= e($it['id']) ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>