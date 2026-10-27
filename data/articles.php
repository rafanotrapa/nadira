<?php
/**
 * data/articles.php
 *
 * Article data store for Nadira Britania's advocacy essays.
 * Each entry holds all metadata needed for both the card preview
 * and the full-text modal/page render in index.php.
 *
 * Fields:
 *   slug        - URL-safe identifier, used as the card's anchor ID
 *   title       - Full essay title (Indonesian language)
 *   subtitle    - Descriptive subtitle / clarifying phrase
 *   date        - ISO 8601 publication date
 *   date_label  - Human-readable display date
 *   reading_time - Estimated reading time in minutes
 *   tags        - Array of topic tags rendered as pill elements
 *   excerpt     - 2-3 sentence teaser shown on the card
 *   body        - Full essay body as an HTML string rendered in the modal
 */

return [
    [
        'slug'         => 'ketika-cuma-bercanda-menjadi-luka',
        'title'        => 'Ketika "Cuma Bercanda" Menjadi Luka',
        'subtitle'     => 'Memahami Perundungan pada Remaja',
        'date'         => '2026-08-14',
        'date_label'   => '14 Agustus 2026',
        'reading_time' => 8,
        'tags'         => ['Anti-Perundungan', 'Kesehatan Mental', 'Remaja'],
        'excerpt'      => 'Pernahkah kamu mendengar seseorang berkata, "Aku hanya bercanda"? Di balik kalimat sederhana itu, tersembunyi sebuah realitas yang menyakitkan bagi jutaan remaja Indonesia. Perundungan bukan sekadar candaan; ia adalah luka yang mengendap.',
        'body'         => <<<HTML
<p class="article-lead">Setiap hari, di lorong-lorong sekolah, di grup WhatsApp, di kolom komentar media sosial, ada remaja yang pulang ke rumah membawa luka yang tidak terlihat. Luka itu bernama perundungan.</p>

<p>Pernahkah kamu mendengar seseorang berkata, <em>"Aku hanya bercanda"</em> setelah mengatakan sesuatu yang menyakitkan? Frasa itu telah menjadi tameng yang digunakan para pelaku untuk menganggap enteng dampak dari tindakan mereka. Namun bagi korban, luka yang ditinggalkan tidak pernah terasa seperti candaan.</p>

<h3>Apa Itu Perundungan?</h3>

<p>Perundungan (bullying) adalah tindakan agresif yang dilakukan secara berulang oleh seseorang atau sekelompok orang terhadap individu yang lebih lemah, dengan tujuan menyakiti, mengintimidasi, atau mendominasi. Perundungan tidak selalu berbentuk kekerasan fisik. Ia hadir dalam banyak wajah:</p>

<ul>
    <li><strong>Perundungan verbal:</strong> ejekan, hinaan, julukan merendahkan</li>
    <li><strong>Perundungan sosial:</strong> pengucilan dari kelompok, penyebaran gosip</li>
    <li><strong>Perundungan fisik:</strong> pukulan, dorongan, perusakan barang</li>
    <li><strong>Perundungan siber (cyberbullying):</strong> pelecehan melalui media sosial, pesan, atau platform digital lainnya</li>
</ul>

<h3>Dampak yang Tidak Terlihat</h3>

<p>Sebuah studi dari Kementerian Kesehatan RI menunjukkan bahwa remaja yang mengalami perundungan berisiko 2,5 kali lebih tinggi mengalami depresi dan kecemasan. Mereka sering kehilangan kepercayaan diri, prestasi akademis mereka menurun, dan dalam kasus yang parah, mereka rentan terhadap pikiran untuk menyakiti diri sendiri.</p>

<p>Sebagai seseorang yang tumbuh di lingkungan sekolah dan kini aktif berinteraksi dengan ratusan remaja di Sumatera Barat, saya menyaksikan sendiri bagaimana perundungan meninggalkan bekas yang dalam. Seorang teman yang dulu ceria bisa berubah menjadi pendiam dan menarik diri hanya dalam hitungan minggu, setelah menjadi sasaran olok-olok di media sosial.</p>

<h3>Peran Kita Sebagai Generasi Muda</h3>

<p>Kita tidak bisa menunggu orang dewasa untuk menyelesaikan masalah ini sendirian. Perubahan dimulai dari teman sebaya. Ada tiga peran yang bisa kita ambil:</p>

<ol>
    <li><strong>Jadi Penyuara (Upstander), Bukan Penonton (Bystander).</strong> Ketika kamu melihat perundungan terjadi, berani bersuara. Satu kata dukungan kepada korban bisa mengubah segalanya.</li>
    <li><strong>Kenali Tandanya.</strong> Perhatikan teman-teman di sekitarmu. Perubahan perilaku yang tiba-tiba, enggan ke sekolah, atau terlihat murung bisa menjadi tanda bahwa mereka membutuhkan bantuan.</li>
    <li><strong>Ciptakan Ruang Aman.</strong> Bangun lingkaran pertemanan yang saling menghargai. Sebuah kelompok pertemanan yang sehat adalah benteng terkuat melawan perundungan.</li>
</ol>

<h3>Kepada Kamu yang Sedang Berjuang</h3>

<p>Jika saat ini kamu sedang mengalami perundungan, saya ingin kamu tahu: <strong>kamu tidak sendirian, dan ini bukan salahmu.</strong> Apa yang terjadi padamu adalah kesalahan pelaku, bukan cerminan nilai dirimu. Bicaralah kepada seseorang yang kamu percaya, seorang guru, orang tua, konselor sekolah, atau teman dekat.</p>

<p>Kamu berhak atas rasa aman. Kamu berhak untuk tumbuh dan bersinar tanpa rasa takut.</p>

<p class="article-closing">Mari bersama kita wujudkan sekolah dan lingkungan yang bebas dari perundungan. Karena setiap remaja berhak mendapatkan masa muda yang penuh kegembiraan, bukan luka.</p>
HTML,
    ],

    [
        'slug'         => 'suara-generasi-z-pemimpin-masa-depan',
        'title'        => 'Suara Generasi Z',
        'subtitle'     => 'Dari Penonton Menjadi Pemimpin Perubahan',
        'date'         => '2026-09-22',
        'date_label'   => '22 September 2026',
        'reading_time' => 6,
        'tags'         => ['Kepemimpinan', 'Generasi Z', 'Pemberdayaan'],
        'excerpt'      => 'Generasi Z sering dicap sebagai generasi yang apatis, selalu menatap layar, dan tidak peduli dunia nyata. Tapi saya percaya sebaliknya: kami adalah generasi yang paling siap memimpin perubahan yang nyata.',
        'body'         => <<<HTML
<p class="article-lead">Ada narasi yang terus berulang tentang generasi kami: bahwa kami sibuk dengan ponsel, tidak peduli politik, dan lebih memilih konten viral daripada aksi nyata. Saya menolak narasi itu.</p>

<p>Generasi Z tumbuh dalam era di mana informasi mengalir deras. Kami menyaksikan krisis iklim, ketidaksetaraan sosial, dan isu kesehatan mental menjadi topik percakapan harian. Dan alih-alih lumpuh oleh informasi itu, banyak dari kami memilih untuk bergerak.</p>

<h3>Potensi yang Sering Diremehkan</h3>

<p>Sebagai perwakilan Sumatera Barat di Miss Teenager Indonesia 2026, saya bertemu dengan ratusan remaja dari seluruh penjuru negeri. Yang saya temukan bukan generasi yang pasif, melainkan generasi yang memiliki kepedulian mendalam terhadap isu-isu sosial dan hanya membutuhkan ruang untuk bersuara.</p>

<p>Kami fasih dalam bahasa digital. Kami bisa mengorganisasi gerakan, menyebarkan informasi penting, dan memobilisasi komunitas melalui platform yang generasi sebelumnya bahkan belum pernah bayangkan. Kemampuan itu, bila diarahkan dengan benar, adalah kekuatan yang luar biasa.</p>

<h3>Dari Kesadaran Menuju Aksi</h3>

<p>Kesadaran tanpa aksi adalah kemewahan yang tidak bisa kita perkenankan diri kita. Maka pertanyaannya bukan lagi, "Apakah kita peduli?" melainkan "Apa yang akan kita lakukan?"</p>

<p>Mulailah dari lingkaran terkecilmu: sekolahmu, komunitasmu, kotamu. Satu aksi kecil yang konsisten jauh lebih berdampak daripada seribu rencana besar yang tidak pernah terwujud.</p>

<p class="article-closing">Suara generasi Z bukan sekadar noise di dunia maya. Ia adalah angin perubahan yang sedang mengumpulkan kekuatannya. Dan saya percaya, saatnya kita berbicara, bukan hanya dengan kata-kata, tapi dengan tindakan nyata.</p>
HTML,
    ],

    [
        'slug'         => 'kesehatan-mental-bukan-kelemahan',
        'title'        => 'Kesehatan Mental Bukan Kelemahan',
        'subtitle'     => 'Menghapus Stigma di Kalangan Pelajar Indonesia',
        'date'         => '2026-10-05',
        'date_label'   => '5 Oktober 2026',
        'reading_time' => 7,
        'tags'         => ['Kesehatan Mental', 'Stigma', 'Pelajar'],
        'excerpt'      => '"Kamu lebay." "Itu hanya perasaan." "Orang lain lebih susah hidupnya." Kalimat-kalimat ini didengar setiap hari oleh remaja yang berani mengakui bahwa mereka sedang tidak baik-baik saja.',
        'body'         => <<<HTML
<p class="article-lead">Di Indonesia, masih ada keyakinan yang mengakar kuat: bahwa membicarakan kesehatan mental adalah tanda kelemahan. Bahwa mengaku sedih, cemas, atau tertekan adalah sesuatu yang memalukan. Keyakinan ini berbahaya, dan sudah saatnya kita mengubahnya.</p>

<p>Menurut data WHO, satu dari tujuh remaja di dunia mengalami gangguan mental. Di Indonesia, angka ini diperkirakan lebih tinggi namun lebih sedikit terdeteksi karena stigma yang masih kuat. Banyak remaja memilih diam daripada dianggap "gila" atau "lebay".</p>

<h3>Akar dari Stigma</h3>

<p>Stigma terhadap kesehatan mental lahir dari kurangnya pemahaman dan percakapan terbuka. Ketika kesehatan mental tidak pernah dibahas di meja makan atau di kelas, kita menciptakan ruang kekosongan yang diisi oleh kesalahpahaman dan rasa malu.</p>

<p>Padahal, kesehatan mental adalah bagian integral dari kesehatan secara keseluruhan. Kita tidak menghakimi seseorang yang kakinya patah karena perlu penyembuhan. Mengapa kita berbeda perlakuan terhadap mereka yang pikiran dan perasaannya membutuhkan pertolongan?</p>

<h3>Langkah Kecil, Dampak Besar</h3>

<p>Perubahan budaya dimulai dari percakapan. Berani bercerita kepada seseorang yang dipercaya. Berani bertanya kepada teman, "Kamu baik-baik saja?" dengan sungguh-sungguh mendengarkan jawabannya. Berani mencari bantuan profesional tanpa rasa malu.</p>

<p class="article-closing">Kamu tidak harus menjalani ini sendirian. Meminta bantuan bukan kelemahan. Itu adalah keberanian tertinggi yang bisa kamu tunjukkan kepada dirimu sendiri.</p>
HTML,
    ],
];
