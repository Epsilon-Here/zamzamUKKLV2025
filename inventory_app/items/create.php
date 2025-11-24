<?php
require_once __DIR__ . '/../config.php';
require_login();
$err = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $code = trim($_POST['code']);
    $name = trim($_POST['name']);
    $stock = (int)$_POST['stock'];
    if(!$code || !$name){ $err='Kode dan nama wajib diisi'; }
    else{
        $stmt = $pdo->prepare('INSERT INTO items (code,name,stock) VALUES (?,?,?)');
        $stmt->execute([$code,$name,$stock]);
        header('Location: index.php'); exit;
    }
}
include __DIR__ . '/../templates/header.php';
?>
<div class="container py-4">
  <h3>Tambah Barang</h3>
  <?php if($err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label>Kode</label><input name="code" class="form-control" required></div>
    <div class="mb-3"><label>Nama</label><input name="name" class="form-control" required></div>
    <div class="mb-3"><label>Stok</label><input name="stock" type="number" min="0" class="form-control" value="0" required></div>
    <button class="btn btn-success">Simpan</button>
  </form>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>