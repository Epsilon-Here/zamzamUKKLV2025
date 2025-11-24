<?php
require_once __DIR__ . '/../config.php';
require_login();
include __DIR__ . '/../templates/header.php';
$stmt = $pdo->query('SELECT t.*, u.name as user_name, i.name as item_name FROM transactions t LEFT JOIN users u ON u.id=t.user_id LEFT JOIN items i ON i.id=t.item_id ORDER BY t.id DESC');
$transactions = $stmt->fetchAll();
?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Transaksi</h3>
    <a href="create.php" class="btn btn-primary">Peminjaman</a>
  </div>
  <table class="table table-sm">
    <thead><tr><th>#</th><th>Item</th><th>User</th><th>Type</th><th>Tanggal</th><th>Dikembalikan</th><th>Aksi</th></tr></thead>
    <tbody>
      <?php foreach($transactions as $t): ?>
      <tr>
        <td><?= e($t['id']) ?></td>
        <td><?= e($t['item_name']) ?></td>
        <td><?= e($t['user_name']) ?></td>
        <td><?= e($t['type']) ?></td>
        <td><?= e($t['created_at']) ?></td>
        <td><?= e($t['returned_at'] ?? '-') ?></td>
        <td>
          <?php if($t['type']=='borrow' && !$t['returned_at']): ?>
            <a class="btn btn-sm btn-success" href="return.php?id=<?= e($t['id']) ?>">Kembalikan</a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>