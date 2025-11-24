<?php
require_once __DIR__ . '/../config.php';
require_login();
if(!is_super_admin()){ die('Unauthorized'); }
include __DIR__ . '/../templates/header.php';
$stmt = $pdo->query('SELECT id,name,email,role,created_at FROM users ORDER BY id DESC');
$users = $stmt->fetchAll();
?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Manajemen User</h3>
    <a href="create.php" class="btn btn-success">Tambah User</a>
  </div>
  <table class="table table-sm">
    <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Created</th><th>Aksi</th></tr></thead>
    <tbody>
      <?php foreach($users as $u): ?>
      <tr>
        <td><?= e($u['id']) ?></td>
        <td><?= e($u['name']) ?></td>
        <td><?= e($u['email']) ?></td>
        <td><?= e($u['role']) ?></td>
        <td><?= e($u['created_at']) ?></td>
        <td>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?= e($u['id']) ?>" onclick="return confirm('Hapus user?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>