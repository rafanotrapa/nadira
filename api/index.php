<?php
/**
 * index.php — BRITAKAN Platform Main Entry Point
 * Youth Advocacy, Safety Education, and Support Platform
 * Founder/Initiator: Nadira Britania
 */

declare(strict_types=1);

session_start();

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
    <title>BRITAKAN &mdash; No Voice Left Unheard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<!-- NAVIGATION -->
<nav class="site-nav" role="navigation" aria-label="Main Navigation">
    <div class="nav-inner">
        <a href="#hero" class="nav-brand">BRITAKAN<span>.</span></a>

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
            <div class="lang-switch">
                <a href="?lang=id" class="<?= $lang === 'id' ? 'active' : '' ?>">ID</a>
                <a href="?lang=en" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
            </div>
        </div>

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
                <a href="#help" class="hero-cta" style="background: var(--color-accent, #b91c1c); color: #fff; padding: 12px 24px; border-radius: 4px; text-decoration: none;">
                    <?= $content['hero']['cta_primary'] ?>
                </a>
                <a href="#learn" class="hero-cta" style="background: transparent; border: 1px solid currentColor; padding: 12px 24px; border-radius: 4px; text-decoration: none;">
                    <?= $content['hero']['cta_secondary'] ?>
                </a>
            </div>
        </div>
        <div class="hero-image-wrap">
            <img src="/assets/img/hero.jpg" alt="BRITAKAN Initiative" width="720" height="960" loading="eager">
        </div>
    </div>
</section>


