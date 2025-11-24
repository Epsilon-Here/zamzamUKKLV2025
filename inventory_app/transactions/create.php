<?php
require_once __DIR__ . '/../config.php';
require_login();
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $item_id=(int)$_POST['item_id'];
    $user_id=(int)$_POST['user_id'];
    $type=$_POST['type'];
    // validate stock
    $stmt=$pdo->prepare('SELECT stock FROM items WHERE id=?'); $stmt->execute([$item_id]); $it=$stmt->fetch();
    if(!$it){ $err='Item tidak ditemukan'; }
    else if($type==='borrow' && $it['stock']<=0){ $err='Stok tidak cukup'; }
    else {
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('INSERT INTO transactions (item_id,user_id,type,created_at) VALUES (?,?,?,NOW())');
            $stmt->execute([$item_id,$user_id,$type]);
            if($type==='borrow'){
                $pdo->prepare('UPDATE items SET stock = stock - 1 WHERE id = ?')->execute([$item_id]);
            } else {
                $pdo->prepare('UPDATE items SET stock = stock + 1 WHERE id = ?')->execute([$item_id]);
            }
            $pdo->commit();
            header('Location: index.php'); exit;
        } catch(Exception $e){
            $pdo->rollBack();
            $err = 'Transaksi gagal: ' . $e->getMessage();
        }
    }
}
$items = $pdo->query('SELECT id,name,stock FROM items')->fetchAll();
$users = $pdo->query('SELECT id,name FROM users')->fetchAll();
include __DIR__ . '/../templates/header.php';
?>
<div class="container py-4">
  <h3>Transaksi Baru</h3>
  <?php if($err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label>Item</label>
      <select name="item_id" class="form-select">
        <?php foreach($items as $it): ?>
          <option value="<?= e($it['id']) ?>"><?= e($it['name']) ?> (stok: <?= e($it['stock']) ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3"><label>User</label>
      <select name="user_id" class="form-select">
        <?php foreach($users as $u): ?>
          <option value="<?= e($u['id']) ?>"><?= e($u['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3"><label>Jenis</label>
      <select name="type" class="form-select">
        <option value="borrow">Peminjaman</option>
        <option value="return">Pengembalian</option>
      </select>
    </div>
    <button class="btn btn-primary">Proses</button>
  </form>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>