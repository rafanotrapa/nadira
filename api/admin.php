<?php
/**
 * api/admin.php — Secure Admin Dashboard
 */

declare(strict_types=1);

session_start();

$ADMIN_USER = 'admin';
$ADMIN_PASS = 'britakan2026';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === $ADMIN_USER && $password === $ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $username;
        header('Location: /admin');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /admin');
    exit;
}

$isLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
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
    </style>
</head>
<body>

<nav class="site-nav" style="background:#fff;">
    <div class="nav-inner" style="max-width: 100%; padding: 0 2rem;">
        <a href="/" class="nav-brand">BRITAKAN <span style="color:#b91c1c;">Admin</span></a>
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
                    <div style="background:#fef2f2; color:#dc2626; padding:12px; border-radius:6px; margin-bottom:1rem; font-size:0.9rem;"><?= $error ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div style="margin-bottom: 1.25rem;">
                        <label for="username" style="display:block; font-weight:600; margin-bottom:6px;">Username</label>
                        <input type="text" id="username" name="username" required value="admin"
                               style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:6px; font-size:1rem;">
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display:block; font-weight:600; margin-bottom:6px;">Password</label>
                        <input type="password" id="password" name="password" required 
                               style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:6px; font-size:1rem;"
                               placeholder="britakan2026">
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
                <h1 style="font-size: 2rem; margin: 0; font-family: var(--font-display);">Dashboard Laporan Insiden</h1>
                <p style="color: #64748b; margin: 0.5rem 0 0 0;">Kelola dan tinjau laporan yang masuk</p>
            </div>
            <div style="text-align: right;">
                <div id="report-count" style="font-size: 2rem; font-weight: 700; color: #1e293b;">0</div>
                <div style="font-size: 0.8rem; color: #64748b;">Total Reports</div>
            </div>
        </div>
        
        <div class="admin-card">
            <table id="reports-table">
                <thead>
                    <tr>
                        <th>Reference ID</th>
                        <th>Kategori</th>
                        <th>Peran Pelapor</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi Update Status</th>
                    </tr>
                </thead>
                <tbody id="reports-body">
                    <tr><td colspan="7" style="text-align:center; padding:2rem;">Loading reports...</td></tr>
                </tbody>
            </table>
        </div>
        
        <script>
            function renderReports() {
                let reports = JSON.parse(localStorage.getItem('britakan_reports') || '[]');
                
                // Add sample report if empty
                if (reports.length === 0) {
                    reports = [{
                        id: 1,
                        reference_id: 'BRITAKAN-DEMO',
                        category: 'Bullying',
                        role: 'I experienced the incident',
                        description: 'Laporan perundungan demo.',
                        status: 'Received',
                        created_at: '2026-10-28 12:00:00'
                    }];
                    localStorage.setItem('britakan_reports', JSON.stringify(reports));
                }

                document.getElementById('report-count').innerText = reports.length;
                const tbody = document.getElementById('reports-body');
                tbody.innerHTML = '';

                reports.forEach((r, index) => {
                    let badgeClass = 'badge-received';
                    if (r.status === 'Initial Review') badgeClass = 'badge-review';
                    if (r.status === 'Resolved') badgeClass = 'badge-resolved';

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td><code style="background:#f1f5f9; padding:4px 8px; border-radius:4px;">${r.reference_id}</code></td>
                        <td>${r.category}</td>
                        <td>${r.role}</td>
                        <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${r.description}</td>
                        <td><span class="badge ${badgeClass}">${r.status}</span></td>
                        <td>${r.created_at}</td>
                        <td>
                            <select class="status-select" onchange="updateStatus('${r.reference_id}', this.value)">
                                <option value="Received" ${r.status === 'Received' ? 'selected' : ''}>Received</option>
                                <option value="Initial Review" ${r.status === 'Initial Review' ? 'selected' : ''}>In Review</option>
                                <option value="Resolved" ${r.status === 'Resolved' ? 'selected' : ''}>Resolved</option>
                            </select>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            function updateStatus(refId, newStatus) {
                let reports = JSON.parse(localStorage.getItem('britakan_reports') || '[]');
                const report = reports.find(r => r.reference_id === refId);
                if (report) {
                    report.status = newStatus;
                    localStorage.setItem('britakan_reports', JSON.stringify(reports));
                    renderReports();
                    alert('Status berhasil diubah!');
                }
            }

            document.addEventListener('DOMContentLoaded', renderReports);
        </script>

    <?php endif; ?>
    
</div>

</body>
</html>
