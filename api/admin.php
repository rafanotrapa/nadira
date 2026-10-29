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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { background: #f8fafc; }
        .admin-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem; padding-bottom:1rem; border-bottom:1px solid #e2e8f0; }
        .admin-title h1 { font-size:2rem; margin:0; font-family:var(--font-display); }
        .admin-subtitle { color:#64748b; margin:0.5rem 0 0 0; }
        .admin-wrap { max-width:1200px; margin:0 auto; padding:2rem; }
        .admin-card { background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:2rem; margin-bottom:2rem; box-shadow:0 1px 3px rgba(0,0,0,0.05); }
        .login-container { max-width:400px; margin:6rem auto; }
        .btn-login { width:100%; background:#b91c1c; color:#fff; padding:14px; border:none; border-radius:6px; font-weight:700; cursor:pointer; font-size:1rem; }
        .btn-login:hover { background:#991b1b; }
        .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem; margin-bottom:2rem; }
        .stat-card { background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:1.5rem; text-align:center; }
        .stat-value { font-size:2.5rem; font-weight:700; color:#1e293b; }
        .stat-label { font-size:0.85rem; color:#64748b; margin-top:0.25rem; }
        table { width:100%; border-collapse:collapse; }
        th, td { padding:14px 12px; text-align:left; border-bottom:1px solid #e2e8f0; }
        th { font-weight:600; color:#475569; background:#f8fafc; }
        .badge { display:inline-block; padding:4px 10px; border-radius:20px; font-size:0.75rem; font-weight:700; }
        .badge-received { background:#e0e7ff; color:#4f46e5; }
        .badge-review { background:#fef3c7; color:#d97706; }
        .badge-resolved { background:#dcfce7; color:#16a34a; }
        .action-select { padding:8px 12px; border:1px solid #d1d5db; border-radius:6px; font-size:0.85rem; cursor:pointer; background:#fff; color:#1e293b; outline:none; min-width:140px; }
        .action-select:hover { border-color:#94a3b8; }
        .logout-link { color:#dc2626; font-weight:600; text-decoration:none; }
        .empty-state { text-align:center; padding:3rem; color:#64748b; }
        .custom-select { position:relative; }
        .custom-select::after { content:''; position:absolute; right:12px; top:50%; transform:translateY(-50%); width:6px; height:6px; border-right:2px solid #64748b; border-bottom:2px solid #64748b; transform:rotate(45deg); pointer-events:none; }
        .btn-quick { background:#0f172a; color:#fff; padding:6px 12px; border-radius:4px; font-size:0.8rem; border:none; cursor:pointer; }
    </style>
</head>
<body>

<nav class="site-nav" style="background:#fff;">
    <div class="nav-inner" style="max-width:100%; padding:0 2rem;">
        <a href="/" class="nav-brand">BRITAKAN <span style="color:#b91c1c;">Admin</span></a>
        <?php if ($isLoggedIn): ?>
            <div style="display:flex; align-items:center; gap:1.5rem;">
                <span style="font-size:0.9rem; color:#475569;">Logged in as <strong><?= htmlspecialchars($_SESSION['admin_user']) ?></strong></span>
                <a href="?logout=1" class="logout-link">Logout</a>
            </div>
        <?php endif; ?>
    </div>
</nav>

<div class="admin-wrap" style="margin-top:calc(var(--nav-height) + 2rem);">
    
    <?php if (!$isLoggedIn): ?>
        
        <div class="login-container">
            <div class="admin-card">
                <h1 style="font-size:2rem; margin-bottom:0.5rem; font-family:var(--font-display);">Admin Login</h1>
                <p style="color:#64748b; margin-bottom:2rem;">Masuk untuk mengakses dashboard laporan</p>
                
                <?php if ($error): ?>
                    <div style="background:#fef2f2; color:#dc2626; padding:12px; border-radius:6px; margin-bottom:1rem; font-size:0.9rem;"><?= $error ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div style="margin-bottom:1.25rem;">
                        <label for="username" style="display:block; font-weight:600; margin-bottom:6px;">Username</label>
                        <input type="text" id="username" name="username" required value="admin"
                               style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:6px; font-size:1rem;">
                    </div>
                    <div style="margin-bottom:1.5rem;">
                        <label for="password" style="display:block; font-weight:600; margin-bottom:6px;">Password</label>
                        <input type="password" id="password" name="password" required 
                               style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:6px; font-size:1rem;"
                               placeholder="britakan2026">
                    </div>
                    <button type="submit" name="login" class="btn-login">Login Dashboard</button>
                </form>
                
                <div style="margin-top:1.5rem; padding-top:1.5rem; border-top:1px solid #e2e8f0; font-size:0.85rem; color:#64748b; text-align:center;">
                    Demo credentials: <code style="background:#f1f5f9; padding:2px 6px; border-radius:3px;">admin</code> / <code style="background:#f1f5f9; padding:2px 6px; border-radius:3px;">britakan2026</code>
                </div>
            </div>
        </div>
        
    <?php else: ?>
        
        <div class="admin-header">
            <div>
                <h1 style="font-size:2rem; margin:0; font-family:var(--font-display);">Dashboard Laporan</h1>
                <p style="color:#64748b; margin:0.5rem 0 0 0;">Kelola dan tinjau laporan insiden BRITAKAN</p>
            </div>
            <div style="text-align:right;">
                <button onclick="window.print()" class="btn-quick">Print</button>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value" id="total-reports">0</div>
                <div class="stat-label">Total Reports</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color:#4f46e5" id="received-count">0</div>
                <div class="stat-label">Received</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color:#d97706" id="review-count">0</div>
                <div class="stat-label">In Review</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color:#16a34a" id="resolved-count">0</div>
                <div class="stat-label">Resolved</div>
            </div>
        </div>
        
        <div class="admin-card">
            <table>
                <thead>
                    <tr>
                        <th>Ref ID</th>
                        <th>Kategori</th>
                        <th>Role</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aktivitas</th>
                    </tr>
                </thead>
                <tbody id="reports-body">
                    <tr><td colspan="7" style="text-align:center; padding:2rem; color:#64748b;">Loading reports...</td></tr>
                </tbody>
            </table>
        </div>
        
        <script>
            const sampleReports = [
                { id: 1, reference_id: 'BRITAKAN-DEMO-001', category: 'Bullying', role: 'I experienced', description: 'Dirangedem di sekolah oleh teman sekelas secara berulang.', status: 'Received', created_at: '2026-10-28 09:15:00' },
                { id: 2, reference_id: 'BRITAKAN-DEMO-002', category: 'Cyberbullying', role: 'Witness', description: 'Melihat adik saya mendapatkan pesan merendahkan di Instagram.', status: 'Initial Review', created_at: '2026-10-28 11:30:00' },
                { id: 3, reference_id: 'BRITAKAN-DEMO-003', category: 'Sexual Harassment', role: 'I experienced', description: 'Guru pria memberikan komentar tidak pantas tentang pakaian saya.', status: 'Resolved', created_at: '2026-10-27 14:20:00' },
                { id: 4, reference_id: 'BRITAKAN-DEMO-004', category: 'Bullying', role: 'Seeking help', description: 'Teman saya sering dikecualikan dari grup belajar.', status: 'Received', created_at: '2026-10-28 08:45:00' },
                { id: 5, reference_id: 'BRITAKAN-DEMO-005', category: 'Cyberbullying', role: 'I experienced', description: 'Akun palsu membuat postingan menjelek-jelekkan saya.', status: 'Initial Review', created_at: '2026-10-26 16:00:00' },
                { id: 6, reference_id: 'BRITAKAN-DEMO-006', category: 'Sexual Harassment', role: 'Witness', description: 'Melihat siswa laki-laki memegang lengan siswi perempuan tanpa izin.', status: 'Resolved', created_at: '2026-10-25 10:30:00' },
                { id: 7, reference_id: 'BRITAKAN-DEMO-007', category: 'Other Safety', role: 'Seeking help', description: 'Khawatir dengan perilaku menyendiri teman sekelas.', status: 'Received', created_at: '2026-10-27 12:00:00' },
                { id: 8, reference_id: 'BRITAKAN-DEMO-008', category: 'Cyberbullying', role: 'I experienced', description: 'Kata-kata kasar di game online karena jago main.', status: 'In Review', created_at: '2026-10-28 07:20:00' },
            ];

            function renderReports() {
                let reports = JSON.parse(localStorage.getItem('britakan_reports') || '[]');
                if (reports.length === 0) {
                    reports = sampleReports;
                    localStorage.setItem('britakan_reports', JSON.stringify(reports));
                }

                // Update stats
                document.getElementById('total-reports').innerText = reports.length;
                document.getElementById('received-count').innerText = reports.filter(r => r.status === 'Received').length;
                document.getElementById('review-count').innerText = reports.filter(r => r.status === 'Initial Review').length;
                document.getElementById('resolved-count').innerText = reports.filter(r => r.status === 'Resolved').length;

                const tbody = document.getElementById('reports-body');
                tbody.innerHTML = '';

                reports.forEach((r, index) => {
                    let badgeClass = 'badge-received';
                    if (r.status === 'Initial Review') badgeClass = 'badge-review';
                    if (r.status === 'Resolved') badgeClass = 'badge-resolved';

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td><code style="background:#f1f5f9; padding:4px 8px; border-radius:4px;">${r.reference_id}</code></td>
                        <td style="font-weight:500; color:#334155;">${r.category}</td>
                        <td style="color:#64748b;">${r.role}</td>
                        <td style="max-width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="${r.description}">${r.description}</td>
                        <td><span class="badge ${badgeClass}">${r.status}</span></td>
                        <td style="white-space:nowrap; color:#64748b;">${r.created_at}</td>
                        <td>
                            <div class="custom-select">
                                <select class="action-select" onchange="updateStatus('${r.reference_id}', this.value)">
                                    <option value="Received" ${r.status === 'Received' ? 'selected' : ''}>Received</option>
                                    <option value="Initial Review" ${r.status === 'Initial Review' ? 'selected' : ''}>In Review</option>
                                    <option value="Resolved" ${r.status === 'Resolved' ? 'selected' : ''}>Resolved</option>
                                </select>
                            </div>
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
                    // Show quick feedback (optional)
                }
            }

            document.addEventListener('DOMContentLoaded', renderReports);
        </script>

    <?php endif; ?>
    
</div>

</body>
</html>