<!-- WHY BRITAKAN EXISTS -->
<section id="about" class="section">
    <div class="container">
        <div class="about-grid">
            <div class="about-body">
                <p class="label-meta about-label">Founder: Nadira Britania</p>
                <h2 class="about-heading" style="font-size: 2.25rem; line-height: 1.2;">
                    <?= $content['why_exists']['heading'] ?>
                </h2>
                <p style="margin-top: 1.5rem; line-height: 1.7;">
                    <?= $content['why_exists']['body'] ?>
                </p>
                <div style="margin-top: 2rem;">
                    <a href="#learn" style="display:inline-block; border-bottom: 2px solid currentColor; padding-bottom: 2px; text-decoration: none; font-weight: 600;">
                        <?= $content['why_exists']['cta'] ?> &rarr;
                    </a>
                </div>
            </div>
            <div class="about-right">
                <div style="background: rgba(0,0,0,0.03); padding: 3rem; border-radius: 8px; border: 1px solid rgba(0,0,0,0.08);">
                    <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.75rem; margin-bottom: 1rem;">
                        <?= $content['about']['mission']['title'] ?>
                    </h3>
                    <p style="margin-bottom: 2rem; line-height: 1.6; opacity: 0.85;">
                        <?= $content['about']['mission']['body'] ?>
                    </p>
                    <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.75rem; margin-bottom: 1rem;">
                        <?= $content['about']['vision']['title'] ?>
                    </h3>
                    <p style="line-height: 1.6; opacity: 0.85;">
                        <?= $content['about']['vision']['body'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- THREE FOCUS AREAS -->
<section class="section section-alt">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 class="advocacy-heading"><?= $content['focus_areas']['heading'] ?></h2>
                <p class="advocacy-subtitle">Comprehensive educational resources across three critical areas.</p>
            </div>
        </div>

        <div class="focus-grid" role="list">
            <?php foreach ($content['focus_areas']['cards'] as $card): ?>
                <div class="focus-card" role="listitem">
                    <div>
                        <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.75rem; margin-bottom: 1rem;">
                            <?= $card['title'] ?>
                        </h3>
                        <p style="line-height: 1.6; opacity: 0.85; margin-bottom: 2rem;">
                            <?= $card['description'] ?>
                        </p>
                    </div>
                    <a href="#learn" style="display:inline-flex; align-items:center; gap:6px; font-weight:600; text-decoration:none;">
                        <?= $card['cta'] ?>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M1 6h10M7 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- HOW IT WORKS -->
<section class="section">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 class="advocacy-heading"><?= $content['how_it_works']['heading'] ?></h2>
                <p class="advocacy-subtitle"><?= $content['how_it_works']['supporting'] ?></p>
            </div>
        </div>

        <div class="steps-grid">
            <?php foreach ($content['how_it_works']['steps'] as $step): ?>
                <div class="step-card">
                    <div class="step-number"><?= $step['number'] ?></div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem;"><?= $step['title'] ?></h3>
                    <p style="font-size: 0.95rem; opacity: 0.85; line-height: 1.5;"><?= $step['description'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- LEARN & UNDERSTAND -->
<section id="learn" class="section section-alt">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 class="advocacy-heading"><?= $content['nav']['learn'] ?></h2>
                <p class="advocacy-subtitle">Reliable educational articles to help you understand your rights and options.</p>
            </div>
            <div class="advocacy-count"><?= sprintf('%02d', count($articles)) ?></div>
        </div>

        <div class="articles-grid" role="list">
            <?php foreach ($articles as $index => $article): ?>
                <?php
                    $is_featured = ($index === 0);
                    $tags_json   = encode_data($article['tags']);
                    $body_encoded = encode_data($article['body']);
                    $date_display = $article['date_label'];
                ?>

                <article
                    class="article-card"
                    role="listitem"
                    tabindex="0"
                    data-slug="<?= encode_data($article['slug']) ?>"
                    data-title="<?= encode_data($article['title']) ?>"
                    data-subtitle="<?= encode_data($article['subtitle']) ?>"
                    data-date="<?= encode_data($date_display) ?>"
                    data-time="<?= (int) $article['reading_time'] ?>"
                    data-tags="<?= $tags_json ?>"
                    data-body="<?= $body_encoded ?>"
                >
                    <?php if ($is_featured): ?>
                        <div class="article-card-left">
                            <div class="article-meta">
                                <span class="article-date"><?= htmlspecialchars($date_display) ?></span>
                                <span class="article-dot"></span>
                                <span class="article-time"><?= (int) $article['reading_time'] ?> min read</span>
                            </div>
                            <div class="article-tags">
                                <?php foreach ($article['tags'] as $i => $tag): ?>
                                    <span class="tag-pill <?= $i === 0 ? 'tag-primary' : '' ?>"><?= htmlspecialchars($tag) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <h3 class="article-title"><?= htmlspecialchars($article['title']) ?></h3>
                            <p class="article-subtitle"><?= htmlspecialchars($article['subtitle']) ?></p>
                            <span class="article-read-link" role="button">
                                Read Guide
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M1 6h10M7 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                        <div class="article-card-right">
                            <p class="article-excerpt"><?= htmlspecialchars($article['excerpt']) ?></p>
                        </div>
                    <?php else: ?>
                        <div class="article-number"><?= sprintf('%02d', $index + 1) ?></div>
                        <div class="article-meta">
                            <span class="article-date"><?= htmlspecialchars($date_display) ?></span>
                            <span class="article-dot"></span>
                            <span class="article-time"><?= (int) $article['reading_time'] ?> min</span>
                        </div>
                        <div class="article-tags">
                            <?php foreach ($article['tags'] as $i => $tag): ?>
                                <span class="tag-pill <?= $i === 0 ? 'tag-primary' : '' ?>"><?= htmlspecialchars($tag) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <h3 class="article-title"><?= htmlspecialchars($article['title']) ?></h3>
                        <p class="article-subtitle"><?= htmlspecialchars($article['subtitle']) ?></p>
                        <p class="article-excerpt"><?= htmlspecialchars($article['excerpt']) ?></p>
                        <span class="article-read-link" role="button">
                            Read Guide
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M1 6h10M7 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- GET HELP & SUPPORT -->
<section id="help" class="section">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 class="advocacy-heading"><?= $content['get_help']['heading'] ?></h2>
                <p class="advocacy-subtitle"><?= $content['get_help']['intro'] ?></p>
            </div>
        </div>

        <div class="support-grid">
            <?php foreach ($content['get_help']['cards'] as $card): ?>
                <div class="support-card <?= $card['type'] === 'danger' ? 'danger-card' : '' ?>">
                    <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; margin-bottom: 1rem; <?= $card['type'] === 'danger' ? 'color: #dc2626;' : '' ?>">
                        <?= $card['title'] ?>
                    </h3>
                    <p style="font-size: 0.95rem; line-height: 1.6; opacity: 0.85; margin-bottom: 1.5rem;">
                        <?= $card['body'] ?>
                    </p>
                    <?php if ($card['type'] === 'danger'): ?>
                        <a href="tel:112" style="display:inline-block; background:#dc2626; color:#fff; padding:8px 16px; border-radius:4px; text-decoration:none; font-size:0.85rem;">Emergency: Call 112</a>
                    <?php else: ?>
                        <a href="#report" style="font-weight:600; text-decoration:none;">Learn Options &rarr;</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- REPORT AN INCIDENT -->
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

                <button type="submit" style="background: var(--color-accent, #b91c1c); color: #fff; border: none; padding: 12px 24px; border-radius: 4px; font-weight: 600; cursor: pointer; width: 100%;">
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


<!-- RESOURCES -->
<section id="resources" class="section">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 class="advocacy-heading"><?= $content['resources']['heading'] ?></h2>
                <p class="advocacy-subtitle">Explore verified educational resources, guidelines, and external support services.</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 3rem;">
            <?php foreach ($content['resources']['categories'] as $cat): ?>
                <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 2rem;">
                    <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; margin-bottom: 1rem;"><?= $cat ?></h3>
                    <p style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 1.5rem;">Curated guides and verified references.</p>
                    <a href="https://rainn.org/" target="_blank" rel="noopener noreferrer" style="font-weight: 600; text-decoration: none;">External Reference (RAINN) &rarr;</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- CONTACT -->
<section id="contact" class="section section-alt">
    <div class="container" style="max-width: 800px;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <h2 class="advocacy-heading" style="font-size: 2.5rem;"><?= $content['contact']['heading'] ?></h2>
            <p class="advocacy-subtitle" style="max-width: 600px; margin: 1rem auto 0 auto;"><?= $content['contact']['body'] ?></p>
        </div>

        <div style="background: #fff; padding: 3rem; border-radius: 8px; border: 1px solid #e5e7eb;">
            <form onsubmit="alert('Thank you for your message. We will get back to you shortly.'); return false;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Name / Organization</label>
                        <input type="text" required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Email Address</label>
                        <input type="email" required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px;">
                    </div>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Purpose of Inquiry</label>
                    <select style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px;">
                        <option>General Inquiry</option>
                        <option>School Partnership</option>
                        <option>Media & Press</option>
                        <option>Educational Resources</option>
                    </select>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Message</label>
                    <textarea rows="4" required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px;"></textarea>
                </div>
                <button type="submit" style="background: #000; color: #fff; border: none; padding: 14px 28px; border-radius: 4px; font-weight: 600; cursor: pointer; width: 100%;">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>


<!-- FOOTER -->
<footer class="site-footer">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
            <p>&copy; <?= date('Y') ?> BRITAKAN &mdash; Nadira Britania.</p>
        </div>
        <div style="margin-top: 1.5rem; font-size: 0.85rem; opacity: 0.7; line-height: 1.6;">
            <p><?= $content['footer']['statement'] ?></p>
        </div>
    </div>
</footer>


<!-- ARTICLE MODAL -->
<div class="lightbox-backdrop" id="article-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title" aria-hidden="true">
    <div class="lightbox-panel">
        <button class="lightbox-close" id="modal-close" aria-label="Close guide">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="article-modal-header">
            <div class="article-modal-tags" id="modal-tags"></div>
            <h2 class="article-modal-title" id="modal-title"></h2>
            <p class="article-modal-subtitle" id="modal-subtitle"></p>
            <div class="article-modal-meta" id="modal-meta"></div>
        </div>

        <div class="article-body" id="modal-body" aria-live="polite"></div>
    </div>
</div>

<script src="/assets/js/main.js" defer></script>
<script>
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
</script>
</body>
</html>
