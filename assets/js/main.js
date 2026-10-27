/**
 * assets/js/main.js
 * Nadira Britania Portfolio — Vanilla JS
 *
 * Responsibilities:
 *   1. Mobile nav hamburger toggle + drawer
 *   2. Article modal open / close (click card, keyboard, backdrop)
 *   3. Gallery lightbox (image expand on click)
 *   4. Scroll-reveal using IntersectionObserver
 *   5. Active nav link highlight on scroll
 *   6. Smooth scroll for anchor links
 */

(function () {
    'use strict';

    /* -------------------------------------------------------------------------
       1. MOBILE NAVIGATION
       ---------------------------------------------------------------------- */

    const navToggle  = document.getElementById('nav-toggle');
    const navDrawer  = document.getElementById('nav-drawer');
    const drawerLinks = navDrawer ? navDrawer.querySelectorAll('a') : [];

    function openDrawer() {
        navToggle.setAttribute('aria-expanded', 'true');
        navToggle.classList.add('is-open');
        navDrawer.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        navToggle.setAttribute('aria-expanded', 'false');
        navToggle.classList.remove('is-open');
        navDrawer.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    function toggleDrawer() {
        const isOpen = navDrawer.classList.contains('is-open');
        if (isOpen) { closeDrawer(); } else { openDrawer(); }
    }

    if (navToggle && navDrawer) {
        navToggle.addEventListener('click', toggleDrawer);

        // Close when a drawer link is clicked
        drawerLinks.forEach(function (link) {
            link.addEventListener('click', closeDrawer);
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && navDrawer.classList.contains('is-open')) {
                closeDrawer();
                navToggle.focus();
            }
        });
    }

    /* -------------------------------------------------------------------------
       2. ARTICLE MODAL
       ---------------------------------------------------------------------- */

    const articleBackdrop = document.getElementById('article-modal');
    const articleTitle    = document.getElementById('modal-title');
    const articleSubtitle = document.getElementById('modal-subtitle');
    const articleMeta     = document.getElementById('modal-meta');
    const articleTags     = document.getElementById('modal-tags');
    const articleBody     = document.getElementById('modal-body');
    const modalClose      = document.getElementById('modal-close');

    function openArticleModal(card) {
        if (!articleBackdrop) return;

        const title    = card.dataset.title    || '';
        const subtitle = card.dataset.subtitle || '';
        const date     = card.dataset.date     || '';
        const time     = card.dataset.time     || '';
        const tags     = JSON.parse(card.dataset.tags   || '[]');
        const body     = card.dataset.body     || '';

        // Populate modal content
        if (articleTitle)    articleTitle.textContent    = title;
        if (articleSubtitle) articleSubtitle.textContent = subtitle;

        if (articleMeta) {
            articleMeta.innerHTML =
                '<span class="article-date">' + escapeHtml(date) + '</span>' +
                '<span class="article-dot"></span>' +
                '<span class="article-time">' + escapeHtml(time) + ' menit membaca</span>';
        }

        if (articleTags) {
            articleTags.innerHTML = tags.map(function (tag, i) {
                return '<span class="tag-pill' + (i === 0 ? ' tag-primary' : '') + '">' +
                       escapeHtml(tag) + '</span>';
            }).join('');
        }

        if (articleBody) articleBody.innerHTML = body;

        // Show modal
        articleBackdrop.classList.add('is-open');
        articleBackdrop.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Move focus to close button
        if (modalClose) {
            requestAnimationFrame(function () { modalClose.focus(); });
        }
    }

    function closeArticleModal() {
        if (!articleBackdrop) return;
        articleBackdrop.classList.remove('is-open');
        articleBackdrop.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    // Bind cards
    document.querySelectorAll('.article-card[data-slug]').forEach(function (card) {
        card.addEventListener('click', function () { openArticleModal(card); });

        // Keyboard accessibility: Enter or Space opens modal
        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openArticleModal(card);
            }
        });
    });

    // Close button
    if (modalClose) {
        modalClose.addEventListener('click', closeArticleModal);
    }

    // Close on backdrop click
    if (articleBackdrop) {
        articleBackdrop.addEventListener('click', function (e) {
            if (e.target === articleBackdrop) { closeArticleModal(); }
        });
    }

    // Close on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && articleBackdrop && articleBackdrop.classList.contains('is-open')) {
            closeArticleModal();
        }
    });

    /* -------------------------------------------------------------------------
       3. GALLERY IMAGE LIGHTBOX
       ---------------------------------------------------------------------- */

    const galleryBackdrop = document.getElementById('gallery-lightbox');
    const galleryImg      = document.getElementById('lightbox-img');
    const galleryCaption  = document.getElementById('lightbox-caption');
    const galleryClose    = document.getElementById('gallery-close');

    function openGalleryLightbox(item) {
        if (!galleryBackdrop) return;

        const imgEl  = item.querySelector('img');
        const capEl  = item.querySelector('.gallery-item-caption');
        const src    = imgEl  ? imgEl.src  : '';
        const alt    = imgEl  ? imgEl.alt  : '';
        const caption = capEl ? capEl.textContent : '';

        if (galleryImg) {
            galleryImg.src = src;
            galleryImg.alt = alt;
        }

        if (galleryCaption) {
            galleryCaption.textContent = caption;
        }

        galleryBackdrop.classList.add('is-open');
        galleryBackdrop.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        if (galleryClose) {
            requestAnimationFrame(function () { galleryClose.focus(); });
        }
    }

    function closeGalleryLightbox() {
        if (!galleryBackdrop) return;
        galleryBackdrop.classList.remove('is-open');
        galleryBackdrop.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        if (galleryImg) { galleryImg.src = ''; }
    }

    document.querySelectorAll('.gallery-item[data-lightbox]').forEach(function (item) {
        item.addEventListener('click', function () { openGalleryLightbox(item); });
        item.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openGalleryLightbox(item);
            }
        });
    });

    if (galleryClose) {
        galleryClose.addEventListener('click', closeGalleryLightbox);
    }

    if (galleryBackdrop) {
        galleryBackdrop.addEventListener('click', function (e) {
            if (e.target === galleryBackdrop) { closeGalleryLightbox(); }
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && galleryBackdrop && galleryBackdrop.classList.contains('is-open')) {
            closeGalleryLightbox();
        }
    });

    /* -------------------------------------------------------------------------
       4. SCROLL REVEAL (IntersectionObserver — no window.scroll handler)
       ---------------------------------------------------------------------- */

    const revealElements = document.querySelectorAll('.reveal');

    if (revealElements.length > 0 && 'IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
        );

        revealElements.forEach(function (el) { revealObserver.observe(el); });
    } else {
        // Fallback: show all immediately
        revealElements.forEach(function (el) { el.classList.add('is-visible'); });
    }

    /* -------------------------------------------------------------------------
       5. ACTIVE NAV LINK ON SCROLL (IntersectionObserver — no scroll listener)
       ---------------------------------------------------------------------- */

    const sections   = document.querySelectorAll('section[id]');
    const navAnchors = document.querySelectorAll('.nav-links a[href^="#"]');

    if (sections.length > 0 && navAnchors.length > 0) {
        var sectionObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var id = entry.target.getAttribute('id');
                        navAnchors.forEach(function (a) {
                            a.classList.toggle(
                                'nav-active',
                                a.getAttribute('href') === '#' + id
                            );
                        });
                    }
                });
            },
            { rootMargin: '-40% 0px -55% 0px', threshold: 0 }
        );

        sections.forEach(function (s) { sectionObserver.observe(s); });
    }

    /* -------------------------------------------------------------------------
       6. SMOOTH SCROLL POLYFILL (for older browsers)
       ---------------------------------------------------------------------- */

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* -------------------------------------------------------------------------
       7. UTILITY: HTML escape to prevent XSS when injecting user-facing strings
       ---------------------------------------------------------------------- */

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g,  '&amp;')
            .replace(/</g,  '&lt;')
            .replace(/>/g,  '&gt;')
            .replace(/"/g,  '&quot;')
            .replace(/'/g,  '&#x27;');
    }

})();
