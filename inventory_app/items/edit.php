<?php
require_once __DIR__ . '/../config.php';
require_login();
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM items WHERE id=?'); $stmt->execute([$id]);
$item = $stmt->fetch();
if(!$item){ header('Location: index.php'); exit; }
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $code = trim($_POST['code']); $name = trim($_POST['name']); $stock = (int)$_POST['stock'];
    if(!$code || !$name) $err='Kode dan nama wajib';
    else{
        $stmt = $pdo->prepare('UPDATE items SET code=?,name=?,stock=? WHERE id=?');
        $stmt->execute([$code,$name,$stock,$id]);
        header('Location: index.php'); exit;
    }
}
include __DIR__ . '/../templates/header.php';
?>
<div class="container py-4">
  <h3>Edit Barang</h3>
  <?php if($err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label>Kode</label><input name="code" class="form-control" value="<?= e($item['code']) ?>" required></div>
    <div class="mb-3"><label>Nama</label><input name="name" class="form-control" value="<?= e($item['name']) ?>" required></div>
    <div class="mb-3"><label>Stok</label><input name="stock" type="number" min="0" class="form-control" value="<?= e($item['stock']) ?>" required></div>
    <button class="btn btn-primary">Update</button>
  </form>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>