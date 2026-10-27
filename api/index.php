<?php
/**
 * index.php — Main entry point / layout orchestrator
 * Nadira Britania Portfolio
 *
 * This single file handles all routes on Vercel (vercel-php@0.7.0).
 * Article data is loaded from data/articles.php and rendered dynamically.
 * All markup is semantic HTML5. No framework dependencies.
 */

declare(strict_types=1);

// Load article data — returns an array of article definitions
$articles = require __DIR__ . '/../data/articles.php';

// Utility: encode article data for safe embedding in HTML data-* attributes
function encode_data(mixed $value): string {
    if (is_array($value)) {
        return htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8');
    }
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// Utility: format a date string to display label
function format_date(string $iso): string {
    $ts = strtotime($iso);
    return date('j F Y', $ts);
}

?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nadira Britania — Finalist Miss Teenager Indonesia 2026 representing West Sumatra. Elegant responsive editorial portfolio template.">
    <meta name="author" content="Nadira Britania">

    <!-- Open Graph -->
    <meta property="og:title"       content="Nadira Britania — Miss Teenager Indonesia 2026">
    <meta property="og:description" content="Finalist Miss Teenager Indonesia 2026 representing West Sumatra. Elegant responsive editorial portfolio template.">
    <meta property="og:type"        content="website">

    <title>Nadira Britania &mdash; Miss Teenager Indonesia 2026</title>

    <!-- Google Fonts: Cormorant Garamond (display) + Plus Jakarta Sans (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="loading">

<!-- Loading Intro -->
<div class="intro-overlay">
    <h1 class="intro-text">
        <span>N</span><span>a</span><span>d</span><span>i</span><span>r</span><span>a</span> 
        <span class="name-accent">B</span><span class="name-accent">r</span><span class="name-accent">i</span><span class="name-accent">t</span><span class="name-accent">a</span><span class="name-accent">n</span><span class="name-accent">i</span><span class="name-accent">a</span>
    </h1>
</div>

<!-- ============================================================
     NAVIGATION
     ============================================================ -->
<nav class="site-nav" role="navigation" aria-label="Navigasi Utama">
    <div class="nav-inner">
        <a href="#hero" class="nav-brand" aria-label="Kembali ke atas">
            N<span>.</span>B
        </a>

        <!-- Desktop links -->
        <ul class="nav-links" role="list">
            <li><a href="#about">About</a></li>
            <li><a href="#advocacy">Advocacy</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <!-- Mobile hamburger -->
        <button
            class="nav-toggle"
            id="nav-toggle"
            aria-controls="nav-drawer"
            aria-expanded="false"
            aria-label="Buka menu navigasi"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

        <!-- Mobile nav drawer -->
<div
    class="nav-drawer"
    id="nav-drawer"
    role="dialog"
    aria-label="Mobile Navigation Menu"
    aria-hidden="true"
>
    <a href="#about">About</a>
    <a href="#advocacy">Advocacy</a>
    <a href="#gallery">Gallery</a>
    <a href="#contact">Contact</a>
</div>


<!-- ============================================================
     HERO SECTION — Editorial Magazine Spread
     ============================================================ -->
<section id="hero" class="hero" aria-label="Hero">
    <div class="hero-grid">

        <!-- Left: Large editorial typography -->
        <div class="hero-copy">
            <div class="hero-eyebrow" aria-hidden="true">
                <span class="hero-eyebrow-line"></span>
                <span class="label-meta">Finalist 2026</span>
            </div>

            <h1 class="hero-name">
                <span class="name-part">Nadira</span>
                <em class="name-accent">Britania</em>
            </h1>

            <p class="hero-title">
                <strong>Miss Teenager Indonesia 2026</strong><br>
                West Sumatra Representative
            </p>

            <a href="#about" class="hero-cta">
                Learn More
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                    <path d="M1 7h12M8 3l5 4-5 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <!-- Right: Hero portrait image -->
        <div class="hero-image-wrap" role="img" aria-label="Official portrait">
            <img src="https://images.pexels.com/photos/1181690/pexels-photo-1181690.jpeg?auto=compress&cs=tinysrgb&w=1200&h=1600&fit=crop"
                 alt="Professional portrait of young woman"
                 width="720" height="960" loading="eager" fetchpriority="high">
        </div>

    </div>

    <!-- Quote banner -->
    <div class="hero-banner" role="complementary" aria-label="Advocacy quote">
        <div class="hero-banner-inner">
            <blockquote>
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit &mdash;
                sed do eiusmod <span>tempor incididunt</span> ut labore."
            </blockquote>
        </div>
    </div>
</section>


<!-- ============================================================
     ABOUT / BIO SECTION — Asymmetric 2-Column
     ============================================================ -->
<section id="about" class="section" aria-labelledby="about-heading">
    <div class="container">
        <div class="about-grid">

            <!-- Left: Narrative -->
            <div class="about-body">
                <p class="label-meta about-label">About / Bio</p>

                <h2 id="about-heading" class="about-heading">
                    Lorem ipsum dolor
                    <em>sit amet,</em>
                    consectetur.
                </h2>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>

                <p>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>

                <p>
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                    totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                </p>
            </div>

            <!-- Right: Highlights grid -->
            <div class="about-right reveal">
                <div class="highlights-grid" role="list" aria-label="Profile Highlights">

                    <div class="highlight-card" role="listitem">
                        <div class="highlight-icon" aria-hidden="true">I</div>
                        <p class="highlight-title">Education</p>
                        <p class="highlight-value">[Your Campus]</p>
                    </div>

                    <div class="highlight-card" role="listitem">
                        <div class="highlight-icon" aria-hidden="true">II</div>
                        <p class="highlight-title">Representation</p>
                        <p class="highlight-value">West Sumatra</p>
                    </div>

                    <div class="highlight-card" role="listitem">
                        <div class="highlight-icon" aria-hidden="true">III</div>
                        <p class="highlight-title">Core Focus</p>
                        <p class="highlight-value">Youth Empowerment</p>
                    </div>

                    <div class="highlight-card" role="listitem">
                        <div class="highlight-icon" aria-hidden="true">IV</div>
                        <p class="highlight-title">Advocacy</p>
                        <p class="highlight-value">Social Impact &amp; Education</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- ============================================================
     ADVOCACY / ARTICLES SECTION — Magazine Card Grid
     ============================================================ -->
<section id="advocacy" class="section section-alt" aria-labelledby="advocacy-heading">
    <div class="container">

        <div class="advocacy-header reveal">
            <div>
                <h2 id="advocacy-heading" class="advocacy-heading">
                    Youth <em>Voice</em>
                </h2>
                <p class="advocacy-subtitle">
                    Essays and reflections on topics that matter to this generation.
                </p>
            </div>
            <div class="advocacy-count" aria-label="<?= count($articles) ?> essays published">
                <?= sprintf('%02d', count($articles)) ?>
            </div>
        </div>

        <!-- Dynamic article cards rendered from data/articles.php -->
        <div class="articles-grid" role="list" aria-label="Daftar esai advokasi">

            <?php foreach ($articles as $index => $article): ?>
                <?php
                    $is_featured = ($index === 0);
                    $tags_json   = encode_data($article['tags']);
                    $body_encoded = encode_data($article['body']);
                    $date_display = $article['date_label'];
                    $card_tabindex = 0;
                ?>

                <article
                    class="article-card"
                    role="listitem"
                    tabindex="<?= $card_tabindex ?>"
                    data-slug="<?= encode_data($article['slug']) ?>"
                    data-title="<?= encode_data($article['title']) ?>"
                    data-subtitle="<?= encode_data($article['subtitle']) ?>"
                    data-date="<?= encode_data($date_display) ?>"
                    data-time="<?= (int) $article['reading_time'] ?>"
                    data-tags="<?= $tags_json ?>"
                    data-body="<?= $body_encoded ?>"
                    aria-label="Baca esai: <?= encode_data($article['title']) ?>"
                >
                    <?php if ($is_featured): ?>
                        <!-- Featured card: 2-column layout -->
                        <div class="article-card-left">

                            <div class="article-meta">
                                <span class="article-date"><?= htmlspecialchars($date_display) ?></span>
                                <span class="article-dot" aria-hidden="true"></span>
                                <span class="article-time"><?= (int) $article['reading_time'] ?> menit membaca</span>
                            </div>

                            <div class="article-tags">
                                <?php foreach ($article['tags'] as $i => $tag): ?>
                                    <span class="tag-pill <?= $i === 0 ? 'tag-primary' : '' ?>">
                                        <?= htmlspecialchars($tag) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>

                            <h3 class="article-title">
                                <?= htmlspecialchars($article['title']) ?>
                            </h3>

                            <p class="article-subtitle">
                                <?= htmlspecialchars($article['subtitle']) ?>
                            </p>

                            <span class="article-read-link" role="button" aria-label="Baca esai lengkap">
                                Baca Esai
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                                    <path d="M1 6h10M7 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>

                        </div>

                        <div class="article-card-right">
                            <p class="article-excerpt">
                                <?= htmlspecialchars($article['excerpt']) ?>
                            </p>
                        </div>

                    <?php else: ?>
                        <!-- Secondary card: stacked layout -->

                        <div class="article-number" aria-hidden="true">
                            <?= sprintf('%02d', $index + 1) ?>
                        </div>

                        <div class="article-meta">
                            <span class="article-date"><?= htmlspecialchars($date_display) ?></span>
                            <span class="article-dot" aria-hidden="true"></span>
                            <span class="article-time"><?= (int) $article['reading_time'] ?> menit</span>
                        </div>

                        <div class="article-tags">
                            <?php foreach ($article['tags'] as $i => $tag): ?>
                                <span class="tag-pill <?= $i === 0 ? 'tag-primary' : '' ?>">
                                    <?= htmlspecialchars($tag) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <h3 class="article-title">
                            <?= htmlspecialchars($article['title']) ?>
                        </h3>

                        <p class="article-subtitle">
                            <?= htmlspecialchars($article['subtitle']) ?>
                        </p>

                        <p class="article-excerpt">
                            <?= htmlspecialchars($article['excerpt']) ?>
                        </p>

                        <span class="article-read-link" role="button" aria-label="Baca esai: <?= encode_data($article['title']) ?>">
                            Baca Esai
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
     GALLERY SECTION — Asymmetric Editorial Grid
     ============================================================ -->
<section id="gallery" class="section" aria-labelledby="gallery-heading">
    <div class="container">

        <div class="gallery-header reveal">
            <h2 id="gallery-heading" class="gallery-heading">
                Moments &amp; <em>Journey</em>
            </h2>
            <p class="gallery-desc">
                Official portraits, advocacy events, and key moments throughout the journey.
            </p>
        </div>

        <!--
            Gallery grid: 6 slots in an asymmetric 12-column grid.
            TODO: Replace placeholder divs with real <img> tags.
            Recommended image dimensions per slot:
              Slot 1: 900x600px (landscape, featured)
              Slot 2: 560x900px (portrait, spans 2 rows)
              Slot 3: 540x500px (square-ish)
              Slot 4-6: 480x420px (supporting)
        -->
        <div class="gallery-grid" role="list" aria-label="Gallery photos">

            <?php
                $gallery_items = [
                    [
                        'label' => 'Official Portrait',
                        'caption' => 'Official Portrait, 2026',
                        'src' => 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=1000'
                    ],
                    [
                        'label' => 'Advocacy Event',
                        'caption' => 'Youth Empowerment Forum',
                        'src' => 'https://images.pexels.com/photos/3807517/pexels-photo-3807517.jpeg?auto=compress&cs=tinysrgb&w=1000'
                    ],
                    [
                        'label' => 'Pageant Stage',
                        'caption' => 'Pageant Performance',
                        'src' => 'https://images.pexels.com/photos/1181690/pexels-photo-1181690.jpeg?auto=compress&cs=tinysrgb&w=1000'
                    ],
                    [
                        'label' => 'Community Outreach',
                        'caption' => 'Volunteer Work',
                        'src' => 'https://images.pexels.com/photos/3807748/pexels-photo-3807748.jpeg?auto=compress&cs=tinysrgb&w=1000'
                    ],
                    [
                        'label' => 'Campus Life',
                        'caption' => 'Student Activities',
                        'src' => 'https://images.pexels.com/photos/3807517/pexels-photo-3807517.jpeg?auto=compress&cs=tinysrgb&w=1000'
                    ],
                    [
                        'label' => 'Editorial Shoot',
                        'caption' => 'Media Feature',
                        'src' => 'https://images.pexels.com/photos/1181690/pexels-photo-1181690.jpeg?auto=compress&cs=tinysrgb&w=1000'
                    ],
                ];
            ?>

            <?php foreach ($gallery_items as $gi => $gitem): ?>
                <div
                    class="gallery-item"
                    role="listitem"
                    tabindex="0"
                    data-lightbox="true"
                    aria-label="<?= htmlspecialchars($gitem['caption']) ?>"
                >
                    <img src="<?= htmlspecialchars($gitem['src']) ?>"
                         alt="<?= htmlspecialchars($gitem['label']) ?>"
                         loading="lazy">

                    <div class="gallery-item-overlay" aria-hidden="true">
                        <p class="gallery-item-caption">
                            <?= htmlspecialchars($gitem['caption']) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</section>


<!-- ============================================================
     FOOTER / CONTACT
     ============================================================ -->
<footer id="contact" class="site-footer" role="contentinfo" aria-label="Footer">
    <div class="container">
        <div class="footer-inner">

            <!-- Brand column -->
            <div class="footer-brand-col">
                <p class="footer-brand">Nadira <span>Britania</span></p>
                <p class="footer-tagline">
                    Finalist Miss Teenager Indonesia 2026 representing West Sumatra.
                    Youth empowerment and social impact advocate.
                </p>
            </div>

            <!-- Navigation links -->
            <div>
                <p class="footer-col-title">Navigation</p>
                <nav aria-label="Footer Navigation">
                    <ul class="footer-links" role="list">
                        <li><a href="#about">About</a></li>
                        <li><a href="#advocacy">Advocacy</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Social + Contact -->
            <div>
                <p class="footer-col-title">Follow the Journey</p>
                <div class="footer-social" aria-label="Social media links">

                    <!-- Instagram -->
                    <a
                        href="https://www.instagram.com/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-link"
                        aria-label="Instagram (opens new tab)"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>

                    <!-- TikTok -->
                    <a
                        href="https://www.tiktok.com/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-link"
                        aria-label="TikTok (opens new tab)"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                    </a>

                    <!-- Email -->
                    <a
                        href="mailto:your.email@example.com"
                        class="social-link"
                        aria-label="Send email"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </a>

                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p class="footer-copy">
                &copy; <?= date('Y') ?> Nadira Britania. Made with dedication.
            </p>
            <p class="footer-rep">
                Miss Teenager Indonesia 2026 — West Sumatra Representative
            </p>
        </div>
    </div>
</footer>


<!-- ============================================================
     ARTICLE MODAL
     ============================================================ -->
<div
    class="lightbox-backdrop"
    id="article-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-title"
    aria-hidden="true"
>
    <div class="lightbox-panel">
        <button
            class="lightbox-close"
            id="modal-close"
            aria-label="Tutup esai"
        >
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                <path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="article-modal-header">
            <div class="article-modal-tags" id="modal-tags" aria-label="Topik esai"></div>
            <h2 class="article-modal-title" id="modal-title"></h2>
            <p class="article-modal-subtitle" id="modal-subtitle"></p>
            <div class="article-modal-meta" id="modal-meta"></div>
        </div>

        <div class="article-body" id="modal-body" aria-live="polite"></div>
    </div>
</div>


<!-- ============================================================
     GALLERY LIGHTBOX
     ============================================================ -->
<div
    class="lightbox-backdrop"
    id="gallery-lightbox"
    role="dialog"
    aria-modal="true"
    aria-label="Tampilan foto galeri"
    aria-hidden="true"
    style="align-items: center;"
>
    <div style="position:relative; max-width:860px; width:100%; text-align:center;">
        <button
            class="lightbox-close"
            id="gallery-close"
            aria-label="Tutup foto"
            style="position:absolute; top:-52px; right:0;"
        >
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                <path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>
        <img
            id="lightbox-img"
            src=""
            alt=""
            style="max-width:100%; max-height:82dvh; object-fit:contain; display:block; margin:auto;"
        >
        <p
            id="lightbox-caption"
            style="color:rgba(253,251,247,0.65); font-size:0.75rem; letter-spacing:0.08em; text-transform:uppercase; margin-top:12px;"
        ></p>
    </div>
</div>


<script src="/assets/js/main.js" defer></script>
</body>
</html>
