<?php
/**
 * data/articles.php
 *
 * BRITAKAN Educational Articles
 * -----------------------------
 * Bilingual content for bullying, sexual harassment, and sexual assault.
 */

return [
    [
        'slug'         => 'when-joking-causes-harm',
        'title'        => [
            'id' => 'Saat "Bercanda" Menyebabkan Luka',
            'en' => 'When "Just Joking" Causes Harm'
        ],
        'subtitle'     => [
            'id' => 'Memahami Perundungan dan Cyberbullying',
            'en' => 'Understanding Bullying and Cyberbullying'
        ],
        'date'         => '2026-10-15',
        'date_label'   => [
            'id' => '15 Oktober 2026',
            'en' => '15 October 2026'
        ],
        'reading_time' => 12,
        'tags'         => [
            'id' => ['Perundungan', 'Cyberbullying', 'Keamanan Remaja'],
            'en' => ['Bullying', 'Cyberbullying', 'Youth Safety']
        ],
        'excerpt'      => [
            'id' => 'Tidak semua lelucon tidak berbahaya. Jika perilaku mempermalukan, mengintimidasi, mengucilkan, atau menargetkan seseorang secara berulang, itu butuh perhatian. Kenali polanya.',
            'en' => 'Not every joke is harmless. When behavior humiliates, intimidates, excludes, or repeatedly targets someone, it deserves attention rather than dismissal.'
        ],
        'body'         => [
            'id' => <<<HTML
<p class="article-lead">Tidak semua lelucon tidak berbahaya. Saat perilaku mempermalukan, mengintimidasi, mengucilkan, atau menargetkan seseorang secara berulang terjadi, itu membutuhkan perhatian.</p>
<h3>Apa Itu Perundungan?</h3>
<p>Perundungan adalah perilaku agresif yang tidak diinginkan, melibatkan ketidakseimbangan kekuasaan. Perilaku ini berulang dan dapat terjadi di sekolah, online, atau lingkungan sosial.</p>
<ul>
    <li><strong>Verbal:</strong> Ejekan, ancaman, atau komentar tidak pantas</li>
    <li><strong>Sosial:</strong> Mengucilkan, menyebar rumor, merusak reputasi</li>
    <li><strong>Fisik:</strong> Memukul, mendorong, merusak barang</li>
    <li><strong>Cyberbullying:</strong> Menggunakan platform digital untuk menyakiti atau mempermalukan</li>
</ul>
<p class="article-closing">Kamu berhak merasa aman, dihargai, dan didengar.</p>
HTML,
            'en' => <<<HTML
<p class="article-lead">Not every joke is harmless. When behavior humiliates, intimidates, excludes, or repeatedly targets someone, it deserves attention rather than dismissal.</p>
<h3>What Is Bullying?</h3>
<p>Bullying is unwanted, aggressive behavior that involves a power imbalance. The behavior is repeated and can happen at school, online, or in social settings.</p>
<ul>
    <li><strong>Verbal:</strong> Name-calling, insults, threats, or inappropriate comments</li>
    <li><strong>Social:</strong> Deliberately excluding, spreading rumors, damaging reputation</li>
    <li><strong>Physical:</strong> Hitting, pushing, damaging belongings</li>
    <li><strong>Cyberbullying:</strong> Using digital platforms to harm or humiliate</li>
</ul>
<p class="article-closing">You deserve to feel safe, respected, and heard.</p>
HTML
        ],
    ],
    // ... (Repeat structure for other articles)
];
