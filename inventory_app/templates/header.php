<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventaris</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="/inventory_app/assets/css/style.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    
    <!-- Brand -->
    <a class="navbar-brand" href="/inventory_app/">Inventaris</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <?php if (is_logged_in()): ?>

          <!-- ✅ Menu Home -->
          <li class="nav-item">
            <a class="nav-link" href="/inventory_app/index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/inventory_app/items/index.php">Barang</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/inventory_app/transactions/index.php">Transaksi</a>
          </li>

          <?php if (is_super_admin()): ?>
            <li class="nav-item">
              <a class="nav-link" href="/inventory_app/users/index.php">Users</a>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link" href="/inventory_app/auth/logout.php">Logout</a>
          </li>

        <?php else: ?>

          <li class="nav-item">
            <a class="nav-link" href="/inventory_app/auth/login.php">Login</a>
          </li>

        <?php endif; ?>

      </ul>
    </div>

  </div>
</nav>
