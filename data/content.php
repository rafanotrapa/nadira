<?php
/**
 * data/content.php
 *
 * BRITAKAN Site Content Data Store
 * --------------------------------
 * All static content for the website in bilingual format.
 * Supports both Bahasa Indonesia (id) and English (en).
 */

$lang = $lang ?? 'en';

$content = [
    'site_name' => 'BRITAKAN',
    'tagline' => 'No Voice Left Unheard.',
    
    'nav' => [
        'home' => $lang === 'id' ? 'Beranda' : 'Home',
        'about' => $lang === 'id' ? 'Tentang BRITAKAN' : 'About BRITAKAN',
        'learn' => $lang === 'id' ? 'Pelajari & Pahami' : 'Learn & Understand',
        'help' => $lang === 'id' ? 'Dapatkan Bantuan' : 'Get Help',
        'report' => $lang === 'id' ? 'Laporkan Insiden' : 'Report an Incident',
        'resources' => $lang === 'id' ? 'Sumber Daya' : 'Resources',
        'contact' => $lang === 'id' ? 'Kontak' : 'Contact',
        'quick_exit' => $lang === 'id' ? 'Keluar Cepat' : 'Quick Exit',
    ],
    
    'hero' => [
        'headline' => $lang === 'id' 
            ? 'TIDAK ADA SUARA YANG TIDAK TERDENGAR.' 
            : 'NO VOICE LEFT UNHEARD.',
        'subheadline' => $lang === 'id'
            ? 'Setiap anak muda berhak mendapatkan keselamatan, rasa hormat, dan kebebasan untuk berbicara tanpa rasa takut. BRITAKAN memberdayakan anak muda untuk mengenali tindakan berbahaya, mengakses dukungan, dan mengambil langkah menuju komunitas yang lebih aman.'
            : 'Every young person deserves safety, respect, and the freedom to speak without fear. BRITAKAN empowers young people to recognize harm, access support, and take steps toward a safer community.',
        'cta_primary' => $lang === 'id' ? 'Dapatkan Bantuan & Dukungan' : 'Get Help & Support',
        'cta_secondary' => $lang === 'id' ? 'Ketahui Hak-Hakmu' : 'Know Your Rights',
        'supporting' => $lang === 'id'
            ? 'Kamu tidak sendirian. Mulailah dengan informasi atau dukungan yang terasa tepat untukmu.'
            : 'You are not alone. Start with the information or support that feels right for you.',
    ],
    
    'why_exists' => [
        'heading' => $lang === 'id'
            ? 'Ruang yang Lebih Aman Dimulai dengan Didengar.'
            : 'A Safer Space Starts With Being Heard.',
        'body' => $lang === 'id'
            ? 'Perundungan, pelecehan seksual, dan kekerasan seksual dapat memengaruhi rasa aman, kepercayaan diri, dan kemampuan anak muda untuk berpartisipasi dalam kehidupan sehari-hari. Namun banyak anak muda yang tidak yakin apakah yang terjadi pada mereka cukup serius untuk dibicarakan, ke mana harus mencari bantuan, atau apa yang terjadi setelah mereka berbicara. BRITAKAN hadir untuk membuat informasi yang dapat diandalkan lebih mudah diakses dan jalur dukungan lebih mudah dipahami. Kami percaya bahwa mendengar itu penting, tetapi mendengar juga harus disertai dengan tindakan yang bertanggung jawab.'
            : 'Bullying, sexual harassment, and sexual assault can affect a young person\'s sense of safety, confidence, and ability to participate in everyday life. Yet many young people are unsure whether what happened to them is serious enough to discuss, where to seek help, or what happens after they speak up. BRITAKAN exists to make reliable information easier to access and support pathways easier to understand. We believe that listening is important, but listening must also be accompanied by responsible action.',
        'cta' => $lang === 'id' ? 'Temukan Misi Kami' : 'Discover Our Mission',
    ],
    
    'focus_areas' => [
        'heading' => $lang === 'id' ? 'Tiga Area Fokus Kami' : 'Our Three Focus Areas',
        'cards' => [
            [
                'title' => $lang === 'id' ? 'Perundungan & Cyberbullying' : 'Bullying & Cyberbullying',
                'description' => $lang === 'id'
                    ? 'Kenali perilaku berbahaya, pahami dampaknya, dan pelajari cara merespons dengan aman, baik terjadi di sekolah, online, maupun lingkungan sosial.'
                    : 'Recognize harmful behavior, understand its impact, and learn how to respond safely, whether it happens at school, online, or in a social environment.',
                'cta' => $lang === 'id' ? 'Pahami Perundungan' : 'Understand Bullying',
                'slug' => 'when-joking-causes-harm',
            ],
            [
                'title' => $lang === 'id' ? 'Pelecehan Seksual' : 'Sexual Harassment',
                'description' => $lang === 'id'
                    ? 'Pelajari tentang batasan pribadi, perilaku yang hormat, keamanan digital, dan langkah-langkah yang tersedia ketika seseorang melanggar batasan tersebut.'
                    : 'Learn about personal boundaries, respectful behavior, digital safety, and the steps available when someone crosses those boundaries.',
                'cta' => $lang === 'id' ? 'Ketahui Batasanmu' : 'Know Your Boundaries',
                'slug' => 'understanding-boundaries-respect',
            ],
            [
                'title' => $lang === 'id' ? 'Kekerasan Seksual & Pelecehan' : 'Sexual Assault & Abuse',
                'description' => $lang === 'id'
                    ? 'Temukan informasi yang sesuai usia tentang mencari bantuan, mengakses dukungan profesional, dan memahami pilihan pelaporan yang tersedia.'
                    : 'Find age-appropriate information about seeking help, accessing professional support, and understanding available reporting options.',
                'cta' => $lang === 'id' ? 'Jelajahi Opsi Dukungan' : 'Explore Support Options',
                'slug' => 'you-deserve-safety-care-support',
            ],
        ],
    ],
    
    'how_it_works' => [
        'heading' => $lang === 'id' ? 'Cara Kerja BRITAKAN' : 'How BRITAKAN Works',
        'steps' => [
            [
                'number' => '01',
                'title' => $lang === 'id' ? 'Pelajari' : 'Learn',
                'description' => $lang === 'id'
                    ? 'Pahami perilaku berbahaya dan hak-hakmu.'
                    : 'Understand harmful behavior and your rights.',
            ],
            [
                'number' => '02',
                'title' => $lang === 'id' ? 'Cari Dukungan' : 'Seek Support',
                'description' => $lang === 'id'
                    ? 'Jelajahi opsi dukungan terpercaya dan sumber daya.'
                    : 'Explore trusted support options and resources.',
            ],
            [
                'number' => '03',
                'title' => $lang === 'id' ? 'Ambil Tindakan' : 'Take Action',
                'description' => $lang === 'id'
                    ? 'Pilih jalur pelaporan atau rujukan yang sesuai.'
                    : 'Choose an appropriate reporting or referral pathway.',
            ],
            [
                'number' => '04',
                'title' => $lang === 'id' ? 'Tindak Lanjut' : 'Follow Up',
                'description' => $lang === 'id'
                    ? 'Pahami langkah selanjutnya dan dukungan yang tersedia.'
                    : 'Understand the next steps and available support.',
            ],
        ],
        'supporting' => $lang === 'id'
            ? 'Setiap situasi berbeda. Kamu dapat menjelajahi sumber daya edukatif tanpa mengirimkan laporan.'
            : 'Everyone\'s situation is different. You can explore educational resources without submitting a report.',
    ],
    
    'message_to_youth' => [
        'heading' => $lang === 'id'
            ? 'Kamu Berhak Dianggap Serius.'
            : 'You Deserve to Be Taken Seriously.',
        'body' => $lang === 'id'
            ? 'Kamu tidak harus membuktikan nilaimu untuk mendapatkan rasa hormat. Kamu tidak harus menghadapi situasi sulit sendirian. Baik kamu langsung terdampak, mendukung teman, atau mencoba memahami apa yang terjadi, keselamatanmu penting. Mulailah dengan langkah yang terasa paling aman untukmu.'
            : 'You do not have to prove your worth to deserve respect. You do not have to face a difficult situation alone. Whether you are directly affected, supporting a friend, or trying to understand what happened, your safety matters. Start with the step that feels safest for you.',
        'cta_primary' => $lang === 'id' ? 'Jelajahi Pilihanmu' : 'Explore Your Options',
        'cta_secondary' => $lang === 'id' ? 'Temukan Dukungan' : 'Find Support',
    ],
    
    'final_cta' => [
        'heading' => $lang === 'id'
            ? 'Kesunyian Tidak Seharusnya Menjadi Satu-satunya Pilihan.'
            : 'Silence Should Never Be the Only Option.',
        'body' => $lang === 'id'
            ? 'Mari membangun komunitas di mana anak muda didengar, didukung, dan dilindungi.'
            : 'Let\'s build communities where young people are heard, supported, and protected.',
        'cta' => $lang === 'id' ? 'Jelajahi BRITAKAN' : 'Explore BRITAKAN',
    ],
    
    'about' => [
        'heading' => $lang === 'id'
            ? 'Lebih dari Sekadar Kesadaran. Komitmen untuk Bertindak.'
            : 'More Than Awareness. A Commitment to Action.',
        'story' => [
            'title' => $lang === 'id' ? 'Cerita Kami' : 'Our Story',
            'body' => $lang === 'id'
                ? 'BRITAKAN adalah inisiatif advokasi pemuda yang berkomitmen untuk mengatasi perundungan, pelecehan seksual, dan kekerasan seksual melalui pendidikan, kesadaran, dan akses ke dukungan. Inisiatif ini mengakui bahwa berbicara bisa sulit, terutama ketika anak muda tidak yakin apakah mereka akan dipercaya, dilindungi, atau dianggap serius. BRITAKAN bertujuan untuk menjembatani kesenjangan antara kesadaran dan tindakan dengan membantu anak muda memahami pilihan mereka dan mengidentifikasi jalur dukungan yang tepat.'
                : 'BRITAKAN is a youth advocacy initiative committed to addressing bullying, sexual harassment, and sexual assault through education, awareness, and access to support. The initiative recognizes that speaking up can be difficult, particularly when young people are uncertain about whether they will be believed, protected, or taken seriously. BRITAKAN aims to bridge the gap between awareness and action by helping young people understand their options and identify appropriate support pathways.',
        ],
        'mission' => [
            'title' => $lang === 'id' ? 'Misi Kami' : 'Our Mission',
            'body' => $lang === 'id'
                ? 'Memberdayakan anak muda melalui pendidikan yang dapat diakses, jalur pelaporan yang lebih aman, dan rujukan yang bertanggung jawab yang mendukung martabat, perlindungan, dan pengambilan keputusan yang tepat.'
                : 'To empower young people through accessible education, safer reporting pathways, and responsible referrals that support dignity, protection, and informed decision-making.',
        ],
        'vision' => [
            'title' => $lang === 'id' ? 'Visi Kami' : 'Our Vision',
            'body' => $lang === 'id'
                ? 'Komunitas di mana setiap anak muda dapat mengakses informasi yang dapat diandalkan, mencari bantuan tanpa rasa malu, dan diperlakukan dengan martabat dan rasa hormat.'
                : 'A community where every young person can access reliable information, seek help without shame, and be treated with dignity and respect.',
        ],
        'values' => [
            'title' => $lang === 'id' ? 'Nilai-Nilai Kami' : 'Our Values',
            'items' => [
                $lang === 'id' ? 'Keselamatan Utama' : 'Safety First',
                $lang === 'id' ? 'Rasa Hormat dan Martabat' : 'Respect and Dignity',
                $lang === 'id' ? 'Pemberdayaan Pemuda' : 'Youth Empowerment',
                $lang === 'id' ? 'Privasi dan Tanggung Jawab' : 'Privacy and Responsibility',
                $lang === 'id' ? 'Akuntabilitas' : 'Accountability',
                $lang === 'id' ? 'Akses Inklusif' : 'Inclusive Access',
            ],
        ],
        'approach' => [
            'title' => $lang === 'id' ? 'Pendekatan Kami' : 'Our Approach',
            'body' => $lang === 'id'
                ? 'BRITAKAN menyediakan informasi edukatif dan menghubungkan pengguna dengan opsi dukungan yang tepat. BRITAKAN bukanlah layanan konseling profesional, lembaga penegak hukum, atau badan investigasi formal, kecuali layanan tersebut benar-benar didirikan.'
                : 'BRITAKAN provides educational information and connects users with appropriate support options. BRITAKAN is not a professional counseling service, law enforcement agency, or formal investigation body unless such services are genuinely established.',
        ],
    ],
    
    'get_help' => [
        'heading' => $lang === 'id'
            ? 'Kamu Tidak Harus Mengatasi Semuanya Sendirian.'
            : 'You Don\'t Have to Figure Everything Out Alone.',
        'intro' => $lang === 'id'
            ? 'Jika sesuatu terjadi padamu, atau kamu khawatir tentang orang lain, ada berbagai cara untuk mencari dukungan. Kamu bisa mulai dengan berbicara dengan seseorang yang kamu percaya atau menghubungi layanan profesional yang tepat.'
            : 'If something has happened to you, or you are worried about someone else, there are different ways to seek support. You can start by speaking with someone you trust or contacting an appropriate professional service.',
        'cards' => [
            [
                'title' => $lang === 'id' ? 'Bahaya Segera' : 'Immediate Danger',
                'body' => $lang === 'id'
                    ? 'Jika kamu menghadapi bahaya langsung, hubungi layanan darurat yang sesuai atau pindah ke tempat yang lebih aman jika memungkinkan.'
                    : 'If you are facing immediate danger, contact the appropriate emergency service or move to a safer place if possible.',
                'type' => 'danger',
            ],
            [
                'title' => $lang === 'id' ? 'Dukungan Berbasis Sekolah' : 'School-Based Support',
                'body' => $lang === 'id'
                    ? 'Hubungi guru yang dipercaya, konselor sekolah, petugas perlindungan anak, atau pemimpin sekolah. Jika orang pertama yang kamu hubungi tidak dapat memberikan bantuan yang aman atau tepat, teruslah mencari.'
                    : 'Contact a trusted teacher, school counselor, designated safeguarding officer, or school leader. If the first person cannot provide safe or appropriate assistance, keep reaching out.',
                'type' => 'school',
            ],
            [
                'title' => $lang === 'id' ? 'Dukungan Profesional' : 'Professional Support',
                'body' => $lang === 'id'
                    ? 'Hubungi layanan konseling, layanan kesehatan, perlindungan anak, atau dukungan kekerasan seksual yang berkualifikasi. Pastikan untuk memverifikasi bahwa layanan tersebut gratis, rahasia, dan dapat diakses oleh anak di bawah umur.'
                    : 'Contact qualified counseling, healthcare, child-protection, or sexual-violence support services. Verify that services are free, confidential, and accessible to minors.',
                'type' => 'professional',
            ],
            [
                'title' => $lang === 'id' ? 'Pelaporan Formal' : 'Formal Reporting',
                'body' => $lang === 'id'
                    ? 'Kamu dapat menjelajahi saluran pelaporan yang tersedia melalui sekolah, layanan perlindungan anak, atau lembaga penegak hukum yang relevan, tergantung pada keadaannya.'
                    : 'You may explore available reporting channels through the relevant school, child-protection service, or law enforcement authority, depending on the circumstances.',
                'type' => 'reporting',
            ],
        ],
    ],
    
    'report' => [
        'heading' => $lang === 'id'
            ? 'Cara Lebih Aman untuk Mencari Langkah Selanjutnya.'
            : 'A Safer Way to Seek the Next Step.',
        'intro' => $lang === 'id'
            ? 'Jika kamu ingin melaporkan insiden, formulir ini dapat membantu kamu mengkomunikasikan apa yang terjadi dan mengidentifikasi dukungan yang mungkin kamu butuhkan. Silakan bagikan hanya informasi yang diperlukan untuk prosesnya.'
            : 'If you want to report an incident, this form can help you communicate what happened and identify the support you may need. Please share only the information necessary for the process.',
        'demo_notice' => $lang === 'id'
            ? 'DEMONSTRASI — Ini adalah formulir demo. Laporan tidak akan dikirim ke pihak manapun. Jangan memasukkan informasi nyata.'
            : 'DEMONSTRATION — This is a demo form. Reports will not be sent to any party. Do not enter real information.',
        'form' => [
            'category' => [
                'label' => $lang === 'id' ? 'Kategori Insiden' : 'Incident Category',
                'options' => [
                    $lang === 'id' ? 'Perundungan' : 'Bullying',
                    $lang === 'id' ? 'Cyberbullying' : 'Cyberbullying',
                    $lang === 'id' ? 'Pelecehan Seksual' : 'Sexual Harassment',
                    $lang === 'id' ? 'Kekerasan Seksual atau Pelecehan' : 'Sexual Assault or Abuse',
                    $lang === 'id' ? 'Kekhawatiran Keamanan Lainnya' : 'Other Safety Concern',
                ],
            ],
            'role' => [
                'label' => $lang === 'id' ? 'Peranmu' : 'Your Role',
                'options' => [
                    $lang === 'id' ? 'Saya mengalami insiden tersebut' : 'I experienced the incident',
                    $lang === 'id' ? 'Saya menyaksikan insiden tersebut' : 'I witnessed the incident',
                    $lang === 'id' ? 'Saya mencari bantuan untuk orang lain' : 'I am seeking help for someone else',
                    $lang === 'id' ? 'Saya tidak yakin dan butuh panduan' : 'I am unsure and need guidance',
                ],
            ],
            'submit' => $lang === 'id' ? 'Kirim Laporan' : 'Submit Report',
        ],
        'confirmation' => [
            'title' => $lang === 'id'
                ? 'Laporanmu Telah Diterima.'
                : 'Your Submission Has Been Received.',
            'body' => $lang === 'id'
                ? 'Informasimu telah berhasil dikirim. Simpan nomor referensi kamu. Ini dapat membantu kamu mengakses proses tindak lanjut yang tersedia.'
                : 'Your information has been submitted successfully. Please save your reference number. It can help you access the available follow-up process.',
        ],
    ],
    
    'resources' => [
        'heading' => $lang === 'id'
            ? 'Pengetahuan Adalah Titik Awal. Dukungan Adalah Langkah Selanjutnya.'
            : 'Knowledge Is a Starting Point. Support Is the Next Step.',
        'categories' => [
            $lang === 'id' ? 'Pencegahan Perundungan' : 'Bullying Prevention',
            $lang === 'id' ? 'Keamanan Digital' : 'Digital Safety',
            $lang === 'id' ? 'Persetujuan dan Batasan' : 'Consent and Boundaries',
            $lang === 'id' ? 'Dukungan Kekerasan Seksual' : 'Sexual Violence Support',
            $lang === 'id' ? 'Panduan untuk Orang Tua' : 'Guidance for Parents',
            $lang === 'id' ? 'Panduan untuk Pendidik' : 'Guidance for Educators',
            $lang === 'id' ? 'Advokasi Pemuda' : 'Youth Advocacy',
        ],
    ],
    
    'contact' => [
        'heading' => $lang === 'id'
            ? 'Mari Membuat Komunitas yang Lebih Aman Bersama.'
            : 'Let\'s Make Safer Communities Together.',
        'body' => $lang === 'id'
            ? 'BRITAKAN menyambut peluang untuk berkolaborasi dengan sekolah, komunitas pemuda, pendidik, dan organisasi yang bekerja untuk meningkatkan keselamatan dan kesejahteraan anak muda.'
            : 'BRITAKAN welcomes opportunities to collaborate with schools, youth communities, educators, and organizations working to improve young people\'s safety and well-being.',
    ],
    
    'footer' => [
        'statement' => $lang === 'id'
            ? 'BRITAKAN adalah inisiatif advokasi pemuda yang berfokus pada pendidikan, keselamatan, dan akses ke dukungan. Situs web ini tidak menggantikan layanan darurat, konseling profesional, perawatan medis, atau otoritas investigasi formal.'
            : 'BRITAKAN is a youth advocacy initiative focused on education, safety, and access to support. This website does not replace emergency services, professional counseling, medical care, or formal investigative authorities.',
        'links' => [
            $lang === 'id' ? 'Tentang BRITAKAN' : 'About BRITAKAN',
            $lang === 'id' ? 'Pelajari & Pahami' : 'Learn & Understand',
            $lang === 'id' ? 'Dapatkan Bantuan & Dukungan' : 'Get Help & Support',
            $lang === 'id' ? 'Pemberitahuan Privasi' : 'Privacy Notice',
            $lang === 'id' ? 'Kebijakan Perlindungan' : 'Safeguarding Policy',
            $lang === 'id' ? 'Aksesibilitas' : 'Accessibility',
            $lang === 'id' ? 'Kontak' : 'Contact',
        ],
    ],
];

return $content;
