<?php
/**
 * api/admin.php — Secure Admin Dashboard
 * BRITAKAN Platform
 * 
 * Note: On Vercel serverless, sessions and SQLite don't persist between invocations.
 * This uses a simple hardcoded auth for demo purposes.
 */

declare(strict_types=1);

session_start();
require_once __DIR__ . '/db.php';

// Hardcoded admin credentials for Vercel demo
// In production, use environment variables and proper database
$ADMIN_USER = 'admin';
$ADMIN_PASS = 'britakan2026';

$error = '';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === $ADMIN_USER && $password === $ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $username;
        // Force redirect with full URL
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        header("Location: $protocol://$host/admin");
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /admin');
    exit;
}

// Handle status update
$isLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

if ($isLoggedIn && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $reportId = (int) $_POST['report_id'];
    $newStatus = $_POST['status'] ?? '';
    if ($pdo && $newStatus) {
        $stmt = $pdo->prepare("UPDATE reports SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $reportId]);
    }
    header('Location: /admin');
    exit;
}

// Fetch reports
$reports = [];
if ($isLoggedIn && $pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM reports ORDER BY created_at DESC");
        $reports = $stmt->fetchAll();
    } catch (PDOException $e) {
        // Table might not exist yet
    }
}
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRITAKAN &mdash; Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { background: #f8fafc; }
        .admin-wrap { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .admin-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .login-container { max-width: 400px; margin: 6rem auto; }
        .btn-login { width: 100%; background: #b91c1c; color: #fff; padding: 14px; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 1rem; transition: background 0.2s; }
        .btn-login:hover { background: #991b1b; }
        .btn-login:disabled { background: #ccc; cursor: not-allowed; }
        .error-msg { background: #fef2f2; color: #dc2626; padding: 12px; border-radius: 6px; margin-bottom: 1rem; font-size: 0.9rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 14px 12px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 0.9rem; }
        th { font-weight: 600; color: #475569; background: #f8fafc; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
        .badge-received { background: #e0e7ff; color: #4f46e5; }
        .badge-review { background: #fef3c7; color: #d97706; }
        .badge-resolved { background: #dcfce7; color: #16a34a; }
        .status-select { padding: 6px 8px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 0.8rem; cursor: pointer; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .logout-link { color: #dc2626; font-weight: 600; text-decoration: none; }
        .empty-state { text-align: center; padding: 3rem; color: #64748b; }
    </style>
</head>
<body>

<nav class="site-nav" style="background:#fff;">
    <div class="nav-inner" style="max-width: 100%; padding: 0 2rem;">
        <a href="/" class="nav-brand">BRITAKAN<span style="color:#b91c1c;">Admin</span></a>
        <?php if ($isLoggedIn): ?>
            <div style="display:flex; align-items:center; gap:1.5rem;">
                <span style="font-size: 0.9rem; color: #475569;">Logged in as <strong><?= htmlspecialchars($_SESSION['admin_user']) ?></strong></span>
                <a href="?logout=1" class="logout-link">Logout</a>
            </div>
        <?php endif; ?>
    </div>
</nav>

<div class="admin-wrap" style="margin-top: calc(var(--nav-height) + 2rem);">
    
    <?php if (!$isLoggedIn): ?>
        
        <div class="login-container">
            <div class="admin-card">
                <h1 style="font-size: 2rem; margin-bottom: 0.5rem; font-family: var(--font-display);">Admin Login</h1>
                <p style="color: #64748b; margin-bottom: 2rem;">Masuk untuk mengakses dashboard</p>
                
                <?php if ($error): ?>
                    <div class="error-msg"><?= $error ?></div>
                <?php endif; ?>
                
                <form method="POST" id="login-form">
                    <div style="margin-bottom: 1.25rem;">
                        <label for="username" style="display:block; font-weight:600; margin-bottom:6px;">Username</label>
                        <input type="text" id="username" name="username" required 
                               style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:6px; font-size:1rem;"
                               placeholder="Enter username">
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display:block; font-weight:600; margin-bottom:6px;">Password</label>
                        <input type="password" id="password" name="password" required 
                               style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:6px; font-size:1rem;"
                               placeholder="Enter password">
                    </div>
                    <button type="submit" name="login" class="btn-login">Login Dashboard</button>
                </form>
                
                <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; font-size: 0.85rem; color: #64748b; text-align: center;">
                    Demo credentials: <code style="background:#f1f5f9; padding:2px 6px; border-radius:3px;">admin</code> / <code style="background:#f1f5f9; padding:2px 6px; border-radius:3px;">britakan2026</code>
                </div>
            </div>
        </div>
        
    <?php else: ?>
        
        <div class="admin-header">
            <div>
                <h1 style="font-size: 2rem; margin: 0; font-family: var(--font-display);">Dashboard Laporan</h1>
                <p style="color: #64748b; margin: 0.5rem 0 0 0;">Kelola laporan insiden dari platform BRITAKAN</p>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 2rem; font-weight: 700; color: #1e293b;"><?= count($reports) ?></div>
                <div style="font-size: 0.8rem; color: #64748b;">Total Reports</div>
            </div>
        </div>
        
        <div class="admin-card">
            <?php if (empty($reports)): ?>
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" style="margin-bottom:1rem;">
                        <path d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <h3 style="color: #475569; margin-bottom: 0.5rem;">Belum ada laporan</h3>
                    <p>Laporan yang dikirim dari website akan muncul di sini.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Reference ID</th>
                            <th>Kategori</th>
                            <th>Peran Pelapor</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reports as $r): ?>
                            <tr>
                                <td><code style="background:#f1f5f9; padding:4px 8px; border-radius:4px; font-size:0.85rem;"><?= htmlspecialchars($r['reference_id']) ?></code></td>
                                <td><?= htmlspecialchars($r['category']) ?></td>
                                <td><?= htmlspecialchars($r['role']) ?></td>
                                <td style="max-width: 200px;">
                                    <span title="<?= htmlspecialchars($r['description']) ?>" style="display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                        <?= htmlspecialchars($r['description']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                        $statusClass = 'badge-received';
                                        if ($r['status'] === 'Initial Review') $statusClass = 'badge-review';
                                        if ($r['status'] === 'Resolved') $statusClass = 'badge-resolved';
                                    ?>
                                    <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($r['status']) ?></span>
                                </td>
                                <td style="white-space:nowrap;"><?= date('d M Y H:i', strtotime($r['created_at'])) ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="report_id" value="<?= $r['id'] ?>">
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="Received" <?= $r['status'] === 'Received' ? 'selected' : '' ?>>Received</option>
                                            <option value="Initial Review" <?= $r['status'] === 'Initial Review' ? 'selected' : '' ?>>In Review</option>
                                            <option value="Resolved" <?= $r['status'] === 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                                        </select>
                                        <input type="hidden" name="update_status" value="1">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        
    <?php endif; ?>
    
</div>

</body>
</html>
