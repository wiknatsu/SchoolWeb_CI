<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Seed Users
        $db->table('users')->truncate();
        $users = [
            [
                'id'            => 1,
                'username'      => 'superadmin',
                'email'         => 'superadmin@smpnegeri3abiansemal.sch.id',
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                'full_name'     => 'Administrator Utama',
                'role'          => 'superadmin',
                'avatar'        => null,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 2,
                'username'      => 'admin',
                'email'         => 'admin@smpnegeri3abiansemal.sch.id',
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                'full_name'     => 'Admin Akademik & Kurikulum',
                'role'          => 'admin',
                'avatar'        => null,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 3,
                'username'      => 'editor',
                'email'         => 'editor@smpnegeri3abiansemal.sch.id',
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                'full_name'     => 'Tim Jurnalistik & Publikasi',
                'role'          => 'editor',
                'avatar'        => null,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
        ];
        $db->table('users')->insertBatch($users);

        // 2. Seed School Profile
        $db->table('school_profiles')->truncate();
        $socialMedia = json_encode([
            'facebook'  => 'https://facebook.com/smpnegeri3abiansemal',
            'instagram' => 'https://instagram.com/smpn3abiansemal',
            'youtube'   => 'https://youtube.com/@smpnegeri3abiansemal',
            'tiktok'    => 'https://tiktok.com/@smpn3abiansemal',
            'twitter'   => 'https://twitter.com/smpn3abiansemal',
        ]);

        $vision = 'Terwujudnya murid yang "CEMPAKA" (Cerdas, EMPAti, berKArakter) berlandaskan Tri Hita Karana.';

        $mission = "1. Mengembangkan kecerdasan holistik pada murid melalui pembelajaran mendalam yang dapat menumbuhkan dimensi profil lulusan.\n2. Mengembangkan potensi murid sesuai minat dan bakat dalam kegiatan pengembangan diri dan ekstrakurikuler.\n3. Meningkatkan kesadaran dan kepedulian murid terhadap sesama warga sekolah, masyarakat, dan kelestarian lingkungan.\n4. Menanamkan dan memperkuat nilai-nilai Tri Hita Karana (Parahyangan, Pawongan, dan Palemahan) dalam setiap aspek kehidupan murid di sekolah, rumah, maupun masyarakat.\n5. Mewujudkan tata kelola satuan pendidikan yang adaptif, akuntabel, transparan, serta berbasis ekosistem digital.";

        $welcome = "<p class='mb-3'><strong>Om Swastyastu, Assalamu'alaikum Warahmatullahi Wabarakatuh, Salam Sejahtera, Rahayu bagi Kita Semua.</strong></p><p class='mb-3'>Selamat datang di portal resmi <strong>SMP Negeri 3 Abiansemal</strong>. Website ini kami hadirkan sebagai media komunikasi interaktif, pusat informasi, serta wujud akuntabilitas publik bagi seluruh peserta didik, tenaga pendidik, orang tua, alumni, dan masyarakat luas.</p><p class='mb-3'>Dengan mengusung moto kepemimpinan <em>'Mendidik dengan Hati, Memimpin dengan Cerdas'</em> serta semboyan sekolah <em>'Unggul dalam Mutu, Berkarakter dalam Prestasi'</em>, kami meyakini bahwa setiap anak adalah bintang yang memiliki keunikan dan potensi untuk bersinar dengan caranya masing-masing.</p><p class='mb-3'>Berlandaskan filosofi kearifan lokal <strong>Tri Hita Karana</strong>, kami berkomitmen membentuk generasi murid yang <strong>CEMPAKA (Cerdas, EMPAti, berKArakter)</strong> yang unggul secara akademis, beretika luhur, dan peduli terhadap kelestarian alam dan budaya Bali.</p><p>Semoga kehadiran website ini senantiasa memberikan manfaat yang luas. <em>Om Shanti, Shanti, Shanti, Om.</em></p>";

        $mapEmbed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.023223947471!2d115.212000!3d-8.583300!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f95e54d5b27%3A0x7d6df3c0e35928d1!2sSMP%20Negeri%203%20Abiansemal!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';

        $profile = [
            'id'                => 1,
            'school_name'       => 'SMP Negeri 3 Abiansemal',
            'slogan'            => 'Mendidik dengan Hati, Memimpin dengan Cerdas | Unggul dalam Mutu, Berkarakter dalam Prestasi',
            'description'       => 'SMP Negeri 3 Abiansemal adalah sekolah menengah pertama negeri di Kabupaten Badung, Bali yang berkomitmen mendidik murid berkarakter CEMPAKA (Cerdas, Empati, Berkarakter) berlandaskan kearifan lokal Tri Hita Karana.',
            'logo'              => null,
            'favicon'           => null,
            'address'           => 'Br. Sintrig, Sibangkaja, Kec. Abiansemal, Kabupaten Badung, Provinsi Bali 80352',
            'phone'             => '(0361) 469338',
            'email'             => 'smpn3abs@yahoo.co.id',
            'website'           => 'https://smpnegeri3abiansemal.sch.id',
            'social_media'      => $socialMedia,
            'vision'            => $vision,
            'mission'           => $mission,
            'principal_name'    => 'I Nyoman Budiasa, S.Pd., M.M.',
            'principal_photo'   => null,
            'principal_welcome' => $welcome,
            'established_year'  => '1984',
            'accreditation'     => 'A (Unggul)',
            'map_embed'         => $mapEmbed,
            'meta_keywords'     => 'SMP Negeri 3 Abiansemal, SMP Badung, SMP Bali, Sekolah Penggerak, Profil SMPN 3 Abiansemal, PPDB SMP Badung 2026, Tri Hita Karana, Murid CEMPAKA',
            'meta_description'  => 'Website Resmi SMP Negeri 3 Abiansemal, Kabupaten Badung, Bali. Informasi kurikulum, PPDB online, prestasi murid, galeri kegiatan, dan layanan digital sekolah.',
            'is_active'         => 1,
            'updated_at'        => Time::now()->toDateTimeString(),
        ];
        $db->table('school_profiles')->insert($profile);

        // 3. Seed News Categories
        $db->table('news_categories')->truncate();
        $categories = [
            [
                'id'          => 1,
                'name'        => 'Akademik & Kurikulum',
                'slug'        => 'akademik-kurikulum',
                'description' => 'Informasi pembelajaran Kurikulum Merdeka, asesmen sekolah, jadwal ujian, dan kegiatan akademik.',
                'icon'        => 'fas fa-graduation-cap',
                'is_active'   => 1,
                'created_at'  => Time::now()->toDateTimeString(),
                'updated_at'  => Time::now()->toDateTimeString(),
            ],
            [
                'id'          => 2,
                'name'        => 'Prestasi Siswa & Guru',
                'slug'        => 'prestasi-siswa-guru',
                'description' => 'Kabar capaian prestasi membanggakan murid dan guru di ajang kabupaten, provinsi, hingga nasional.',
                'icon'        => 'fas fa-trophy',
                'is_active'   => 1,
                'created_at'  => Time::now()->toDateTimeString(),
                'updated_at'  => Time::now()->toDateTimeString(),
            ],
            [
                'id'          => 3,
                'name'        => 'Seni Budaya & Ekstrakurikuler',
                'slug'        => 'seni-budaya-ekstrakurikuler',
                'description' => 'Kegiatan seni tabuh/gamelan, tari Bali, pramuka, PMR, olahraga, dan pengembangan diri.',
                'icon'        => 'fas fa-palette',
                'is_active'   => 1,
                'created_at'  => Time::now()->toDateTimeString(),
                'updated_at'  => Time::now()->toDateTimeString(),
            ],
            [
                'id'          => 4,
                'name'        => 'Pengumuman Resmi',
                'slug'        => 'pengumuman-resmi',
                'description' => 'Surat edaran kedinasan, PPDB SMP Online, beasiswa, dan pemberitahuan resmi sekolah.',
                'icon'        => 'fas fa-bullhorn',
                'is_active'   => 1,
                'created_at'  => Time::now()->toDateTimeString(),
                'updated_at'  => Time::now()->toDateTimeString(),
            ],
            [
                'id'          => 5,
                'name'        => 'Agenda & Keagamaan',
                'slug'        => 'agenda-keagamaan',
                'description' => 'Jadwal perayaan hari besar keagamaan, upacara piodalan, aksi palemahan, dan event sekolah.',
                'icon'        => 'fas fa-calendar-alt',
                'is_active'   => 1,
                'created_at'  => Time::now()->toDateTimeString(),
                'updated_at'  => Time::now()->toDateTimeString(),
            ],
        ];
        $db->table('news_categories')->insertBatch($categories);

        // 4. Seed News
        $db->table('news')->truncate();
        $news = [
            [
                'id'             => 1,
                'title'          => 'Murid SMP Negeri 3 Abiansemal Raih Juara 1 Olimpiade Sains & Riset Pelajar Se-Bali',
                'slug'           => 'murid-smp-negeri-3-abiansemal-raih-juara-1-olimpiade-sains-riset-pelajar-se-bali',
                'excerpt'        => 'Prestasi membanggakan diraih oleh kontingen sains SMPN 3 Abiansemal dalam ajang Olimpiade Sains dan Karya Tulis Ilmiah Pelajar tingkat Provinsi.',
                'content'        => '<p>Prestasi gemilang kembali ditorehkan oleh murid-murid berbakat <strong>SMP Negeri 3 Abiansemal</strong> di tingkat Provinsi Bali. Dalam ajang bergengsi <em>Olimpiade Sains dan Riset Pelajar SMP 2026</em>, tim riset IPA sekolah berhasil menyabet gelar <strong>Juara 1</strong> dengan mengangkat topik pemanfaatan kearifan lokal dalam konservasi lingkungan hidup (Palemahan).</p><p>Kepala Sekolah SMP Negeri 3 Abiansemal, <strong>I Nyoman Budiasa, S.Pd., M.M.</strong>, mengapresiasi kerja keras para murid dan guru pembimbing. Beliau menyampaikan bahwa pencapaian ini membuktikan komitmen sekolah dalam mewujudkan murid CEMPAKA (Cerdas, Empati, Berkarakter) yang berdaya saing tinggi.</p><p>Pihak sekolah akan terus memfasilitasi pembinaan intensif bagi seluruh ekstrakurikuler sains, bahasa, dan riset agar murid semakin siap melangkah ke kompetisi tingkat nasional (OSN).</p>',
                'featured_image' => null,
                'category_id'    => 2,
                'author_id'      => 1,
                'status'         => 'published',
                'published_at'   => Time::now()->subDays(2)->toDateTimeString(),
                'view_count'     => 1420,
                'is_highlighted' => 1,
                'meta_keywords'  => 'olimpiade sains smp, juara osn bali, smp negeri 3 abiansemal, prestasi murid badung',
                'meta_description' => 'Siswa SMP Negeri 3 Abiansemal sukses menorehkan prestasi Juara 1 Olimpiade Sains dan Riset Pelajar Se-Bali.',
                'created_at'     => Time::now()->subDays(2)->toDateTimeString(),
                'updated_at'     => Time::now()->subDays(2)->toDateTimeString(),
            ],
            [
                'id'             => 2,
                'title'          => 'Penerimaan Peserta Didik Baru (PPDB) SMP Negeri 3 Abiansemal Tahun Ajaran 2026/2027',
                'slug'           => 'penerimaan-peserta-didik-baru-ppdb-smp-negeri-3-abiansemal-tahun-ajaran-2026-2027',
                'excerpt'        => 'Panduan resmi jadwal, syarat berkas, dan tata cara pendaftaran daring PPDB Online SMP Negeri 3 Abiansemal Kabupaten Badung.',
                'content'        => '<p>SMP Negeri 3 Abiansemal secara resmi mengumumkan pelaksanaan <strong>Penerimaan Peserta Didik Baru (PPDB) Daring</strong> untuk Tahun Ajaran 2026/2027. Seluruh tahapan pendaftaran terintegrasi dengan sistem PPDB Dinas Pendidikan Pemuda dan Olahraga Kabupaten Badung.</p><h3>Jalur PPDB yang Tersedia:</h3><ul><li><strong>Jalur Zonasi</strong>: Diperuntukkan bagi calon peserta didik yang berdomisili di dalam wilayah zonasi SMP Negeri 3 Abiansemal (Sibangkaja dan sekitarnya).</li><li><strong>Jalur Afirmasi</strong>: Memberikan kemudahan bagi calon murid dari keluarga ekonomi kurang mampu serta penyandang disabilitas.</li><li><strong>Jalur Prestasi</strong>: Terbuka untuk prestasi akademik (nilai rapor, piagam sains) dan non-akademik (seni tari, tabuh/megamel, olahraga, kepramukaan).</li><li><strong>Jalur Perpindahan Tugas Orang Tua / Wali</strong>.</li></ul><p>Orang tua/wali murid dapat berkonsultasi langsung di Posko Layanan Informasi PPDB di aula sekolah setiap hari kerja.</p>',
                'featured_image' => null,
                'category_id'    => 4,
                'author_id'      => 1,
                'status'         => 'published',
                'published_at'   => Time::now()->subDays(4)->toDateTimeString(),
                'view_count'     => 3250,
                'is_highlighted' => 1,
                'meta_keywords'  => 'PPDB SMP 2026, PPDB Badung, SMP Negeri 3 Abiansemal, pendaftaran murid baru sibangkaja',
                'meta_description' => 'Informasi lengkap jadwal dan alur PPDB Online SMP Negeri 3 Abiansemal tahun pelajaran 2026/2027.',
                'created_at'     => Time::now()->subDays(4)->toDateTimeString(),
                'updated_at'     => Time::now()->subDays(4)->toDateTimeString(),
            ],
            [
                'id'             => 3,
                'title'          => 'Implementasi Kurikulum Merdeka dan Penguatan Profil Pelajar Pancasila di SMPN 3 Abiansemal',
                'slug'           => 'implementasi-kurikulum-merdeka-dan-penguatan-profil-pelajar-pancasila-di-smpn-3-abiansemal',
                'excerpt'        => 'Pembelajaran kontekstual berbasis proyek P5 yang mengintegrasikan nilai kearifan lokal Bali dan literasi digital.',
                'content'        => '<p>Dalam rangka memperkokoh karakter generasi muda, SMP Negeri 3 Abiansemal terus mengoptimalkan pelaksanaan <strong>Projek Penguatan Profil Pelajar Pancasila (P5)</strong> dalam Kurikulum Merdeka.</p><p>Tema yang diangkat pada semester ini mencakup <em>Kearifan Lokal</em> dan <em>Gaya Hidup Berkelanjutan</em>. Para murid diajak melakukan aksi nyata pemilahan sampah organik dan anorganik, pembuatan kompos, serta pelestarian tanaman upakara di lingkungan kebun sekolah (Palemahan).</p><p>Program ini berhasil memupuk empati, kolaborasi gotong royong, dan rasa tanggung jawab murid terhadap lingkungan sekolah yang hijau, bersih, dan asri.</p>',
                'featured_image' => null,
                'category_id'    => 1,
                'author_id'      => 2,
                'status'         => 'published',
                'published_at'   => Time::now()->subDays(7)->toDateTimeString(),
                'view_count'     => 890,
                'is_highlighted' => 0,
                'meta_keywords'  => 'kurikulum merdeka smp, p5 profil pelajar pancasila, tri hita karana, smpn 3 abiansemal',
                'meta_description' => 'Pelaksanaan pembelajaran Kurikulum Merdeka dan Projek P5 berbasis kearifan lokal di SMPN 3 Abiansemal.',
                'created_at'     => Time::now()->subDays(7)->toDateTimeString(),
                'updated_at'     => Time::now()->subDays(7)->toDateTimeString(),
            ],
            [
                'id'             => 4,
                'title'          => 'Sanggar Seni SMPN 3 Abiansemal Juara Festival Tabuh & Seni Tari Remaja Kabupaten Badung',
                'slug'           => 'sanggar-seni-smpn-3-abiansemal-juara-festival-tabuh-dan-seni-tari-remaja-kabupaten-badung',
                'excerpt'        => 'Penampilan memukau tabuh gong kebyar dan tari kreasi murid SMP Negeri 3 Abiansemal sukses memikat dewan juri.',
                'content'        => '<p>Kabar membanggakan datang dari bidang seni dan budaya. Sanggar Seni dan Karawitan SMP Negeri 3 Abiansemal berhasil meraih penghargaan bergengsi pada <em>Festival Seni Budaya Pelajar Kabupaten Badung 2026</em>.</p><p>Para penabuh dan penari yang terdiri dari murid kelas VII dan VIII tampil kompak dan penuh penjiwaan membawakan tabuh kreasi kekebyaran dan tari tradisi Bali. Pembina ekstrakurikuler seni menuturkan bahwa latihan intensif dilakukan secara konsisten di wantilan sekolah.</p><p>Prestasi ini menjadi bukti nyata komitmen sekolah dalam melestarikan seni budaya adiluhung Bali di kalangan generasi muda.</p>',
                'featured_image' => null,
                'category_id'    => 3,
                'author_id'      => 3,
                'status'         => 'published',
                'published_at'   => Time::now()->subDays(10)->toDateTimeString(),
                'view_count'     => 1150,
                'is_highlighted' => 0,
                'meta_keywords'  => 'seni tari bali, tabuh gong kebyar, ekstrakurikuler seni, porsenijar badung, smp 3 abiansemal',
                'meta_description' => 'Sanggar Seni SMP Negeri 3 Abiansemal borong prestasi di Festival Seni Tabuh dan Tari Remaja Badung.',
                'created_at'     => Time::now()->subDays(10)->toDateTimeString(),
                'updated_at'     => Time::now()->subDays(10)->toDateTimeString(),
            ],
            [
                'id'             => 5,
                'title'          => 'Peringatan Rahina Tumpek Wariga: Aksi Tanam Pohon dan Bakti Lingkungan Asri',
                'slug'           => 'peringatan-rahina-tumpek-wariga-aksi-tanam-pohon-dan-bakti-lingkungan-asri',
                'excerpt'        => 'Menghayati nilai Palemahan Tri Hita Karana, seluruh warga sekolah menggelar persembahyangan dan penghijauan lingkungan.',
                'content'        => '<p>Memaknai peringatan hari suci <em>Tumpek Wariga (Tumpek Pengatag/Pengarah)</em>, civitas akademika SMP Negeri 3 Abiansemal menyelenggarakan persembahyangan bersama di Padmasana sekolah yang dilanjutkan dengan aksi penanaman pohon penghijauan.</p><p>Kepala Sekolah menekankan bahwa peringatan Tumpek Wariga adalah bentuk syukur dan pemuliaan terhadap tumbuh-tumbuhan dan alam semesta yang menjadi sumber penghidupan, sejalan dengan pilar <strong>Palemahan</strong> dalam Tri Hita Karana.</p><p>Setiap kelas merawat taman kelas masing-masing guna menciptakan iklim belajar yang sejuk, rindang, dan nyaman.</p>',
                'featured_image' => null,
                'category_id'    => 5,
                'author_id'      => 3,
                'status'         => 'published',
                'published_at'   => Time::now()->subDays(15)->toDateTimeString(),
                'view_count'     => 940,
                'is_highlighted' => 0,
                'meta_keywords'  => 'tumpek wariga, palemahan, tri hita karana, lingkungan hidup sekolah, smpn 3 abiansemal',
                'meta_description' => 'SMP Negeri 3 Abiansemal laksanakan upacara persembahyangan dan penanaman pohon serangkaian Tumpek Wariga.',
                'created_at'     => Time::now()->subDays(15)->toDateTimeString(),
                'updated_at'     => Time::now()->subDays(15)->toDateTimeString(),
            ],
            [
                'id'             => 6,
                'title'          => 'PMR Madya & Pramuka SMPN 3 Abiansemal Gelar Latihan Gabungan Pertolongan Pertama',
                'slug'           => 'pmr-madya-dan-pramuka-smpn-3-abiansemal-gelar-latihan-gabungan-pertolongan-pertama',
                'excerpt'        => 'Meningkatkan ketanggapan dan kepedulian sosial murid melalui simulasi kebencanaan dan pertolongan pertama bersama PMI Badung.',
                'content'        => '<p>Ekstrakurikuler Palang Merah Remaja (PMR) Madya dan Gerakan Pramuka Gugus Depan SMP Negeri 3 Abiansemal sukses menggelar latihan gabungan <strong>Simulasi Mitigasi Kebencanaan dan Pertolongan Pertama (PP)</strong>.</p><p>Kegiatan yang melibatkan instruktur dari Palang Merah Indonesia (PMI) Cabang Badung ini melatih para murid tentang teknik pembalutan luka, evakuasi korban, serta kesiapsiagaan menghadapi potensi gempa bumi dan kebakaran.</p><p>Melalui kegiatan ini, diharapkan karakter empati dan kepedulian sosial murid CEMPAKA semakin terasah dalam kehidupan sehari-hari.</p>',
                'featured_image' => null,
                'category_id'    => 3,
                'author_id'      => 2,
                'status'         => 'published',
                'published_at'   => Time::now()->subDays(20)->toDateTimeString(),
                'view_count'     => 620,
                'is_highlighted' => 0,
                'meta_keywords'  => 'pmr madya, pramuka smp, pmi badung, mitigasi bencana, empati siswa',
                'meta_description' => 'PMR Madya dan Pramuka SMP Negeri 3 Abiansemal gelar latihan simulasi kebencanaan dan pertolongan pertama.',
                'created_at'     => Time::now()->subDays(20)->toDateTimeString(),
                'updated_at'     => Time::now()->subDays(20)->toDateTimeString(),
            ],
        ];
        $db->table('news')->insertBatch($news);

        // 5. Seed School Apps
        $db->table('school_apps')->truncate();
        $apps = [
            [
                'id'            => 1,
                'name'          => 'E-Learning LMS SMP',
                'description'   => 'Portal materi pembelajaran daring interaktif, pengumpulan tugas murid, dan asesmen harian.',
                'icon'          => 'fas fa-laptop-code',
                'url'           => 'https://elearning.smpnegeri3abiansemal.sch.id',
                'category'      => 'academic',
                'display_order' => 1,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 2,
                'name'          => 'Perpustakaan Digital (E-Pusda)',
                'description'   => 'Katalog buku pelajaran elektronik, ensiklopedia sains, pojok baca digital, dan buku fiksi.',
                'icon'          => 'fas fa-book-reader',
                'url'           => 'https://perpus.smpnegeri3abiansemal.sch.id',
                'category'      => 'library',
                'display_order' => 2,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 3,
                'name'          => 'Portal PPDB Online',
                'description'   => 'Sistem informasi pendaftaran calon peserta didik baru terpadu Kabupaten Badung.',
                'icon'          => 'fas fa-user-graduate',
                'url'           => 'https://ppdb.smpnegeri3abiansemal.sch.id',
                'category'      => 'academic',
                'display_order' => 3,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 4,
                'name'          => 'CBT Asesmen & Ujian',
                'description'   => 'Aplikasi pelaksanaan asesmen sumatif, penilaian tengah semester, dan tryout berbasis komputer.',
                'icon'          => 'fas fa-file-signature',
                'url'           => 'https://cbt.smpnegeri3abiansemal.sch.id',
                'category'      => 'exam',
                'display_order' => 4,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 5,
                'name'          => 'SIM Akademik & Presensi',
                'description'   => 'Sistem pemantauan kehadiran murid digital, rekap nilai rapor, dan buku induk siswa.',
                'icon'          => 'fas fa-id-card-alt',
                'url'           => 'https://sim.smpnegeri3abiansemal.sch.id',
                'category'      => 'academic',
                'display_order' => 5,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 6,
                'name'          => 'Tracer Alumni & Komite',
                'description'   => 'Portal jejaring komunikasi alumni SMPN 3 Abiansemal dan sinergi komite sekolah.',
                'icon'          => 'fas fa-users',
                'url'           => 'https://alumni.smpnegeri3abiansemal.sch.id',
                'category'      => 'alumni',
                'display_order' => 6,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
        ];
        $db->table('school_apps')->insertBatch($apps);

        // 6. Seed Static Pages
        $db->table('pages')->truncate();
        $pages = [
            [
                'id'            => 1,
                'title'         => 'Tentang Sekolah & Sejarah',
                'slug'          => 'tentang-sekolah',
                'content'       => '<h2>Sejarah Berdirinya SMP Negeri 3 Abiansemal</h2><p>SMP Negeri 3 Abiansemal didirikan pada tahun 1984 di Banjar Sintrig, Desa Sibangkaja, Kecamatan Abiansemal, Kabupaten Badung, Bali. Kehadiran sekolah ini merupakan wujud dedikasi untuk mencerdaskan kehidupan bangsa dan menyediakan akses pendidikan berkualitas bagi masyarakat di wilayah Abiansemal dan sekitarnya.</p><p>Dalam perjalanannya, SMP Negeri 3 Abiansemal terus berkembang menjadi sekolah berakreditasi A yang unggul dalam prestasi akademik, seni budaya, serta pembinaan budi pekerti luhur.</p><h3>Filosofi Karakter: Murid CEMPAKA & Tri Hita Karana</h3><p>Sekolah mengusung visi pembentukan murid <strong>CEMPAKA (Cerdas, EMPAti, berKArakter)</strong> yang berakar kuat pada nilai-nilai kearifan lokal <strong>Tri Hita Karana</strong>:</p><ul><li><strong>Parahyangan</strong>: Membina keimanan dan ketakwaan melalui persembahyangan dan budi pekerti religius.</li><li><strong>Pawongan</strong>: Memupuk rasa persaudaraan (menyama braya), empati, toleransi, dan gotong royong antar sesama warga sekolah.</li><li><strong>Palemahan</strong>: Menumbuhkan cinta dan kepedulian terhadap kelestarian lingkungan alam sekitar sekolah.</li></ul>',
                'template'      => 'about',
                'featured_image'=> null,
                'meta_keywords' => 'tentang smp negeri 3 abiansemal, sejarah sekolah, profil smpn 3 abiansemal, cempaka tri hita karana',
                'meta_description' => 'Mengenal profil, sejarah berdiri, visi misi, dan nilai luhur SMP Negeri 3 Abiansemal Badung Bali.',
                'display_order' => 1,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 2,
                'title'         => 'Fasilitas & Sarana Prasarana',
                'slug'          => 'fasilitas-sekolah',
                'content'       => '<h2>Sarana & Prasarana Penunjang Pembelajaran</h2><p>Untuk menunjang proses pembelajaran yang optimal, nyaman, dan menyenangkan, SMP Negeri 3 Abiansemal dilengkapi dengan fasilitas terpadu:</p><ul><li><strong>Ruang Kelas Representatif</strong>: Ruang belajar bersih, nyaman, dilengkapi sarana multimedia dan proyektor.</li><li><strong>Laboratorium IPA Terpadu</strong>: Fasilitas praktikum Fisika dan Biologi lengkap dengan peralatan modern.</li><li><strong>Laboratorium Komputer & TIK</strong>: Dilengkapi unit komputer terkoneksi internet pita lebar untuk asesmen daring dan pembelajaran digital.</li><li><strong>Perpustakaan Graha Widya</strong>: Koleksi buku pelajaran, ensiklopedia ilmu pengetahuan, buku fiksi, dan ruang baca asri.</li><li><strong>Wantilan & Ruang Seni Tradisi</strong>: Tempat latihan seni tabuh gong kebyar, tari Bali, dan kegiatan apresiasi seni budaya.</li><li><strong>Padmasana & Tempat Ibadah</strong>: Sarana persembahyangan yang megah dan asri di lingkungan sekolah.</li><li><strong>Lapangan Olahraga Serbaguna</strong>: Lapangan upacara, basket, voli, dan bulu tangkis.</li><li><strong>Kantin Sehat & UKS</strong>: Menyediakan konsumsi higienis dan layanan kesehatan pertolongan pertama bagi murid.</li></ul>',
                'template'      => 'facilities',
                'featured_image'=> null,
                'meta_keywords' => 'fasilitas smpn 3 abiansemal, laboratorium ipa, lab komputer, wantilan seni, sarana smp badung',
                'meta_description' => 'Sarana prasarana penunjang pembelajaran berkualitas di SMP Negeri 3 Abiansemal Badung.',
                'display_order' => 2,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 3,
                'title'         => 'Daftar Prestasi Membanggakan',
                'slug'          => 'prestasi-sekolah',
                'content'       => '<h2>Rekam Jejak Prestasi SMP Negeri 3 Abiansemal</h2><p>Berkat dedikasi dan kerja keras para murid serta bimbingan guru pembina, SMP Negeri 3 Abiansemal terus mengukir capaian membanggakan:</p><h3>Bidang Seni Budaya & Keagamaan</h3><ul><li>Juara 1 Lomba Seni Tari Tradisi Bali Tingkat Remaja Kabupaten Badung</li><li>Juara 1 Lomba Tabuh Karawitan Pelajar Tingkat Kabupaten</li><li>Juara 2 Utsawa Dharma Gita (Macepat & Sloka) Tingkat Kabupaten Badung</li></ul><h3>Bidang Sains & Akademik</h3><ul><li>Juara 1 Olimpiade Sains & Riset Pelajar Se-Bali</li><li>Juara 2 Olimpiade Matematika SMP Tingkat Kabupaten</li><li>Finalis Olimpiade Sains Nasional (OSN) Tingkat Provinsi</li></ul><h3>Bidang Olahraga & Kepramukaan</h3><ul><li>Medali Emas Cabang Atletik Porsenijar Kabupaten Badung</li><li>Juara Umum Lomba Keterampilan Pramuka Penggalang Se-Kwartir Cabang Badung</li><li>Juara 2 Lomba Pertolongan Pertama PMR Madya Se-Kabupaten Badung</li></ul>',
                'template'      => 'achievements',
                'featured_image'=> null,
                'meta_keywords' => 'prestasi smp negeri 3 abiansemal, juara seni tari bali, juara osn badung, porsenijar badung',
                'meta_description' => 'Deretan prestasi akademik, seni budaya Bali, dan olahraga murid SMP Negeri 3 Abiansemal.',
                'display_order' => 3,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
            [
                'id'            => 4,
                'title'         => 'Tata Tertib & Kode Etik Murid',
                'slug'          => 'tata-tertib',
                'content'       => '<h2>Pedoman Kedisiplinan & Budaya Positif Sekolah</h2><p>Tata tertib ini disusun untuk menciptakan lingkungan sekolah yang aman, tertib, berbudaya luhur, dan kondusif bagi tumbuh kembang murid CEMPAKA.</p><h3>Ketentuan Umum:</h3><ol><li>Murid wajib hadir di sekolah paling lambat pukul 07.00 WITA sebelum kegiatan persembahyangan/literasi bersama dimulai.</li><li>Mengenakan pakaian seragam rapi, sopan, dan atribut lengkap sesuai jadwal hari yang telah ditentukan (termasuk pakaian adat Bali pada hari tertentu / Purnama-Tilem).</li><li>Membiasakan budaya 5S (Senyum, Salam, Sapa, Sopan, Santun) serta nilai saling menghormati (Menyama Braya).</li><li>Menjaga kebersihan lingkungan sekolah dan tidak membawa kemasan plastik sekali pakai (Zero Waste Plastic Zone).</li><li>Dilarang keras melakukan perundungan (bullying), kekerasan fisik/verbal, ataupun tindakan diskriminatif dalam bentuk apa pun.</li></ol>',
                'template'      => 'default',
                'featured_image'=> null,
                'meta_keywords' => 'tata tertib murid, tata tertib smp 3 abiansemal, budaya positif, kedisiplinan sekolah',
                'meta_description' => 'Pedoman tata tertib, etika kedisiplinan, dan budaya positif murid di SMP Negeri 3 Abiansemal.',
                'display_order' => 4,
                'is_active'     => 1,
                'created_at'    => Time::now()->toDateTimeString(),
                'updated_at'    => Time::now()->toDateTimeString(),
            ],
        ];
        $db->table('pages')->insertBatch($pages);

        // 7. Seed Galleries
        $db->table('galleries')->truncate();
        $galleries = [
            [
                'id'            => 1,
                'title'         => 'Persembahyangan Bersama di Padmasana Sekolah',
                'description'   => 'Khidmatnya persembahyangan bersama dewan guru dan murid memperkuat nilai Parahyangan.',
                'type'          => 'image',
                'file_url'      => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1200&q=80',
                'category'      => 'Keagamaan',
                'is_featured'   => 1,
                'display_order' => 1,
                'created_at'    => Time::now()->subDays(3)->toDateTimeString(),
                'updated_at'    => Time::now()->subDays(3)->toDateTimeString(),
            ],
            [
                'id'            => 2,
                'title'         => 'Praktikum Sains & Pengamatan Lingkungan di Laboratorium IPA',
                'description'   => 'Murid kelas VIII antusias mengamati keanekaragaman hayati dan reaksi sains terpadu.',
                'type'          => 'image',
                'file_url'      => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1200&q=80',
                'category'      => 'Akademik',
                'is_featured'   => 1,
                'display_order' => 2,
                'created_at'    => Time::now()->subDays(5)->toDateTimeString(),
                'updated_at'    => Time::now()->subDays(5)->toDateTimeString(),
            ],
            [
                'id'            => 3,
                'title'         => 'Latihan Seni Karawitan Tabuh Gong Kebyar di Wantilan',
                'description'   => 'Generasi muda SMPN 3 Abiansemal giat mengasah kepiawaian seni musik tradisional Bali.',
                'type'          => 'image',
                'file_url'      => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=1200&q=80',
                'category'      => 'Seni Budaya',
                'is_featured'   => 1,
                'display_order' => 3,
                'created_at'    => Time::now()->subDays(8)->toDateTimeString(),
                'updated_at'    => Time::now()->subDays(8)->toDateTimeString(),
            ],
            [
                'id'            => 4,
                'title'         => 'Pentas Seni Tari Bali & Parade Budaya Nusantara Pelajar',
                'description'   => 'Keanggunan tarian Bali kreasi murid memukau panggung festival seni sekolah.',
                'type'          => 'image',
                'file_url'      => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=1200&q=80',
                'category'      => 'Seni Budaya',
                'is_featured'   => 1,
                'display_order' => 4,
                'created_at'    => Time::now()->subDays(12)->toDateTimeString(),
                'updated_at'    => Time::now()->subDays(12)->toDateTimeString(),
            ],
            [
                'id'            => 5,
                'title'         => 'Penganugerahan Juara Lomba dan Piagam Apresiasi Murid Berprestasi',
                'description'   => 'Kepala Sekolah menyerahkan piala dan penghargaan atas capaian prestasi juara murid.',
                'type'          => 'image',
                'file_url'      => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=80',
                'category'      => 'Prestasi',
                'is_featured'   => 1,
                'display_order' => 5,
                'created_at'    => Time::now()->subDays(15)->toDateTimeString(),
                'updated_at'    => Time::now()->subDays(15)->toDateTimeString(),
            ],
            [
                'id'            => 6,
                'title'         => 'Video Profil Resmi SMP Negeri 3 Abiansemal',
                'description'   => 'Jelajah lingkungan sekolah asri, fasilitas pembelajaran, dan profil murid CEMPAKA.',
                'type'          => 'video',
                'file_url'      => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'category'      => 'Video Profil',
                'is_featured'   => 1,
                'display_order' => 6,
                'created_at'    => Time::now()->subDays(18)->toDateTimeString(),
                'updated_at'    => Time::now()->subDays(18)->toDateTimeString(),
            ],
        ];
        $db->table('galleries')->insertBatch($galleries);

        // 8. Seed Sample Visitors for dashboard charts
        $db->table('visitors')->truncate();
        $sampleVisitors = [];
        $ipList = ['192.168.1.10', '192.168.1.15', '180.252.10.4', '114.124.50.2', '125.160.8.9', '36.85.12.1'];
        $pagesList = ['/', '/berita', '/galeri', '/profil/tentang-sekolah', '/kontak', '/berita/murid-smp-negeri-3-abiansemal-raih-juara-1-olimpiade-sains-riset-pelajar-se-bali'];

        for ($i = 14; $i >= 0; $i--) {
            $count = rand(15, 60);
            for ($k = 0; $k < $count; $k++) {
                $sampleVisitors[] = [
                    'ip_address'   => $ipList[array_rand($ipList)],
                    'user_agent'   => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36',
                    'page_visited' => $pagesList[array_rand($pagesList)],
                    'referrer'     => 'https://www.google.com/',
                    'session_id'   => md5(uniqid()),
                    'visited_at'   => Time::now()->subDays($i)->subHours(rand(1, 23))->toDateTimeString(),
                ];
            }
        }
        $db->table('visitors')->insertBatch($sampleVisitors);
    }
}
