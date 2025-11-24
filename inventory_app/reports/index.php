<?php include "../config.php"; ?>

<h2>📊 Laporan Data Inventory</h2>

<form method="GET" action="index.php">
    <label>Dari Tanggal</label>
    <input type="date" name="from">

    <label>Sampai Tanggal</label>
    <input type="date" name="to">

    <label>Kategori</label>
    <select name="category">
        <option value="">Semua</option>
        <?php 
        $q = $conn->query("SELECT DISTINCT category FROM items");
        while($r = $q->fetch_assoc()) echo "<option>{$r['category']}</option>";
        ?>
    </select>

    <label>User</label>
    <select name="user">
        <option value="">Semua</option>
        <?php 
        $u = $conn->query("SELECT username FROM users");
        while($row = $u->fetch_assoc()) echo "<option>{$row['username']}</option>";
        ?>
    </select>

    <button type="submit">🔍 Filter</button>
</form>

<br>

<a href="export_pdf.php?<?php echo $_SERVER['QUERY_STRING']; ?>" class="btn">📄 Download PDF</a>
<a href="export_excel.php?<?php echo $_SERVER['QUERY_STRING']; ?>" class="btn">📊 Download Excel</a>
