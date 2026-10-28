<?php
/**
 * api/admin.php — Secure Admin Dashboard
 * BRITAKAN Platform
 */

declare(strict_types=1);

session_start();
require_once __DIR__ . '/db.php';

// Handle login submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $admin['username'];
            header('Location: /admin');
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /admin');
    exit;
}

// Handle status update
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $reportId = (int) $_POST['report_id'];
    $newStatus = trim($_POST['status']);
    if ($pdo) {
        $stmt = $pdo->prepare("UPDATE reports SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $reportId]);
        header('Location: /admin');
        exit;
    }
}

$isLoggedIn = $_SESSION['admin_logged_in'] ?? false;
$reports = [];
if ($isLoggedIn && $pdo) {
    $stmt = $pdo->query("SELECT * FROM reports ORDER BY created_at DESC");
    $reports = $stmt->fetchAll();
}
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRITAKAN &mdash; Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { background: #f8fafc; }
        .admin-wrap { max-width: 1200px; margin: 4rem auto; padding: 2rem; }
        .admin-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 2rem; margin-bottom: 2rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 0.9rem; }
        th { font-weight: 600; color: #475569; background: #f1f5f9; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700; background: #e2e8f0; color: #334155; }
        .badge-review { background: #fef3c7; color: #d97706; }
        .badge-resolved { background: #dcfce7; color: #16a34a; }
    </style>
</head>
<body>

<nav class="site-nav" style="background:#fff;">
    <div class="nav-inner">
        <a href="/" class="nav-brand">BRITAKAN <span>Admin</span></a>
        <?php if ($isLoggedIn): ?>
            <div>
                <span style="margin-right: 1rem; font-size: 0.9rem; font-weight: 600;"><?= htmlspecialchars($_SESSION['admin_user']) ?></span>
                <a href="?logout=1" style="font-size: 0.85rem; color: #dc2626; font-weight: 600;">Logout</a>
            </div>
        <?php endif; ?>
    </div>
</nav>

<div class="admin-wrap" style="margin-top: calc(var(--nav-height) + 2rem);">
    <?php if (!$isLoggedIn): ?>
        <div style="max-width: 400px; margin: 4rem auto;">
            <div class="admin-card">
                <h2 style="font-size: 1.75rem; margin-bottom: 1.5rem; font-family: var(--font-display);">Admin Login</h2>
                <?php if ($error): ?>
                    <div style="background: #fef2f2; color: #dc2626; padding: 10px; border-radius: 4px; font-size: 0.85rem; margin-bottom: 1rem;"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div style="margin-bottom: 1rem;">
                        <label>Username</label>
                        <input type="text" name="username" required style="width: 100%; padding: 10px; margin-top: 4px;">
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label>Password</label>
                        <input type="password" name="password" required style="width: 100%; padding: 10px; margin-top: 4px;">
                    </div>
                    <button type="submit" name="login" style="width: 100%; background: #b91c1c; color: #fff; padding: 12px; border: none; border-radius: 4px; font-weight: 600; cursor: pointer;">Login Dashboard</button>
                </form>
                <div style="margin-top: 1rem; font-size: 0.8rem; color: #64748b; text-align: center;">
                    Default login: <code>admin</code> / <code>britakan2026</code>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="admin-card">
            <h2 style="font-size: 2rem; margin-bottom: 0.5rem; font-family: var(--font-display);">Dashboard Laporan Insiden</h2>
            <p style="color: #64748b; margin-bottom: 2rem;">Kelola dan tinjau laporan yang masuk dari platform.</p>

            <table>
                <thead>
                    <tr>
                        <th>Ref ID</th>
                        <th>Kategori</th>
                        <th>Peran</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($reports)): ?>
                        <tr><td colspan="7" style="text-align: center; color: #64748b; padding: 2rem;">Belum ada laporan masuk.</td></tr>
                    <?php else: ?>
                        <?php foreach ($reports as $r): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($r['reference_id']) ?></strong></td>
                                <td><?= htmlspecialchars($r['category']) ?></td>
                                <td><?= htmlspecialchars($r['role']) ?></td>
                                <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($r['description']) ?>">
                                    <?= htmlspecialchars($r['description']) ?>
                                </td>
                                <td>
                                    <span class="badge <?= $r['status'] === 'Resolved' ? 'badge-resolved' : 'badge-review' ?>">
                                        <?= htmlspecialchars($r['status']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($r['created_at']) ?></td>
                                <td>
                                    <form method="POST" style="display:inline-flex; gap:6px;">
                                        <input type="hidden" name="report_id" value="<?= $r['id'] ?>">
                                        <select name="status" style="padding: 4px; font-size: 0.75rem;" onchange="this.form.submit()">
                                            <option value="Received" <?= $r['status'] === 'Received' ? 'selected' : '' ?>>Received</option>
                                            <option value="Initial Review" <?= $r['status'] === 'Initial Review' ? 'selected' : '' ?>>Initial Review</option>
                                            <option value="Resolved" <?= $r['status'] === 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                                        </select>
                                        <input type="hidden" name="update_status" value="1">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
