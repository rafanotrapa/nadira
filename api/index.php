<?php
/**
 * index.php — BRITAKAN Platform Main Entry Point
 * Youth Advocacy, Safety Education, and Support Platform
 * Founder/Initiator: Nadira Britania
 */

declare(strict_types=1);

// Handle language selection via query parameter (?lang=id or ?lang=en)
$lang = $_GET['lang'] ?? 'id';
if (!in_array($lang, ['id', 'en'], true)) {
    $lang = 'id';
}

$articles = require __DIR__ . '/../data/articles.php';
$content  = require __DIR__ . '/../data/content.php';

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

    <!-- Open Graph -->
    <meta property="og:title"       content="BRITAKAN — No Voice Left Unheard">
    <meta property="og:description" content="Youth Advocacy, Safety Education, and Support Platform.">
    <meta property="og:type"        content="website">

    <title>BRITAKAN &mdash; No Voice Left Unheard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">
    
    <style>
        /* Additional styling for BRITAKAN platform */
        .quick-exit-btn {
            background-color: #b91c1c !important;
            color: #fff !important;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: background-color 0.2s;
        }
        .quick-exit-btn:hover {
            background-color: #991b1b !important;
        }
        .lang-switch {
            display: inline-flex;
            gap: 6px;
            align-items: center;
            font-size: 0.85rem;
            margin-left: 12px;
        }
        .lang-switch a {
            color: inherit;
            opacity: 0.6;
            text-decoration: none;
            padding: 2px 6px;
        }
        .lang-switch a.active {
            opacity: 1;
            font-weight: 700;
            border-bottom: 2px solid currentColor;
        }
        .focus-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        .focus-card {
            background: var(--card-bg, #fff);
            border: 1px solid var(--border-color, #e5e7eb);
            padding: 2.5rem;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .focus-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
        }
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        .step-card {
            padding: 2rem;
            border-left: 3px solid var(--accent, #b91c1c);
            background: rgba(0,0,0,0.02);
        }
        .step-number {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent, #b91c1c);
            line-height: 1;
            margin-bottom: 1rem;
        }
        .support-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .support-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 2rem;
        }
        .support-card.danger-card {
            border-left: 4px solid #dc2626;
            background: #fef2f2;
        }
        .demo-badge {
            display: inline-block;
            background: #f59e0b;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
        }
        .quick-exit-modal {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: #ffffff;
            z-index: 99999;
            display: none;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
        }
    </style>
</head>
<body class="loading">

<!-- Quick Exit Modal Backdrop (Activated instantly on Quick Exit) -->
<div id="quick-exit-screen" class="quick-exit-modal">
    <div style="max-width: 600px;">
        <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Weather Forecast &mdash; BBC Weather</h1>
        <p style="font-size: 1.1rem; color: #4b5563; margin-bottom: 2rem;">Loading current weather conditions for London and surrounding regions...</p>
        <a href="https://www.bbc.com/weather" class="hero-cta" style="display:inline-block; background:#000; color:#fff; padding:12px 24px; border-radius:4px; text-decoration:none;">Open Weather</a>
    </div>
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

        <div style="display: flex; align-items: center; gap: 1rem;">
            <!-- Language Switcher -->
            <div class="lang-switch">
                <a href="?lang=id" class="<?= $lang === 'id' ? 'active' : '' ?>">ID</a>
                <span>/</span>
                <a href="?lang=en" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
            </div>

            <!-- Quick Exit Button -->
            <button id="quick-exit-btn" class="quick-exit-btn" aria-label="Quick Exit to neutral page">
                <?= $content['nav']['quick_exit'] ?>
            </button>
        </div>

        <!-- Mobile hamburger -->
        <button
            class="nav-toggle"
            id="nav-toggle"
            aria-controls="nav-drawer"
            aria-expanded="false"
            aria-label="Open menu"
        >
            <span></span>
            <span></span>
            <span></span>
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
    <a href="#" id="mobile-quick-exit" style="color: #dc2626; font-weight:700;"><?= $content['nav']['quick_exit'] ?></a>
</div>


<!-- ============================================================
     SECTION 1: HERO
     ============================================================ -->
<section id="hero" class="hero" aria-label="Hero">
    <div class="hero-grid">
        <div class="hero-copy">
            <div class="hero-eyebrow" aria-hidden="true">
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

            <p style="font-size: 0.850rem; opacity: 0.7; margin-top: 1.5rem;">
                <?= $content['hero']['supporting'] ?>
            </p>
        </div>

        <div class="hero-image-wrap" role="img" aria-label="BRITAKAN advocacy banner">
            <img src="/assets/img/hero.jpg" alt="BRITAKAN Initiative" width="720" height="960" loading="eager" fetchpriority="high">
        </div>
    </div>

    <div class="hero-banner" role="complementary" aria-label="Core message">
        <div class="hero-banner-inner">
            <blockquote>
                "Every young person deserves to feel safe, to be heard, and to receive appropriate support when something goes wrong."
            </blockquote>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 2: WHY BRITAKAN EXISTS
     ============================================================ -->
<section id="about" class="section" aria-labelledby="why-heading">
    <div class="container">
        <div class="about-grid">
            <div class="about-body">
                <p class="label-meta about-label">Founder: Nadira Britania</p>

                <h2 id="why-heading" class="about-heading" style="font-size: 2.25rem; line-height: 1.2;">
                    <?= $content['why_exists']['heading'] ?>
                </h2>

                <p style="margin-top: 1.5rem; line-height: 1.7;">
                    <?= $content['why_exists']['body'] ?>
                </p>

                <div style="margin-top: 2rem;">
                    <a href="#learn" class="hero-cta" style="display:inline-block; border-bottom: 2px solid currentColor; padding-bottom: 2px; text-decoration: none; font-weight: 600;">
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


<!-- ============================================================
     SECTION 3: THREE FOCUS AREAS
     ============================================================ -->
<section class="section section-alt" aria-labelledby="focus-heading">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 id="focus-heading" class="advocacy-heading">
                    <?= $content['focus_areas']['heading'] ?>
                </h2>
                <p class="advocacy-subtitle">
                    Comprehensive educational resources across three critical areas.
                </p>
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
                    <a href="#learn" class="article-read-link" style="display:inline-flex; align-items:center; gap:6px; font-weight:600; text-decoration:none;">
                        <?= $card['cta'] ?>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                            <path d="M1 6h10M7 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 4: HOW BRITAKAN WORKS
     ============================================================ -->
<section class="section" aria-labelledby="works-heading">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 id="works-heading" class="advocacy-heading">
                    <?= $content['how_it_works']['heading'] ?>
                </h2>
                <p class="advocacy-subtitle">
                    <?= $content['how_it_works']['supporting'] ?>
                </p>
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


<!-- ============================================================
     SECTION 5: LEARN & UNDERSTAND (Articles Library)
     ============================================================ -->
<section id="learn" class="section section-alt" aria-labelledby="learn-heading">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 id="learn-heading" class="advocacy-heading">
                    <?= $content['nav']['learn'] ?>
                </h2>
                <p class="advocacy-subtitle">
                    Reliable educational articles to help you understand your rights and options.
                </p>
            </div>
            <div class="advocacy-count" aria-label="<?= count($articles) ?> articles">
                <?= sprintf('%02d', count($articles)) ?>
            </div>
        </div>

        <div class="articles-grid" role="list" aria-label="Educational articles">
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
                    aria-label="Read article: <?= encode_data($article['title']) ?>"
                >
                    <?php if ($is_featured): ?>
                        <div class="article-card-left">
                            <div class="article-meta">
                                <span class="article-date"><?= htmlspecialchars($date_display) ?></span>
                                <span class="article-dot" aria-hidden="true"></span>
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
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                                    <path d="M1 6h10M7 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                        <div class="article-card-right">
                            <p class="article-excerpt"><?= htmlspecialchars($article['excerpt']) ?></p>
                        </div>
                    <?php else: ?>
                        <div class="article-number" aria-hidden="true"><?= sprintf('%02d', $index + 1) ?></div>
                        <div class="article-meta">
                            <span class="article-date"><?= htmlspecialchars($date_display) ?></span>
                            <span class="article-dot" aria-hidden="true"></span>
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
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                                <path d="M1 6h10M7 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 6: GET HELP & SUPPORT
     ============================================================ -->
<section id="help" class="section" aria-labelledby="help-heading">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 id="help-heading" class="advocacy-heading">
                    <?= $content['get_help']['heading'] ?>
                </h2>
                <p class="advocacy-subtitle">
                    <?= $content['get_help']['intro'] ?>
                </p>
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
                        <a href="tel:112" class="hero-cta" style="display:inline-block; background:#dc2626; color:#fff; padding:8px 16px; border-radius:4px; text-decoration:none; font-size:0.85rem;">Emergency: Call 112</a>
                    <?php else: ?>
                        <a href="#report" class="article-read-link" style="font-weight:600; text-decoration:none;">Learn Options &rarr;</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 7: REPORT AN INCIDENT (Demo Form)
     ============================================================ -->
<section id="report" class="section section-alt" aria-labelledby="report-heading">
    <div class="container" style="max-width: 800px;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span class="demo-badge">Demo Reporting Prototype</span>
            <h2 id="report-heading" class="advocacy-heading" style="font-size: 2.5rem; margin-top: 0.5rem;">
                <?= $content['report']['heading'] ?>
            </h2>
            <p class="advocacy-subtitle" style="max-width: 600px; margin: 1rem auto 0 auto;">
                <?= $content['report']['intro'] ?>
            </p>
        </div>

        <div style="background: #fff; padding: 3rem; border-radius: 8px; border: 1px solid #e5e7eb;">
            <form id="report-form" onsubmit="handleReportSubmit(event)">
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;"><?= $content['report']['form']['category']['label'] ?></label>
                    <select required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px; font-family: inherit;">
                        <option value="">Select category...</option>
                        <?php foreach ($content['report']['form']['category']['options'] as $opt): ?>
                            <option value="<?= $opt ?>"><?= $opt ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;"><?= $content['report']['form']['role']['label'] ?></label>
                    <select required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px; font-family: inherit;">
                        <option value="">Select your role...</option>
                        <?php foreach ($content['report']['form']['role']['options'] as $opt): ?>
                            <option value="<?= $opt ?>"><?= $opt ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Description of Incident (Demo)</label>
                    <textarea rows="4" required placeholder="Please describe what happened..." style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px; font-family: inherit;"></textarea>
                </div>

                <div style="background: #f9fafb; padding: 1rem; border-radius: 4px; font-size: 0.85rem; margin-bottom: 1.5rem; color: #4b5563;">
                    <strong>Privacy Notice:</strong> This is a demonstration form. Data is not transmitted or recorded. No identifying information is stored.
                </div>

                <button type="submit" class="hero-cta" style="background: var(--accent, #b91c1c); color: #fff; border: none; padding: 14px 28px; border-radius: 4px; font-weight: 600; cursor: pointer; width: 100%;">
                    <?= $content['report']['form']['submit'] ?>
                </button>
            </form>

            <div id="report-success" style="display: none; text-align: center; padding: 2rem 0;">
                <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; margin-bottom: 1rem; color: #16a34a;">
                    <?= $content['report']['confirmation']['title'] ?>
                </h3>
                <p style="margin-bottom: 1.5rem; color: #4b5563;">
                    <?= $content['report']['confirmation']['body'] ?>
                </p>
                <p style="font-family: monospace; font-weight: 700; font-size: 1.1rem; background: #f3f4f6; display: inline-block; padding: 8px 16px; border-radius: 4px; margin-bottom: 1.5rem;">
                    Reference ID: BRITAKAN-DEMO-2026-<?= rand(1000, 9999) ?>
                </p>
                <div>
                    <button onclick="resetReportForm()" style="background: #000; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Submit Another Demo Report</button>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 8: RESOURCES
     ============================================================ -->
<section id="resources" class="section" aria-labelledby="resources-heading">
    <div class="container">
        <div class="advocacy-header reveal">
            <div>
                <h2 id="resources-heading" class="advocacy-heading">
                    <?= $content['resources']['heading'] ?>
                </h2>
                <p class="advocacy-subtitle">
                    Explore verified educational resources, guidelines, and external support services.
                </p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 3rem;">
            <?php foreach ($content['resources']['categories'] as $cat): ?>
                <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 2rem;">
                    <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; margin-bottom: 1rem;"><?= $cat ?></h3>
                    <p style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 1.5rem;">Curated guides and verified references for <?= strtolower($cat) ?>.</p>
                    <a href="https://rainn.org/" target="_blank" rel="noopener noreferrer" class="article-read-link" style="font-weight: 600; text-decoration: none;">External Reference (RAINN) &rarr;</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 9: CONTACT & PARTNERSHIPS
     ============================================================ -->
<section id="contact" class="section section-alt" aria-labelledby="contact-heading">
    <div class="container" style="max-width: 800px;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <h2 id="contact-heading" class="advocacy-heading" style="font-size: 2.5rem;">
                <?= $content['contact']['heading'] ?>
            </h2>
            <p class="advocacy-subtitle" style="max-width: 600px; margin: 1rem auto 0 auto;">
                <?= $content['contact']['body'] ?>
            </p>
        </div>

        <div style="background: #fff; padding: 3rem; border-radius: 8px; border: 1px solid #e5e7eb;">
            <form onsubmit="alert('Thank you for your message. We will get back to you shortly.'); return false;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Name / Organization</label>
                        <input type="text" required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px; font-family: inherit;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Email Address</label>
                        <input type="email" required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px; font-family: inherit;">
                    </div>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Purpose of Inquiry</label>
                    <select style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px; font-family: inherit;">
                        <option>General Inquiry</option>
                        <option>School Partnership</option>
                        <option>Media & Press</option>
                        <option>Educational Resources</option>
                    </select>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Message</label>
                    <textarea rows="4" required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 4px; font-family: inherit;"></textarea>
                </div>
                <button type="submit" class="hero-cta" style="background: #000; color: #fff; border: none; padding: 14px 28px; border-radius: 4px; font-weight: 600; cursor: pointer; width: 100%;">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>


<!-- ============================================================
     FOOTER
     ============================================================ -->
<footer class="site-footer" role="contentinfo" aria-label="Footer">
    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand-col">
                <p class="footer-brand">BRITAKAN<span>.</span></p>
                <p class="footer-tagline">
                    No Voice Left Unheard. Youth Advocacy Initiative initiated by Nadira Britania.
                </p>
            </div>

            <div>
                <p class="footer-col-title">Navigation</p>
                <nav aria-label="Footer Navigation">
                    <ul class="footer-links" role="list">
                        <li><a href="#hero"><?= $content['nav']['home'] ?></a></li>
                        <li><a href="#about"><?= $content['nav']['about'] ?></a></li>
                        <li><a href="#learn"><?= $content['nav']['learn'] ?></a></li>
                        <li><a href="#help"><?= $content['nav']['help'] ?></a></li>
                        <li><a href="#report"><?= $content['nav']['report'] ?></a></li>
                        <li><a href="#resources"><?= $content['nav']['resources'] ?></a></li>
                        <li><a href="#contact"><?= $content['nav']['contact'] ?></a></li>
                    </ul>
                </nav>
            </div>

            <div>
                <p class="footer-col-title">Verified Resources</p>
                <ul class="footer-links" role="list">
                    <li><a href="https://rainn.org/" target="_blank" rel="noopener noreferrer">RAINN Support</a></li>
                    <li><a href="https://www.unicef.org/" target="_blank" rel="noopener noreferrer">UNICEF Youth</a></li>
                </ul>
            </div>
        </div>

        <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.85rem; opacity: 0.7; line-height: 1.6;">
            <p><?= $content['footer']['statement'] ?></p>
        </div>

        <div class="footer-bottom" style="margin-top: 2rem;">
            <p class="footer-copy">&copy; <?= date('Y') ?> BRITAKAN &mdash; Nadira Britania.</p>
            <p class="footer-rep">Youth Advocacy &amp; Support Platform</p>
        </div>
    </div>
</footer>


<!-- ============================================================
     ARTICLE MODAL
     ============================================================ -->
<div class="lightbox-backdrop" id="article-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title" aria-hidden="true">
    <div class="lightbox-panel">
        <button class="lightbox-close" id="modal-close" aria-label="Close guide">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                <path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="article-modal-header">
            <div class="article-modal-tags" id="modal-tags" aria-label="Topics"></div>
            <h2 class="article-modal-title" id="modal-title"></h2>
            <p class="article-modal-subtitle" id="modal-subtitle"></p>
            <div class="article-modal-meta" id="modal-meta"></div>
        </div>

        <div class="article-body" id="modal-body" aria-live="polite"></div>
    </div>
</div>


<script src="/assets/js/main.js" defer></script>
<script>
    // Quick Exit Functionality
    document.getElementById('quick-exit-btn').addEventListener('click', function() {
        document.getElementById('quick-exit-screen').style.display = 'flex';
        window.location.replace('https://www.bbc.com/weather');
    });
    document.getElementById('mobile-quick-exit').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('quick-exit-screen').style.display = 'flex';
        window.location.replace('https://www.bbc.com/weather');
    });

    // Report Form Demo Handling
    function handleReportSubmit(e) {
        e.preventDefault();
        document.getElementById('report-form').style.display = 'none';
        document.getElementById('report-success').style.display = 'block';
    }

    function resetReportForm() {
        document.getElementById('report-form').reset();
        document.getElementById('report-form').style.display = 'block';
        document.getElementById('report-success').style.display = 'none';
    }
</script>
</body>
</html>
