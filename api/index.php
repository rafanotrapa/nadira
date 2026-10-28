<?php
/**
 * index.php — BRITAKAN Platform Main Entry Point
 * Youth Advocacy, Safety Education, and Support Platform
 * Founder/Initiator: Nadira Britania
 */

declare(strict_types=1);

session_start();

// Handle language selection
$lang = $_GET['lang'] ?? 'id';
if (!in_array($lang, ['id', 'en'], true)) {
    $lang = 'id';
}

$articles = require __DIR__ . '/../data/articles.php';
$content  = require __DIR__ . '/../data/content.php';
require_once __DIR__ . '/db.php';

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    if ($_POST['action'] === 'submit_report') {
        $category = trim($_POST['category'] ?? '');
        $role = trim($_POST['role'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($category && $role && $description) {
            $refId = 'BRITAKAN-' . strtoupper(substr(md5(uniqid()), 0, 6));
            if ($pdo) {
                $stmt = $pdo->prepare("INSERT INTO reports (reference_id, category, role, description) VALUES (?, ?, ?, ?)");
                $stmt->execute([$refId, $category, $role, $description]);
            }
            echo json_encode(['success' => true, 'ref_id' => $refId]);
            exit;
        }
        echo json_encode(['success' => false, 'error' => 'Invalid inputs']);
        exit;
    }

    if ($_POST['action'] === 'track_report') {
        $refId = trim($_POST['ref_id'] ?? '');
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT reference_id, category, status, created_at FROM reports WHERE reference_id = ?");
            $stmt->execute([$refId]);
            $report = $stmt->fetch();
            if ($report) {
                echo json_encode(['success' => true, 'report' => $report]);
                exit;
            }
        }
        echo json_encode(['success' => false, 'error' => 'Report not found']);
        exit;
    }

    if ($_POST['action'] === 'admin_login') {
        $user = trim($_POST['username'] ?? '');
        $pass = trim($_POST['password'] ?? '');
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
            $stmt->execute([$user]);
            $admin = $stmt->fetch();
            if ($admin && password_verify($pass, $admin['password_hash'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user'] = $admin['username'];
                echo json_encode(['success' => true]);
                exit;
            }
        }
        echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
        exit;
    }
}

function encode_data(mixed $value): string {
    if (is_array($value)) {
        return htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');
    }
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?><!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BRITAKAN — No Voice Left Unheard. Youth Advocacy, Safety Education, and Support Platform initiated by Nadira Britania.">
    <meta name="author" content="Nadira Britania">

    <title>BRITAKAN &mdash; No Voice Left Unheard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="loading">

<!-- Quick Exit Fullscreen Shield -->
<div id="quick-exit-screen" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:#fff; z-index:999999; text-align:center; padding-top:10vh;">
    <h1>BBC Weather &mdash; London</h1>
    <p>Loading weather forecast details...</p>
</div>

<!-- ============================================================
     NAVIGATION
     ============================================================ -->
<nav class="site-nav" role="navigation" aria-label="Main Navigation">
    <div class="nav-inner">
        <a href="#hero" class="nav-brand" aria-label="BRITAKAN Home">
            BRITAKAN<span>.</span>
        </a>

        <!-- Desktop links -->
        <ul class="nav-links" role="list">
            <li><a href="#hero"><?= $content['nav']['home'] ?></a></li>
            <li><a href="#about"><?= $content['nav']['about'] ?></a></li>
            <li><a href="#learn"><?= $content['nav']['learn'] ?></a></li>
            <li><a href="#help"><?= $content['nav']['help'] ?></a></li>
            <li><a href="#report"><?= $content['nav']['report'] ?></a></li>
            <li><a href="#resources"><?= $content['nav']['resources'] ?></a></li>
            <li><a href="#contact"><?= $content['nav']['contact'] ?></a></li>
        </ul>

        <div class="header-actions">
            <!-- Language Switcher -->
            <div class="lang-switch">
                <a href="?lang=id" class="<?= $lang === 'id' ? 'active' : '' ?>">ID</a>
                <a href="?lang=en" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
            </div>

            <!-- Login Modals Trigger -->
            <button onclick="toggleModal('track-modal')" style="font-size:0.8rem; font-weight:600; background:none; border:1px solid #d1d5db; padding:4px 8px; border-radius:4px; cursor:pointer;">
                Track Report
            </button>

            <!-- Quick Exit Button -->
            <button id="quick-exit-btn" class="quick-exit-btn">
                <?= $content['nav']['quick_exit'] ?>
            </button>
        </div>

        <!-- Mobile hamburger -->
        <button class="nav-toggle" id="nav-toggle" aria-controls="nav-drawer" aria-expanded="false" aria-label="Open menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile nav drawer -->
<div class="nav-drawer" id="nav-drawer" role="dialog" aria-label="Mobile Navigation Menu" aria-hidden="true">
    <a href="#hero"><?= $content['nav']['home'] ?></a>
    <a href="#about"><?= $content['nav']['about'] ?></a>
    <a href="#learn"><?= $content['nav']['learn'] ?></a>
    <a href="#help"><?= $content['nav']['help'] ?></a>
    <a href="#report"><?= $content['nav']['report'] ?></a>
    <a href="#resources"><?= $content['nav']['resources'] ?></a>
    <a href="#contact"><?= $content['nav']['contact'] ?></a>
    <a href="#" onclick="toggleModal('track-modal')">Track Report</a>
    <a href="#" onclick="toggleModal('admin-modal')">Admin Login</a>
    <a href="#" id="mobile-quick-exit" style="color: #dc2626; font-weight:700;"><?= $content['nav']['quick_exit'] ?></a>
</div>


<!-- HERO SECTION -->
<section id="hero" class="hero">
    <div class="hero-grid">
        <div class="hero-copy">
            <div class="hero-eyebrow">
                <span class="hero-eyebrow-line"></span>
                <span class="label-meta">Youth Advocacy Initiative</span>
            </div>
            <h1 class="hero-name" style="font-size: clamp(2.5rem, 5vw, 4rem); line-height: 1.1;">
                <span class="name-part">NO VOICE</span>
                <em class="name-accent">LEFT UNHEARD.</em>
            </h1>
            <p class="hero-title" style="font-size: 1.1rem; line-height: 1.6; margin-top: 1.5rem; opacity: 0.85;">
                <?= $content['hero']['subheadline'] ?>
            </p>
            <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                <a href="#help" class="hero-cta" style="background: var(--accent, #b91c1c); color: #fff; padding: 12px 24px; border-radius: 4px; text-decoration: none;">
                    <?= $content['hero']['cta_primary'] ?>
                </a>
                <a href="#learn" class="hero-cta" style="background: transparent; border: 1px solid currentColor; padding: 12px 24px; border-radius: 4px; text-decoration: none;">
                    <?= $content['hero']['cta_secondary'] ?>
                </a>
            </div>
        </div>
        <div class="hero-image-wrap" role="img" aria-label="BRITAKAN advocacy banner">
            <img src="/assets/img/hero.jpg" alt="BRITAKAN Initiative" width="720" height="960" loading="eager" fetchpriority="high">
        </div>
    </div>
</section>


<!-- REPORT AN INCIDENT FORM -->
<section id="report" class="section section-alt">
    <div class="container" style="max-width: 800px;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2 class="advocacy-heading" style="font-size: 2.5rem;"><?= $content['report']['heading'] ?></h2>
            <p class="advocacy-subtitle" style="margin-top: 0.5rem;"><?= $content['report']['intro'] ?></p>
        </div>

        <div style="background: #fff; padding: 2.5rem; border-radius: 8px; border: 1px solid #e5e7eb;">
            <form id="report-form" onsubmit="submitReport(event)">
                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;"><?= $content['report']['form']['category']['label'] ?></label>
                    <select name="category" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px;">
                        <option value="">Select category...</option>
                        <?php foreach ($content['report']['form']['category']['options'] as $opt): ?>
                            <option value="<?= $opt ?>"><?= $opt ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;"><?= $content['report']['form']['role']['label'] ?></label>
                    <select name="role" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px;">
                        <option value="">Select role...</option>
                        <?php foreach ($content['report']['form']['role']['options'] as $opt): ?>
                            <option value="<?= $opt ?>"><?= $opt ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Incident Details</label>
                    <textarea name="description" rows="4" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px;"></textarea>
                </div>

                <button type="submit" style="background: var(--accent, #b91c1c); color: #fff; border: none; padding: 12px 24px; border-radius: 4px; font-weight: 600; cursor: pointer; width: 100%;">
                    <?= $content['report']['form']['submit'] ?>
                </button>
            </form>

            <div id="report-result" style="display: none; text-align: center; padding: 1rem;">
                <h3 style="color: #16a34a; font-size: 1.5rem; margin-bottom: 0.5rem;">Report Submitted Successfully</h3>
                <p>Your unique reference ID is:</p>
                <div id="res-ref" style="font-weight: 700; font-size: 1.25rem; font-family: monospace; background: #f3f4f6; padding: 8px; margin: 1rem 0; border-radius: 4px;"></div>
                <p style="font-size: 0.85rem; color: #6b7280;">Save this ID to track your report status anytime.</p>
            </div>
        </div>
    </div>
</section>


<!-- REPORT TRACKING MODAL -->
<div id="track-modal" class="lightbox-backdrop" style="display:none; align-items:center; justify-center:center;">
    <div class="lightbox-panel" style="max-width: 450px; padding: 2rem;">
        <button onclick="toggleModal('track-modal')" class="lightbox-close">&times;</button>
        <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.75rem; margin-bottom: 1rem;">Track Report Status</h3>
        <form onsubmit="trackReport(event)">
            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Reference ID</label>
                <input type="text" id="track-ref" placeholder="e.g. BRITAKAN-DEMO-9999" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
            </div>
            <button type="submit" style="width:100%; background:#000; color:#fff; border:none; padding:10px; border-radius:4px; font-weight:600; cursor:pointer;">Search</button>
        </form>
        <div id="track-result" style="margin-top:1rem; font-size:0.9rem;"></div>
    </div>
</div>


<!-- ADMIN LOGIN MODAL -->
<div id="admin-modal" class="lightbox-backdrop" style="display:none; align-items:center; justify-center:center;">
    <div class="lightbox-panel" style="max-width: 400px; padding: 2rem;">
        <button onclick="toggleModal('admin-modal')" class="lightbox-close">&times;</button>
        <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.75rem; margin-bottom: 1rem;">Admin Portal</h3>
        <form onsubmit="adminLogin(event)">
            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Username</label>
                <input type="text" id="admin-user" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Password</label>
                <input type="password" id="admin-pass" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
            </div>
            <button type="submit" style="width:100%; background:#b91c1c; color:#fff; border:none; padding:10px; border-radius:4px; font-weight:600; cursor:pointer;">Login</button>
        </form>
        <div id="admin-error" style="color:#dc2626; margin-top:0.5rem; font-size:0.85rem;"></div>
    </div>
</div>


<!-- FOOTER -->
<footer class="site-footer">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
            <p>&copy; <?= date('Y') ?> BRITAKAN &mdash; Nadira Britania.</p>
            <button onclick="toggleModal('admin-modal')" style="color:rgba(255,255,255,0.5); font-size:0.8rem; background:none; border:none; cursor:pointer;">Admin Login</button>
        </div>
    </div>
</footer>

<script>
    function toggleModal(id) {
        const el = document.getElementById(id);
        el.style.display = el.style.display === 'flex' ? 'none' : 'flex';
    }

    // Quick Exit
    document.getElementById('quick-exit-btn').addEventListener('click', () => {
        document.getElementById('quick-exit-screen').style.display = 'block';
        window.location.replace('https://www.bbc.com/weather');
    });

    // Report Submission
    function submitReport(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        formData.append('action', 'submit_report');

        fetch('', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('report-form').style.display = 'none';
                    document.getElementById('res-ref').innerText = data.ref_id;
                    document.getElementById('report-result').style.display = 'block';
                }
            });
    }

    // Report Tracking
    function trackReport(e) {
        e.preventDefault();
        const refId = document.getElementById('track-ref').value;
        const formData = new FormData();
        formData.append('action', 'track_report');
        formData.append('ref_id', refId);

        fetch('', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                const resEl = document.getElementById('track-result');
                if (data.success) {
                    resEl.innerHTML = `<div style="background:#f0fdf4; padding:10px; border-radius:4px; border:1px solid #bbf7d0;">
                        <strong>Status:</strong> ${data.report.status}<br>
                        <strong>Category:</strong> ${data.report.category}<br>
                        <small>Submitted: ${data.report.created_at}</small>
                    </div>`;
                } else {
                    resEl.innerHTML = `<div style="color:#dc2626;">Report reference ID not found.</div>`;
                }
            });
    }

    // Admin Login
    function adminLogin(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append('action', 'admin_login');
        formData.append('username', document.getElementById('admin-user').value);
        formData.append('password', document.getElementById('admin-pass').value);

        fetch('', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Login successful! Redirecting to dashboard...');
                    location.reload();
                } else {
                    document.getElementById('admin-error').innerText = data.error;
                }
            });
    }
</script>
</body>
</html>
