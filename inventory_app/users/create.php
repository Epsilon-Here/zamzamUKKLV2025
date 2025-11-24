<?php
require_once __DIR__ . '/../config.php';
require_login();
if(!is_super_admin()) die('Unauthorized');
$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=trim($_POST['name']); $email=trim($_POST['email']); $role=$_POST['role']; $pass=$_POST['password'];
    if(!$name||!$email||!$pass) $err='Lengkapi data';
    else{
        $hash = password_hash($pass,PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (name,email,password,role,created_at) VALUES (?,?,?,?,NOW())');
        $stmt->execute([$name,$email,$hash,$role]);
        header('Location: index.php'); exit;
    }
}
include __DIR__ . '/../templates/header.php';
?>
<div class="container py-4">
  <h3>Tambah User</h3>
  <?php if($err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label>Nama</label><input name="name" class="form-control" required></div>
    <div class="mb-3"><label>Email</label><input name="email" type="email" class="form-control" required></div>
    <div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control" required></div>
    <div class="mb-3"><label>Role</label>
      <select name="role" class="form-select">
        <option value="admin">Admin</option>
        <option value="super_admin">Super Admin</option>
      </select>
    </div>
    <button class="btn btn-success">Simpan</button>
  </form>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>