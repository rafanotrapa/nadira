<?php
/**
 * data/articles.php
 *
 * TEMPLATE GUIDE — Article Data Store
 * ------------------------------------
 * Setiap entry merepresentasikan satu artikel/esai advokasi.
 * Ganti semua nilai di bawah ini dengan konten nyata Anda.
 *
 * Fields:
 *   slug        - URL-safe identifier (huruf kecil, pisah dengan tanda hubung)
 *   title       - [PANDUAN] Judul utama artikel Anda (maks. 8 kata)
 *   subtitle    - [PANDUAN] Kalimat penjelas singkat untuk judul
 *   date        - Format: 'YYYY-MM-DD'
 *   date_label  - Format tampilan: '14 Agustus 2026'
 *   reading_time - Estimasi menit membaca (hitung: jumlah kata / 200)
 *   tags        - Maks. 3 tag topik artikel
 *   excerpt     - [PANDUAN] 2-3 kalimat pembuka yang menarik perhatian pembaca
 *   body        - [PANDUAN] Isi lengkap artikel dalam format HTML
 */

return [
    [
        'slug'         => 'artikel-unggulan-pertama',
        'title'        => 'Lorem Ipsum Dolor Sit Amet',
        'subtitle'     => 'Consectetur adipiscing elit, sed do eiusmod tempor.',
        'date'         => '2026-08-14',
        'date_label'   => '14 Agustus 2026',
        'reading_time' => 8,
        'tags'         => ['Topic One', 'Topic Two', 'Topic Three'],
        'excerpt'      => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',

        // ----------------------------------------------------------------
        // ARTICLE BODY
        // ----------------------------------------------------------------
        'body'         => <<<HTML
<p class="article-lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis.</p>

<h3>Section One — Context & Background</h3>

<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur adipisci velit.</p>

<ul>
    <li><strong>Key Point One:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
    <li><strong>Key Point Two:</strong> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
    <li><strong>Key Point Three:</strong> Ut enim ad minim veniam, quis nostrud exercitation ullamco.</li>
</ul>

<h3>Section Two — Impact & Facts</h3>

<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum.</p>

<p>Data points or evidence can be placed here to add credibility to the argument.</p>

<h3>Section Three — Solutions & Action</h3>

<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>

<ol>
    <li><strong>Step One:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquip.</li>
    <li><strong>Step Two:</strong> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
    <li><strong>Step Three:</strong> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</li>
</ol>

<h3>Section Four — Personal Message</h3>

<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus.</p>

<p class="article-closing">Final inspiring thought or call to action for the reader.</p>
HTML,
    ],

    [
        'slug'         => 'artikel-kedua',
        'title'        => 'Sed Ut Perspiciatis Unde',
        'subtitle'     => 'Nemo enim ipsam voluptatem quia voluptas sit.',
        'date'         => '2026-09-22',
        'date_label'   => '22 September 2026',
        'reading_time' => 6,
        'tags'         => ['Topic One', 'Topic Two'],
        'excerpt'      => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit consequuntur.',
        'body'         => <<<HTML
<p class="article-lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<h3>Section One — Observation & Phenomenon</h3>

<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>

<p>Share personal experience or observations to connect with the reader.</p>

<h3>Section Two — Potential & Opportunities</h3>

<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet.</p>

<p>Explain why this matters now and how things can change.</p>

<h3>Section Three — From Thought to Action</h3>

<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>

<p class="article-closing">Closing remarks to inspire the reader.</p>
HTML,
    ],

    [
        'slug'         => 'artikel-ketiga',
        'title'        => 'At Vero Eos Et Accusamus',
        'subtitle'     => 'Similique sunt in culpa qui officia.',
        'date'         => '2026-10-05',
        'date_label'   => '5 Oktober 2026',
        'reading_time' => 7,
        'tags'         => ['Topic One', 'Topic Two'],
        'excerpt'      => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti. Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.',
        'body'         => <<<HTML
<p class="article-lead">Start with a concrete situation — a scenario, conversation, or moment that illustrates the core issue.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime.</p>

<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

<h3>Section One — Root Cause</h3>

<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus.</p>

<p>Analyze why this issue occurs and what factors contribute to it.</p>

<h3>Section Two — Real Actions</h3>

<p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur ut enim ad minima veniam.</p>

<p class="article-closing">Closing to empower the reader with a role in the change.</p>
HTML,
    ],
];
